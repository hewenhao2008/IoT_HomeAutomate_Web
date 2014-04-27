<?php
/* @var $this PhysicalController */
/* @var $model GatewayUserPhysicalRating */

$this->breadcrumbs=array(
	'Gateway User Physical Ratings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GatewayUserPhysicalRating', 'url'=>array('index')),
	array('label'=>'Manage GatewayUserPhysicalRating', 'url'=>array('admin')),
);
?>

<h1>Create GatewayUserPhysicalRating</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>