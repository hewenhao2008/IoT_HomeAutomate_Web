<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * @var integer user id associated with the user.
	 */
	private $_id;

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
		$userName=strtolower($this->username);
		$admin=PortalAdministrator::model()->find('LOWER(userName)=?',array($userName));
		if($admin===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(strcmp($this->password,$admin->password) != 0)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$admin->portalAdministratorId;
            		$this->setState('admin', true);

			// log login
			$admin->lastSeen = date('Y-m-d H:i:s');
			$admin->save();

			// no errors
			$this->errorCode=self::ERROR_NONE;
		}


		if($this->errorCode){
			$user=ReportingUser::model()->find('LOWER(userName)=?',array($userName));
			if($user===null)
				$this->errorCode=self::ERROR_USERNAME_INVALID;
			else if(strcmp($this->password,$user->password) != 0)
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			else
			{
				$this->_id=$user->reportingUserId;
		    		$this->setState('admin', false);

				// log login
				$user->lastSeen = date('Y-m-d H:i:s');
				$user->save();

				// no errors
				$this->errorCode=self::ERROR_NONE;
			}			
		}

		return !$this->errorCode;
	}

	/**
	 * Returns user's id.
	 * @return integer user id.
	 */
	public function getId()
	{
		return $this->_id;
	}
}
