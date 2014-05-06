<?php
/* @var $this MoodController */
/* @var $model ReportingUserMoodRating */

$this->breadcrumbs=array(
	'Reporting User Mood Ratings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReportingUserMoodRating', 'url'=>array('index')),
	array('label'=>'Manage ReportingUserMoodRating', 'url'=>array('admin')),
);
?>

<h1>Create ReportingUserMoodRating</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>