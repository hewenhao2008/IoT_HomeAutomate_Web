<?php

/**
 * This is the model class for table "GatewayUser".
 *
 * The followings are the available columns in table 'GatewayUser':
 * @property string $gatewayUserId
 * @property integer $active
 * @property string $firstName
 * @property string $firstSeen
 * @property string $lastName
 * @property string $lastSeen
 * @property string $password
 * @property string $userName
 * @property string $gatewayId
 *
 * The followings are the available model relations:
 * @property Gateway $gateway
 * @property GatewayUserMoodRating[] $gatewayUserMoodRatings
 * @property GatewayUserPhysicalRating[] $gatewayUserPhysicalRatings
 */
class GatewayUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GatewayUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'GatewayUser';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('active, firstSeen, lastSeen, password, userName, gatewayId', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('firstName, lastName, password, userName', 'length', 'max'=>255),
			array('gatewayId', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('gatewayUserId, active, firstName, firstSeen, lastName, lastSeen, password, userName, gatewayId', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'gateway' => array(self::BELONGS_TO, 'Gateway', 'gatewayId'),
			'gatewayUserMoodRatings' => array(self::HAS_MANY, 'GatewayUserMoodRating', 'gatewayMoodId'),
			'gatewayUserPhysicalRatings' => array(self::HAS_MANY, 'GatewayUserPhysicalRating', 'gatewayUserId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'gatewayUserId' => 'Gateway User',
			'active' => 'Active',
			'firstName' => 'First Name',
			'firstSeen' => 'First Seen',
			'lastName' => 'Last Name',
			'lastSeen' => 'Last Seen',
			'password' => 'Password',
			'userName' => 'User Name',
			'gatewayId' => 'Gateway',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('gatewayUserId',$this->gatewayUserId,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('firstSeen',$this->firstSeen,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('lastSeen',$this->lastSeen,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('userName',$this->userName,true);
		$criteria->compare('gatewayId',$this->gatewayId,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}