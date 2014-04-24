<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gateway Users',
);

$this->menu=array(
	array('label'=>'Create GatewayUser', 'url'=>array('create')),
	array('label'=>'Manage GatewayUser', 'url'=>array('admin')),
);
?>

<h1>Gateway Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
