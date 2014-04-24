<?php
/* @var $this UserController */
/* @var $model GatewayUser */

$this->breadcrumbs=array(
	'Gateway Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GatewayUser', 'url'=>array('index')),
	array('label'=>'Manage GatewayUser', 'url'=>array('admin')),
);
?>

<h1>Create GatewayUser</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>