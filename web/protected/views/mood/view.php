<?php
/* @var $this MoodController */
/* @var $model ReportingUserMoodRating */

$this->breadcrumbs=array(
	'Reporting User Mood Ratings'=>array('index'),
	$model->reportingUserMoodRatingId,
);

$this->menu=array(
	array('label'=>'List ReportingUserMoodRating', 'url'=>array('index')),
	array('label'=>'Create ReportingUserMoodRating', 'url'=>array('create')),
	array('label'=>'Update ReportingUserMoodRating', 'url'=>array('update', 'id'=>$model->reportingUserMoodRatingId)),
	array('label'=>'Delete ReportingUserMoodRating', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->reportingUserMoodRatingId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReportingUserMoodRating', 'url'=>array('admin')),
);
?>

<h1>View ReportingUserMoodRating #<?php echo $model->reportingUserMoodRatingId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'reportingUserMoodRatingId',
		'date',
		'matchConfidence',
		'reportedLatitude',
		'reportedLongitude',
		'rating',
		'barometricPayloadId',
		'reportingUserId',
	),
)); ?>
