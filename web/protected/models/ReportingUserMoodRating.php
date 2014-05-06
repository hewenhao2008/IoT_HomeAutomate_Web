<?php

/**
 * This is the model class for table "ReportingUserMoodRating".
 *
 * The followings are the available columns in table 'ReportingUserMoodRating':
 * @property string $reportingUserMoodRatingId
 * @property string $date
 * @property integer $matchConfidence
 * @property double $reportedLatitude
 * @property double $reportedLongitude
 * @property integer $rating
 * @property string $barometricPayloadId
 * @property string $reportingUserId
 *
 * The followings are the available model relations:
 * @property ReportingUser $reportingUser
 * @property BarometricPayload $barometricPayload
 */
class ReportingUserMoodRating extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReportingUserMoodRating the static model class
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
		return 'ReportingUserMoodRating';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reportedLatitude, reportedLongitude, rating, reportingUserId', 'required'),
			array('matchConfidence, rating', 'numerical', 'integerOnly'=>true),
			array('reportedLatitude, reportedLongitude', 'numerical'),
			array('barometricPayloadId, reportingUserId', 'length', 'max'=>20),
			array('date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('reportingUserMoodRatingId, date, matchConfidence, reportedLatitude, reportedLongitude, rating, barometricPayloadId, reportingUserId', 'safe', 'on'=>'search'),
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
			'reportingUser' => array(self::BELONGS_TO, 'ReportingUser', 'reportingUserId'),
			'barometricPayload' => array(self::BELONGS_TO, 'BarometricPayload', 'barometricPayloadId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'reportingUserMoodRatingId' => 'Reporting User Mood Rating',
			'date' => 'Date',
			'matchConfidence' => 'Match Confidence',
			'reportedLatitude' => 'Reported Latitude',
			'reportedLongitude' => 'Reported Longitude',
			'rating' => 'Rating',
			'barometricPayloadId' => 'Barometric Payload',
			'reportingUserId' => 'Reporting User',
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

		$criteria->compare('reportingUserMoodRatingId',$this->reportingUserMoodRatingId,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('matchConfidence',$this->matchConfidence);
		$criteria->compare('reportedLatitude',$this->reportedLatitude);
		$criteria->compare('reportedLongitude',$this->reportedLongitude);
		$criteria->compare('rating',$this->rating);
		$criteria->compare('barometricPayloadId',$this->barometricPayloadId,true);
		$criteria->compare('reportingUserId',$this->reportingUserId,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}