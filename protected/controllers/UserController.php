<?php

class UserController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionLogin()
	{
		//登录状态
		if(!Yii::app()->user->getIsGuest()){
			$this->redirect(Yii::app()->homeUrl);
			exit;
		}
		//获取登录前的URL
		$get_url = $this->_request->getParam('ret_url');
		if (!empty($get_url))
		{
			$ret_url = trim($get_url);
		}
		else
		{
			if (isset($_SERVER['HTTP_REFERER']))
			{
				$ret_url = $_SERVER['HTTP_REFERER'];
			}
			else
			{
				$ret_url = Yii::app()->user->returnUrl;
			}
		}
		/* 防止登陆成功后跳转到登陆、退出的页面 */
		$ret_url = strtolower($ret_url);
		if (str_replace(array('user/login', 'user/logout', 'user/register'), '', $ret_url) != $ret_url)
		{
			$ret_url = Yii::app()->user->returnUrl;
		}

		$loginForm = new LoginForm();
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$loginForm->attributes=$_POST['LoginForm'];
			
			// validate user input and redirect to the previous page if valid
			if($loginForm->validate() && $loginForm->login()){
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}

		$this->render('login',array('loginForm'=>$loginForm));
	}

	public function actionRegister()
	{
		$registerModel = new RegisterForm();
		$loginForm = new LoginForm();
		$userModel = new User();
		//异步接受处理
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-register-form')
		{
			echo CActiveForm::validate($registerModel);
			Yii::app()->end();
		}
		//登录状态
		if(!Yii::app()->user->getIsGuest()){
			$this->redirect(Yii::app()->homeUrl);
			exit;
		}

		//注册ip访问控制
		$cur_ip = $this->_request->userHostAddress;		
		$access_ips = $this->_setting['deny_register_ip'];
		$access_ips && $access_ips = explode("\r\n", trim($access_ips));
		$access = Helper::ipAccess($cur_ip, $access_ips);		
		if(!$access) {
			throw new CHttpException(403, Yii::t('common', 'Register Deny!'));
			exit;
		}
		
		// collect user input data
		if(isset($_POST['RegisterForm'])){
			$registerModel->attributes=$_POST['RegisterForm'];
			$userModel->user_login=$registerModel->username;
			$userModel->user_pass=$registerModel->password;
			$userModel->user_nicename=$registerModel->nickname;
			$userModel->user_email=$registerModel->email;
			$userModel->user_registered=time();
			$userModel->user_status = $this->_setting['email_active']?-1:1;  //审核状态
			if($userModel->save()){
				if($this->_setting['email_active']){
					
					//发送激活邮件				
					$this->sendActiveAccount(array('id'=>$userModel->id, 'email'=>$userModel->user_email, 'username'=>$userModel->user_login));
					$this->message('success', Yii::t('common','Register Success And Active Email'), $this->createUrl('login'), 5);
					//登陆
					$loginForm->username = $registerModel->username;
					$loginForm->password = $registerModel->password;
					$loginForm->login();
				}else{					
					$this->message('success', Yii::t('common','Register Success'), $this->createUrl('login'), 5);
				}
			}else{
				$this->message('error',Yii::t('common','Register Failed'), $this->createUrl('register'));
			}

		}
		$this->render('register',array('registerModel'=>$registerModel));
	}

	/**
	 * 发送账号激活邮件
	 * @param unknown $params
	 */
	public function sendActiveAccount($params = array())
	{
		//生成校验字符串
		if(!$params['id'] || !$params['username'] || !$params['email']){
			return false;
		}
		$safestr = $this->_setting['safe_str'];  //安全密匙
		$important_string = $params['id'];
		$authcode = Helper::authcode($important_string, 'ENCODE', $safestr, 3600*2); //加密处理，2个小时过期
		$authcode = urlencode($authcode);   //url编码		
		$authurl = $this->_request->hostInfo.$this->createUrl('authEmail', array('authcode'=>$authcode));
		$subject = Yii::t('common','Account Active');
		$message = Yii::t('common','Register Email',
				array('{username}'=>$params['username'],
						'{sitename}'=>$this->_setting['site_name'],
						'{authurl}'=>$authurl,
						'{admin_email}'=>$this->_setting['admin_email']));

		Helper::sendMail(0, $params['email'], $subject, $message);
	
	}
	/**
	 * 验证账号激活邮件
	 */
	public function actionAuthEmail(){
		//解密
		$authcode = urldecode($this->_request->getParam('authcode'));
		$safestr = $this->_setting['safe_str'];  //安全密匙
		$decode = Helper::authcode($authcode, 'DECODE', $safestr);
		if($decode){
			$id = intval($decode);
			$user = User::model()->findByPk($id);
			if(!$user){
				$this->message('error',Yii::t('common','Auth Account Do Not Exist'), $this->createUrl('site/index'),0, true);
			}else{
				if($user->user_status == 1){
					$this->message('success',Yii::t('common','Auth Is Ok'), $this->createUrl('login'));
				}else{
					$user->user_status = 1;
					$user->save();
					$this->message('success',Yii::t('common','Auth Success'), $this->createUrl('login'),5);
				}
			}			
		}else{
			$this->message('error',Yii::t('common','The link is invalid'), $this->createUrl('site/index'),0, true);
		}
		
	}

	/**
	 * 重发验证邮件，进行账号激活
	 * 
	 */
	public function actionActiveEmail(){
		$this->_seoTitle = Yii::t('common','Account Active').' - '.$this->_setting['site_name'];
		//加载css,js
		Yii::app()->clientScript->registerCssFile($this->_stylePath . "/css/user.css");
		Yii::app()->clientScript->registerScriptFile($this->_static_public . "/js/jquery/jquery.js");
		$model = $this->loadModel();
		
		if($model->status == 1){
			$this->redirect($this->createUrl('index'));
		}else{
			if($this->_request->isPostRequest){
				if($_POST['ajax'] == 'ajax_active_form'){
					$this->sendActiveAccount(array('id'=>$model->uid, 'username'=>$model->username,'email'=>$model->email));
					exit(CJSON::encode(array('message'=>Yii::t('common','Send Success'))));
				}else{
					exit(CJSON::encode(array('message'=>Yii::t('common','Send Failed'))));
				}
			}
			$this->render('active_email', array('model'=>$model));
		}
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xCCCCCC,  //背景色
				'foreColor'=> 0x3C5880,	//前景色
				'padding'=>0,
				'width' => 90,
				'height'=>30,
				'minLength'=>6,
				'maxLength'=>6,
				'testLimit'=>0,   //不限制输错次数
				'offset' => 2,    //字符间距
			),
		);
	}
	
}