<?php

class MinutelyCommand extends CConsoleCommand
{
	const APNS_HOST="gateway.push.apple.com";
	const APNS_PORT=2195;
	const READING_RANGE=86400; // 24 hours = 24 * 60 * 60 seconds

	public function run($args)
	{
		setlocale(LC_MONETARY, 'en_US');
		if(in_array("all",$args) || (sizeof($args)==0)){
			$this->updateMoodRatingMaterializedView();
			$this->updatePhysicalRatingMaterializedView();
		}
		else{
			foreach($args as $arg){
				switch(strtolower($arg)){
					case "updatemoodratings":
						$this->updateMoodRatingMaterializedView();
						break;
					case "updatephysicalratings":
						$this->updatePhysicalRatingMaterializedView();
						break;
				}
			}
		}
		return 0;
	}

	public function updateMoodRatingMaterializedView()
	{
		$this->log('..................................................');
		$this->log('.. Matching mood ratings to barametric readings ..');
		$this->log('..................................................');


		$criteria = new CDbCriteria;
		$criteria->order = 'moodRatingMaterializedViewId DESC';
		$lastRecord = MoodRatingMaterializedView::model()->find($criteria);

		$criteria = new CDbCriteria;
		if($lastRecord){
			$this->log('Located last record in materialized view at [reportingUserMoodRatingId='.$lastRecord->reportingUserMoodRatingId.']');
			$criteria->condition = 'reportingUserMoodRatingId > '.$lastRecord->reportingUserMoodRatingId;
		}

		$ratingRecords = ReportingUserMoodRating::model()->findAll($criteria);
		$this->log('Found ('.count($ratingRecords).') new reportingUserMoodRating records');
		foreach($ratingRecords as $rating)
		{
			$this->log('Processing record ('.$rating->reportingUserMoodRatingId.')');
			$this->log("\t".'[date='.$rating->date.']');
			$this->log("\t".'[reportedLatitude='.$rating->reportedLatitude.']');
			$this->log("\t".'[reportedLongitude='.$rating->reportedLongitude.']');
			$this->log("\t".'[rating='.$rating->rating.']');

			$distanceConfidence = 3;
			$criteria = Location::criteriaByRange($rating,MoodRatingMaterializedView::CONFIDENCE_3);
			$criteria->condition = $criteria->condition . ' AND date >= DATE_SUB("'.$rating->date.'",INTERVAL '.self::READING_RANGE.' SECOND)';
			$criteria->order = 'date DESC';

			$readingRecords = BarometricPayload::model()->findAll($criteria);
			if(!$readingRecords){
				$distanceConfidence = 2;
				$criteria = Location::criteriaByRange($rating,MoodRatingMaterializedView::CONFIDENCE_2);
				$criteria->condition = $criteria->condition . ' AND date >= DATE_SUB("'.$rating->date.'",INTERVAL '.self::READING_RANGE.' SECOND)';
				$criteria->order = 'date DESC';
				$readingRecords = BarometricPayload::model()->findAll($criteria);
			}
			if(!$readingRecords){
				$distanceConfidence = 1;
				$criteria = Location::criteriaByRange($rating,MoodRatingMaterializedView::CONFIDENCE_1);
				$criteria->condition = $criteria->condition . ' AND date >= DATE_SUB("'.$rating->date.'",INTERVAL '.self::READING_RANGE.' SECOND)';
				$criteria->order = 'date DESC';
				$readingRecords = BarometricPayload::model()->findAll($criteria);
			}
			if($readingRecords){
				$this->log("\t".'Matched BarometricPayload at distance confidence ('.$distanceConfidence.')');
				$locationLibrary = new Location;
				$sortedRecords = $locationLibrary->byDistance($readingRecords,$rating);

				if(count($sortedRecords) > 0){
					$record = $sortedRecords[0];

					$moodRating = new MoodRatingMaterializedView;
					$moodRating->reportingUserId = $rating->reportingUserId;
					$moodRating->reportingUserMoodRatingId = $rating->reportingUserMoodRatingId;
					$moodRating->date = $rating->date;
					$moodRating->rating = $rating->rating;
					$moodRating->temperature = $record->temperature;
					$moodRating->pressure = $record->pressure;
/*
					$date1 = new DateTime($record->date);
					$date2 = new DateTime($rating->date);
					$diff = $date2->diff($date1);
					$hours = $diff->h;
					$hours = $hours + ($diff->days*24);

					$moodRating->matchConfidence = $distanceConfidence * (24 - $hours);	*/
					$moodRating->matchConfidence = $distanceConfidence;				
					$moodRating->save();
				} 

			} else {
				$this->log("\t".'Unable to match BarometricPayload');
			}
		}

	}

	public function updatePhysicalRatingMaterializedView()
	{
		$this->log('......................................................');
		$this->log('.. Matching physical ratings to barametric readings ..');
		$this->log('......................................................');

		$criteria = new CDbCriteria;
		$criteria->order = 'physicalRatingMaterializedViewId DESC';
		$lastRecord = PhysicalRatingMaterializedView::model()->find($criteria);

		$criteria = new CDbCriteria;
		if($lastRecord){
			$this->log('Located last record in materialized view at [reportingUserPhysicalRatingId='.$lastRecord->reportingUserPhysicalRatingId.']');
			$criteria->condition = 'reportingUserPhysicalRatingId > '.$lastRecord->reportingUserPhysicalRatingId;
		}

		$ratingRecords = ReportingUserPhysicalRating::model()->findAll($criteria);
		$this->log('Found ('.count($ratingRecords).') new reportingUserPhysicalRating records');
		foreach($ratingRecords as $rating)
		{
			$this->log('Processing record ('.$rating->reportingUserPhysicalRatingId.')');
			$this->log("\t".'[date='.$rating->date.']');
			$this->log("\t".'[reportedLatitude='.$rating->reportedLatitude.']');
			$this->log("\t".'[reportedLongitude='.$rating->reportedLongitude.']');
			$this->log("\t".'[rating='.$rating->rating.']');

			$distanceConfidence = 3;
			$criteria = Location::criteriaByRange($rating,PhysicalRatingMaterializedView::CONFIDENCE_3);
			$criteria->condition = $criteria->condition . ' AND date >= DATE_SUB("'.$rating->date.'",INTERVAL '.self::READING_RANGE.' SECOND)';
			$criteria->order = 'date DESC';
			$readingRecords = BarometricPayload::model()->findAll($criteria);
			if(!$readingRecords){
				$distanceConfidence = 2;
				$criteria = Location::criteriaByRange($rating,PhysicalRatingMaterializedView::CONFIDENCE_2);
				$criteria->condition = $criteria->condition . ' AND date >= DATE_SUB("'.$rating->date.'",INTERVAL '.self::READING_RANGE.' SECOND)';
				$criteria->order = 'date DESC';
				$readingRecords = BarometricPayload::model()->findAll($criteria);
			}
			if(!$readingRecords){
				$distanceConfidence = 1;
				$criteria = Location::criteriaByRange($rating,PhysicalRatingMaterializedView::CONFIDENCE_1);
				$criteria->condition = $criteria->condition . ' AND date >= DATE_SUB("'.$rating->date.'",INTERVAL '.self::READING_RANGE.' SECOND)';
				$criteria->order = 'date DESC';
				$readingRecords = BarometricPayload::model()->findAll($criteria);
			}
			if($readingRecords){
				$this->log("\t".'Matched BarometricPayload at distance confidence ('.$distanceConfidence.')');

				$locationLibrary = new Location;
				$sortedRecords = $locationLibrary->byDistance($readingRecords,$rating);

				if(count($sortedRecords) > 0){
					$record = $sortedRecords[0];

					$moodRating = new PhysicalRatingMaterializedView;
					$moodRating->reportingUserId = $rating->reportingUserId;
					$moodRating->reportingUserPhysicalRatingId = $rating->reportingUserPhysicalRatingId;
					$moodRating->date = $rating->date;
					$moodRating->rating = $rating->rating;
					$moodRating->temperature = $record->temperature;
					$moodRating->pressure = $record->pressure;
/*
					$date1 = new DateTime($record->date);
					$date2 = new DateTime($rating->date);
					$diff = $date2->diff($date1);
					$hours = $diff->h;
					$hours = $hours + ($diff->days*24);

					$moodRating->matchConfidence = $distanceConfidence * (24 - $hours);	*/
					$moodRating->matchConfidence = $distanceConfidence;				
					$moodRating->save();
				} 

			} else {
				$this->log("\t".'Unable to match BarometricPayload');
			}
		}
	}

	private function log($string)
	{
		echo date('Y-m-d H:i:s').": $string\r\n";
	}
}
