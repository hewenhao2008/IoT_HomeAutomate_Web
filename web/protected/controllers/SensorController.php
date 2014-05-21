<?php

class SensorController extends Controller
{
	public function actionIndex()
	{
		$criteria = new CDbCriteria;
		$criteria->order = 'barometricPayloadId DESC';
		$criteria->group = 'sensorIdentifier';
		$criteria->distinct = true;
		$dataProvider=new CActiveDataProvider('BarometricPayload', array(
				'criteria'=>$criteria,
			));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionView($id)
	{
		$criteria = new CDbCriteria;
		$criteria->condition = 'sensorIdentifier = :sensorId';
		$criteria->params = array(':sensorId' => $id);
		$criteria->order = 'barometricPayloadId DESC';
		$dataProvider=new CActiveDataProvider('BarometricPayload', array(
				'criteria'=>$criteria,
			));
		$this->render('view',array(
			'dataProvider'=>$dataProvider,
			'sensorIdentifier'=>$id
		));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
