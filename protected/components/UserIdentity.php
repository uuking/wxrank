<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	public $_id = null;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{		
		$user=User::model()->find('user_login=:username OR user_email=:email',array(':username'=>$this->username,':email'=>$this->username));
		if($user===null){
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else if(!$user->validatePassword($this->password) || $user->user_status == 0){
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
		else{
			$this->_id=$user->id;
			//把用户信息存入SESSION
			$this->setState('status', $user->user_status);
			$this->setState('nickname', $user->user_nicename?$user->user_nicename:$user->user_login);
			$this->setState('email', $user->user_email);
			
			$this->username=$user->user_login;
			$this->errorCode=self::ERROR_NONE;
		}
		return $this->errorCode==self::ERROR_NONE;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}
}