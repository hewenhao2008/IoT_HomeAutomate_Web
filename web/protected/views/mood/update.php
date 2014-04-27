<?php
/* @var $this MoodController */
/* @var $model GatewayUserMoodRating */

$this->breadcrumbs=array(
	'Gateway User Mood Ratings'=>array('index'),
	$model->gatewayUserMoodRatingId=>array('view','id'=>$model->gatewayUserMoodRatingId),
	'Update',
);

$this->menu=array(
	array('label'=>'List GatewayUserMoodRating', 'url'=>array('index')),
	array('label'=>'Create GatewayUserMoodRating', 'url'=>array('create')),
	array('label'=>'View GatewayUserMoodRating', 'url'=>array('view', 'id'=>$model->gatewayUserMoodRatingId)),
	array('label'=>'Manage GatewayUserMoodRating', 'url'=>array('admin')),
);
?>

<h1>Update GatewayUserMoodRating <?php echo $model->gatewayUserMoodRatingId; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>