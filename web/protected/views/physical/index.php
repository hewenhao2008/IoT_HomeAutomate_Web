<?php
/* @var $this PhysicalController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reporting User Physical Ratings',
);

$this->menu=array(
	array('label'=>'Create ReportingUserPhysicalRating', 'url'=>array('create')),
	array('label'=>'Manage ReportingUserPhysicalRating', 'url'=>array('admin')),
);
?>

<h1>Reporting User Physical Ratings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
