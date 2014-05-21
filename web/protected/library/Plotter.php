<?php

class Plotter
{
	static public function multiScaleMoodData($reportingUserId){
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'reportingUserId = :userId';
		$criteria->params = array(':userId' => $reportingUserId);
		$criteria->order = 'moodRatingMaterializedViewId DESC';
		$criteria->limit = 20;
		$records = MoodRatingMaterializedView::model()->findAll($criteria);

		$normalizedData = Plotter::normalizeData($records);
		$normalizedData['type'] = 'Mood';

		return $normalizedData;
	}

	static public function multiScalePhysicalData($reportingUserId){
		
		$criteria = new CDbCriteria;
		$criteria->condition = 'reportingUserId = :userId';
		$criteria->params = array(':userId' => $reportingUserId);
		$criteria->order = 'physicalRatingMaterializedViewId DESC';
		$criteria->limit = 20;
		$records = PhysicalRatingMaterializedView::model()->findAll($criteria);

		$normalizedData = Plotter::normalizeData($records);
		$normalizedData['type'] = 'Physical';

		return $normalizedData;
	}

	static public function scatterMoodData(){
		
		$criteria = new CDbCriteria;
		$criteria->order = 'moodRatingMaterializedViewId DESC';
		$criteria->limit = 1000;
		$records = MoodRatingMaterializedView::model()->findAll($criteria);

		$arrayData = Plotter::arrayData($records);
		$arrayData['type'] = 'Mood';

		return $arrayData;
	}

	static public function scatterPhysicalData(){
		
		$criteria = new CDbCriteria;
		$criteria->order = 'physicalRatingMaterializedViewId DESC';
		$criteria->limit = 1000;
		$records = PhysicalRatingMaterializedView::model()->findAll($criteria);

		$arrayData = Plotter::arrayData($records);
		$arrayData['type'] = 'Physical';

		return $arrayData;
	}

	static public function sensorData($sensorId){
		$criteria = new CDbCriteria;
		$criteria->condition = 'sensorIdentifier = :sensorId';
		$criteria->params = array(':sensorId' => $sensorId);
		$criteria->order = 'barometricPayloadId DESC';
		$criteria->limit = 50;
		$records = BarometricPayload::model()->findAll($criteria);

		$pressure = array();
		foreach($records as $record){
			array_push($pressure,$record->pressure);
		}

		$arrayData = array(
				'pressure' => $pressure,
				'type'=>'pressure'
				);
		return $arrayData;
	}

	static private function normalizeData($records)
	{
		$maxTemperature = -PHP_INT_MAX;
		$minTemperature = PHP_INT_MAX;
		$maxPressure = -PHP_INT_MAX;
		$minPressure = PHP_INT_MAX;

		foreach($records as $record){

			if($record->temperature > $maxTemperature){
				$maxTemperature = $record->temperature;
			} 
			if($record->temperature < $minTemperature){
				$minTemperature = $record->temperature;
			}

			if($record->pressure > $maxPressure){
				$maxPressure = $record->pressure;
			} 
			if($record->pressure < $minPressure){
				$minPressure = $record->pressure;
			}
		}

		$ratingScale = 1;
		$ratingOffset = -1;
		$ratingRange = 4;

		$temperatureScale = 1;
		$temperatureOffset = 0 - $minTemperature;
		$temperatureRange = $maxTemperature - $minTemperature;

		$pressureScale = 1;
		$pressureOffset = 0 - $minPressure;
		$pressureRange = $maxPressure - $minPressure;

		if($temperatureRange == 0 || $pressureRange == 0){
			$range = $minTemperature - $minPressure;
			if($range < 0){
				$range = $range * -1;
			}
			$temperatureScale = $range / $minTemperature;
			$pressureScale = $range / $minPressure;
			$ratingScale = $range / $ratingRange;
		}
		else if($temperatureRange > $pressureRange){
			$pressureScale = $temperatureRange / $pressureRange;
			$ratingScale = $temperatureRange / $ratingRange;
		}
		else {
			$temperatureScale = $pressureRange / $temperatureRange;
			$ratingScale = $pressureRange / $ratingRange;
		}

		$rating = array();
		$temperature = array();
		$pressure = array();
		foreach($records as $record){
			
			$normRating = ($record->rating + $ratingOffset) * $ratingScale;
			$normTemperature = ($record->temperature + $temperatureOffset) * $temperatureScale;
			$normPressure = ($record->pressure + $pressureOffset) * $pressureScale;

			array_push($rating,$normRating);
			array_push($temperature,$normTemperature);
			array_push($pressure,$normPressure);
		}

		$normalizedData = array(
				'rating' => $rating,
				'temperature' => $temperature,
				'pressure' => $pressure
				);
		return $normalizedData;
	}

	static private function arrayData($records)
	{
		$rating = array();
		$temperature = array();
		$pressure = array();
		foreach($records as $record){
			array_push($rating,$record->rating);
			array_push($temperature,$record->temperature);
			array_push($pressure,$record->pressure);
		}

		$arrayData = array(
				'rating' => $rating,
				'temperature' => $temperature,
				'pressure' => $pressure
				);
		return $arrayData;
	}

}
