<?php

/**
 * This is the model class for table "MoodRatingMaterializedView".
 *
 * The followings are the available columns in table 'MoodRatingMaterializedView':
 * @property string $moodRatingMaterializedViewId
 * @property string $reportingUserId
 * @property string $reportingUserMoodRatingId
 * @property string $date
 * @property integer $rating
 * @property double $temperature
 * @property double $pressure
 * @property integer $matchConfidence
 */
class MoodRatingMaterializedView extends CActiveRecord
{
	const CONFIDENCE_3=1000; // meters
	const CONFIDENCE_2=10000; // meters
	const CONFIDENCE_1=100000; // meters

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MoodRatingMaterializedView the static model class
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
		return 'MoodRatingMaterializedView';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reportingUserId, reportingUserMoodRatingId, rating, pressure, matchConfidence', 'required'),
			array('rating, matchConfidence', 'numerical', 'integerOnly'=>true),
			array('temperature, pressure', 'numerical'),
			array('reportingUserId, reportingUserMoodRatingId', 'length', 'max'=>20),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('moodRatingMaterializedViewId, reportingUserId, reportingUserMoodRatingId, date, rating, temperature, pressure, matchConfidence', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'moodRatingMaterializedViewId' => 'Mood Rating Materialized View',
			'reportingUserId' => 'Reporting User',
			'reportingUserMoodRatingId' => 'Reporting User Mood Rating',
			'date' => 'Date',
			'rating' => 'Rating',
			'temperature' => 'Temperature',
			'pressure' => 'Pressure',
			'matchConfidence' => 'Match Confidence',
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

		$criteria->compare('moodRatingMaterializedViewId',$this->moodRatingMaterializedViewId,true);
		$criteria->compare('reportingUserId',$this->reportingUserId,true);
		$criteria->compare('reportingUserMoodRatingId',$this->reportingUserMoodRatingId,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('temperature',$this->temperature);
		$criteria->compare('pressure',$this->pressure);
		$criteria->compare('matchConfidence',$this->matchConfidence);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
