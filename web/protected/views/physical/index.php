<?php
/* @var $this PhysicalController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gateway User Physical Ratings',
);

$this->menu=array(
	array('label'=>'Create GatewayUserPhysicalRating', 'url'=>array('create')),
	array('label'=>'Manage GatewayUserPhysicalRating', 'url'=>array('admin')),
);
?>

<h1>Gateway User Physical Ratings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
