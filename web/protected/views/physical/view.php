<?php
/* @var $this PhysicalController */
/* @var $model GatewayUserPhysicalRating */

$this->breadcrumbs=array(
	'Gateway User Physical Ratings'=>array('index'),
	$model->gatewayUserPhysicalRatingId,
);

$this->menu=array(
	array('label'=>'List GatewayUserPhysicalRating', 'url'=>array('index')),
	array('label'=>'Create GatewayUserPhysicalRating', 'url'=>array('create')),
	array('label'=>'Update GatewayUserPhysicalRating', 'url'=>array('update', 'id'=>$model->gatewayUserPhysicalRatingId)),
	array('label'=>'Delete GatewayUserPhysicalRating', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->gatewayUserPhysicalRatingId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GatewayUserPhysicalRating', 'url'=>array('admin')),
);
?>

<h1>View GatewayUserPhysicalRating #<?php echo $model->gatewayUserPhysicalRatingId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'gatewayUserPhysicalRatingId',
		'date',
		'rating',
		'gatewayUserId',
	),
)); ?>
