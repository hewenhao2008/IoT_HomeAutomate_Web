<?php

/**
 * This is the model class for table "GatewayUserPhysicalRating".
 *
 * The followings are the available columns in table 'GatewayUserPhysicalRating':
 * @property string $gatewayUserPhysicalRatingId
 * @property string $date
 * @property integer $rating
 * @property string $gatewayUserId
 *
 * The followings are the available model relations:
 * @property GatewayUser $gatewayUser
 */
class GatewayUserPhysicalRating extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GatewayUserPhysicalRating the static model class
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
		return 'GatewayUserPhysicalRating';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rating', 'required'),
			array('rating', 'numerical', 'integerOnly'=>true),
			array('gatewayUserId', 'length', 'max'=>20),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('gatewayUserPhysicalRatingId, date, rating, gatewayUserId', 'safe', 'on'=>'search'),
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
			'gatewayUser' => array(self::BELONGS_TO, 'GatewayUser', 'gatewayUserId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'gatewayUserPhysicalRatingId' => 'Gateway User Physical Rating',
			'date' => 'Date',
			'rating' => 'Rating',
			'gatewayUserId' => 'Gateway User',
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

		$criteria->compare('gatewayUserPhysicalRatingId',$this->gatewayUserPhysicalRatingId,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('gatewayUserId',$this->gatewayUserId,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}