<?php
/* @var $this UserController */
/* @var $model GatewayUser */

$this->breadcrumbs=array(
	'Gateway Users'=>array('index'),
	$model->gatewayUserId=>array('view','id'=>$model->gatewayUserId),
	'Update',
);

$this->menu=array(
	array('label'=>'List GatewayUser', 'url'=>array('index')),
	array('label'=>'Create GatewayUser', 'url'=>array('create')),
	array('label'=>'View GatewayUser', 'url'=>array('view', 'id'=>$model->gatewayUserId)),
	array('label'=>'Manage GatewayUser', 'url'=>array('admin')),
);
?>

<h1>Update GatewayUser <?php echo $model->gatewayUserId; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>