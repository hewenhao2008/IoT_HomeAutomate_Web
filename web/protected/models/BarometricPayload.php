<?php

/**
 * This is the model class for table "BarometricPayload".
 *
 * The followings are the available columns in table 'BarometricPayload':
 * @property string $barometricPayloadId
 * @property string $date
 * @property double $pressure
 * @property double $temperature
 * @property string $reportingGateway_gatewayId
 *
 * The followings are the available model relations:
 * @property Gateway $reportingGatewayGateway
 */
class BarometricPayload extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return BarometricPayload the static model class
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
		return 'BarometricPayload';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pressure, temperature, reportingGateway_gatewayId', 'required'),
			array('pressure, temperature', 'numerical'),
			array('reportingGateway_gatewayId', 'length', 'max'=>20),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('barometricPayloadId, date, pressure, temperature, reportingGateway_gatewayId', 'safe', 'on'=>'search'),
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
			'reportingGatewayGateway' => array(self::BELONGS_TO, 'Gateway', 'reportingGateway_gatewayId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'barometricPayloadId' => 'Barometric Payload',
			'date' => 'Date',
			'pressure' => 'Pressure',
			'temperature' => 'Temperature',
			'reportingGateway_gatewayId' => 'Reporting Gateway Gateway',
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

		$criteria->compare('barometricPayloadId',$this->barometricPayloadId,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('pressure',$this->pressure);
		$criteria->compare('temperature',$this->temperature);
		$criteria->compare('reportingGateway_gatewayId',$this->reportingGateway_gatewayId,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}