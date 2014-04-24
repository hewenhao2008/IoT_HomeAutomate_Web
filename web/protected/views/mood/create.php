<?php
/* @var $this MoodController */
/* @var $model GatewayUserMoodRating */

$this->breadcrumbs=array(
	'Gateway User Mood Ratings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GatewayUserMoodRating', 'url'=>array('index')),
	array('label'=>'Manage GatewayUserMoodRating', 'url'=>array('admin')),
);
?>

<h1>Create GatewayUserMoodRating</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>