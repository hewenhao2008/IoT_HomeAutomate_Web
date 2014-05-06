<?php

/**
 * This is the model class for table "ReportingUser".
 *
 * The followings are the available columns in table 'ReportingUser':
 * @property string $reportingUserId
 * @property integer $active
 * @property string $firstName
 * @property string $firstSeen
 * @property string $lastName
 * @property string $lastSeen
 * @property string $password
 * @property string $userName
 *
 * The followings are the available model relations:
 * @property ReportingUserMoodRating[] $reportingUserMoodRatings
 * @property ReportingUserPhysicalRating[] $reportingUserPhysicalRatings
 */
class ReportingUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReportingUser the static model class
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
		return 'ReportingUser';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('active, firstSeen, lastSeen, password, userName', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('firstName, lastName, password, userName', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('reportingUserId, active, firstName, firstSeen, lastName, lastSeen, password, userName', 'safe', 'on'=>'search'),
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
			'reportingUserMoodRatings' => array(self::HAS_MANY, 'ReportingUserMoodRating', 'reportingUserId'),
			'reportingUserPhysicalRatings' => array(self::HAS_MANY, 'ReportingUserPhysicalRating', 'reportingUserId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'reportingUserId' => 'Reporting User',
			'active' => 'Active',
			'firstName' => 'First Name',
			'firstSeen' => 'First Seen',
			'lastName' => 'Last Name',
			'lastSeen' => 'Last Seen',
			'password' => 'Password',
			'userName' => 'User Name',
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

		$criteria->compare('reportingUserId',$this->reportingUserId,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('firstSeen',$this->firstSeen,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('lastSeen',$this->lastSeen,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('userName',$this->userName,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}