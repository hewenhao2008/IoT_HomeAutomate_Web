<?php

/**
 * This is the model class for table "GatewayUserMoodRating".
 *
 * The followings are the available columns in table 'GatewayUserMoodRating':
 * @property string $gatewayUserMoodRatingId
 * @property string $date
 * @property integer $rating
 * @property string $gatewayMoodId
 *
 * The followings are the available model relations:
 * @property GatewayUser $gatewayMood
 */
class GatewayUserMoodRating extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GatewayUserMoodRating the static model class
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
		return 'GatewayUserMoodRating';
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
			array('gatewayMoodId', 'length', 'max'=>20),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('gatewayUserMoodRatingId, date, rating, gatewayMoodId', 'safe', 'on'=>'search'),
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
			'gatewayMood' => array(self::BELONGS_TO, 'GatewayUser', 'gatewayMoodId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'gatewayUserMoodRatingId' => 'Gateway User Mood Rating',
			'date' => 'Date',
			'rating' => 'Rating',
			'gatewayMoodId' => 'Gateway Mood',
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

		$criteria->compare('gatewayUserMoodRatingId',$this->gatewayUserMoodRatingId,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('gatewayMoodId',$this->gatewayMoodId,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}