<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegisterForm extends CFormModel
{
	public $username;
	public $password;
	public $email;
	public $nickname;
	public $verifyCode;
	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password, email, verifyCode', 'required'),
			array('username, password','length','min'=>6, 'max'=>40),
			array('username','checkUsername'),
			array('email','checkEmail'),
			array('nickname','safe'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>Yii::t('model','username'),
			'password'=>Yii::t('model','password'),
			'email'=>Yii::t('model','email'),
			'nickname'=>Yii::t('model','nickname'),
			'verifyCode'=>Yii::t('model','verifyCode'),
		);
	}

	/**
	 * 校验用户名
	 */
	function checkUsername(){
		$user = User::model()->find("user_login=:username", array(':username'=>$this->username));
		if($user){
			$this->addError('username', Yii::t('common','Username is exists'));
			return false;
		}
	}
	/**
	 * 校验邮箱
	 */
	function checkEmail(){
		$reg = '/^[a-zA-Z0-9_]+@(qq|126|163|sina|hotmail|yahoo|gmail|sohu|live)(\.com|\.com\.cn)$/';
		if(!preg_match($reg, $this->email)){
			$this->addError('email', Yii::t('common','Email Format Is Wrong'));
			return false;
		}
		$email = User::model()->find("user_email=:email", array(':email'=>$this->email));
		if($email){
			$this->addError('email', Yii::t('common','Existing Email'));
			return false;
		}
	}

}
