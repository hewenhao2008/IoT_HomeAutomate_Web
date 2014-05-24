<?php
/* @var $this UserController */
/* @var $model ReportingUser */

$this->breadcrumbs=array(
	'Reporting Users'=>array('index'),
	$model->reportingUserId,
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create'), 'visible'=>Yii::app()->user->getState("admin")),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->reportingUserId), 'visible'=>Yii::app()->user->getState("admin")),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->reportingUserId),'confirm'=>'Are you sure you want to delete this item?'), 'visible'=>Yii::app()->user->getState("admin")),
	array('label'=>'Manage Users', 'url'=>array('admin'), 'visible'=>Yii::app()->user->getState("admin")),
);
?>

<h1>User #<?php echo $model->reportingUserId; ?></h1>

<?php /*$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'active',
		'firstName',
		'firstSeen',
		'lastName',
		'lastSeen',
	),
)); */?>

<p>
<?php 
$moodData = Plotter::multiScaleMoodData($model->reportingUserId); 
$encodedMoodData = urlencode(json_encode($moodData));
echo CHtml::image(Yii::app()->request->baseUrl.$this->createUrl('plot/multiscale',array('data'=>$encodedMoodData) )); 
?>
</p>

<p>
<?php 
$physicalData = Plotter::multiScalePhysicalData($model->reportingUserId); 
$encodedPhysicalData = urlencode(json_encode($physicalData));
echo CHtml::image(Yii::app()->request->baseUrl.$this->createUrl('plot/multiscale',array('data'=>$encodedPhysicalData) )); 
?>
</p>

