<?php
/* @var $this SensorController */
/* @var $model BarometricPayload */

$this->breadcrumbs=array(
	'Sensor'=>array('/sensor'),
	$sensorIdentifier,
);
?>

<h1>View Sensor #<?php echo $sensorIdentifier; ?></h1>

<p>
<?php 
$sensorData = Plotter::sensorData($sensorIdentifier);
$sensorData['type']='Pressure Readings'; 
$encodedSensorData = urlencode(json_encode($sensorData));
echo CHtml::image(Yii::app()->request->baseUrl.$this->createUrl('plot/sensor',array('data'=>$encodedSensorData) )); 
?>
</p>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_payload',
)); ?>
