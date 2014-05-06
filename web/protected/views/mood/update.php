<?php
/* @var $this MoodController */
/* @var $model ReportingUserMoodRating */

$this->breadcrumbs=array(
	'Reporting User Mood Ratings'=>array('index'),
	$model->reportingUserMoodRatingId=>array('view','id'=>$model->reportingUserMoodRatingId),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReportingUserMoodRating', 'url'=>array('index')),
	array('label'=>'Create ReportingUserMoodRating', 'url'=>array('create')),
	array('label'=>'View ReportingUserMoodRating', 'url'=>array('view', 'id'=>$model->reportingUserMoodRatingId)),
	array('label'=>'Manage ReportingUserMoodRating', 'url'=>array('admin')),
);
?>

<h1>Update ReportingUserMoodRating <?php echo $model->reportingUserMoodRatingId; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>