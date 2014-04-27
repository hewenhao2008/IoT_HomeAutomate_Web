<?php
/* @var $this PhysicalController */
/* @var $model GatewayUserPhysicalRating */

$this->breadcrumbs=array(
	'Gateway User Physical Ratings'=>array('index'),
	$model->gatewayUserPhysicalRatingId=>array('view','id'=>$model->gatewayUserPhysicalRatingId),
	'Update',
);

$this->menu=array(
	array('label'=>'List GatewayUserPhysicalRating', 'url'=>array('index')),
	array('label'=>'Create GatewayUserPhysicalRating', 'url'=>array('create')),
	array('label'=>'View GatewayUserPhysicalRating', 'url'=>array('view', 'id'=>$model->gatewayUserPhysicalRatingId)),
	array('label'=>'Manage GatewayUserPhysicalRating', 'url'=>array('admin')),
);
?>

<h1>Update GatewayUserPhysicalRating <?php echo $model->gatewayUserPhysicalRatingId; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>