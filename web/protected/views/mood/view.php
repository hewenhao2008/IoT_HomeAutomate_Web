<?php
/* @var $this MoodController */
/* @var $model GatewayUserMoodRating */

$this->breadcrumbs=array(
	'Gateway User Mood Ratings'=>array('index'),
	$model->gatewayUserMoodRatingId,
);

$this->menu=array(
	array('label'=>'List GatewayUserMoodRating', 'url'=>array('index')),
	array('label'=>'Create GatewayUserMoodRating', 'url'=>array('create')),
	array('label'=>'Update GatewayUserMoodRating', 'url'=>array('update', 'id'=>$model->gatewayUserMoodRatingId)),
	array('label'=>'Delete GatewayUserMoodRating', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->gatewayUserMoodRatingId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GatewayUserMoodRating', 'url'=>array('admin')),
);
?>

<h1>View GatewayUserMoodRating #<?php echo $model->gatewayUserMoodRatingId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'gatewayUserMoodRatingId',
		'date',
		'rating',
		'gatewayMoodId',
	),
)); ?>
