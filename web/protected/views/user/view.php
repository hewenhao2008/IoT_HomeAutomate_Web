<?php
/* @var $this UserController */
/* @var $model GatewayUser */

$this->breadcrumbs=array(
	'Gateway Users'=>array('index'),
	$model->gatewayUserId,
);

$this->menu=array(
	array('label'=>'List GatewayUser', 'url'=>array('index')),
	array('label'=>'Create GatewayUser', 'url'=>array('create')),
	array('label'=>'Update GatewayUser', 'url'=>array('update', 'id'=>$model->gatewayUserId)),
	array('label'=>'Delete GatewayUser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->gatewayUserId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GatewayUser', 'url'=>array('admin')),
);
?>

<h1>View GatewayUser #<?php echo $model->gatewayUserId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'gatewayUserId',
		'active',
		'firstName',
		'firstSeen',
		'lastName',
		'lastSeen',
		'password',
		'userName',
		'gatewayId',
	),
)); ?>
