<?php
/* @var $this PhysicalController */
/* @var $model ReportingUserPhysicalRating */

$this->breadcrumbs=array(
	'Reporting User Physical Ratings'=>array('index'),
	$model->reportingUserPhysicalRatingId,
);

$this->menu=array(
	array('label'=>'List ReportingUserPhysicalRating', 'url'=>array('index')),
	array('label'=>'Create ReportingUserPhysicalRating', 'url'=>array('create'), 'visible'=>Yii::app()->user->getState("admin")),
	array('label'=>'Update ReportingUserPhysicalRating', 'url'=>array('update', 'id'=>$model->reportingUserPhysicalRatingId), 'visible'=>Yii::app()->user->getState("admin")),
	array('label'=>'Delete ReportingUserPhysicalRating', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->reportingUserPhysicalRatingId),'confirm'=>'Are you sure you want to delete this item?'), 'visible'=>Yii::app()->user->getState("admin")),
	array('label'=>'Manage ReportingUserPhysicalRating', 'url'=>array('admin'), 'visible'=>Yii::app()->user->getState("admin")),
);
?>

<h1>View ReportingUserPhysicalRating #<?php echo $model->reportingUserPhysicalRatingId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'reportingUserPhysicalRatingId',
		'date',
		'matchConfidence',
		'reportedLatitude',
		'reportedLongitude',
		'rating',
		'barometricPayloadId',
		'reportingUserId',
	),
)); ?>
