<?php

/**
 * This is the model class for table "Gateway".
 *
 * The followings are the available columns in table 'Gateway':
 * @property string $gatewayId
 * @property integer $active
 * @property string $firstSeen
 * @property string $identifier
 * @property string $lastSeen
 * @property string $currentLocation_locationId
 *
 * The followings are the available model relations:
 * @property BarometricPayload[] $barometricPayloads
 * @property Location $currentLocationLocation
 * @property GatewayUser[] $gatewayUsers
 * @property GatewayLocation[] $gatewayLocations
 */
class Gateway extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Gateway the static model class
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
		return 'Gateway';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('active, firstSeen, identifier, lastSeen, currentLocation_locationId', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('identifier', 'length', 'max'=>255),
			array('currentLocation_locationId', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('gatewayId, active, firstSeen, identifier, lastSeen, currentLocation_locationId', 'safe', 'on'=>'search'),
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
			'barometricPayloads' => array(self::HAS_MANY, 'BarometricPayload', 'reportingGateway_gatewayId'),
			'currentLocationLocation' => array(self::BELONGS_TO, 'Location', 'currentLocation_locationId'),
			'gatewayUsers' => array(self::HAS_MANY, 'GatewayUser', 'gatewayId'),
			'gatewayLocations' => array(self::HAS_MANY, 'GatewayLocation', 'Gateway_gatewayId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'gatewayId' => 'Gateway',
			'active' => 'Active',
			'firstSeen' => 'First Seen',
			'identifier' => 'Identifier',
			'lastSeen' => 'Last Seen',
			'currentLocation_locationId' => 'Current Location Location',
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

		$criteria->compare('gatewayId',$this->gatewayId,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('firstSeen',$this->firstSeen,true);
		$criteria->compare('identifier',$this->identifier,true);
		$criteria->compare('lastSeen',$this->lastSeen,true);
		$criteria->compare('currentLocation_locationId',$this->currentLocation_locationId,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}