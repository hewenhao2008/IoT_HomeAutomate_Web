<?php
/* @var $this PhysicalController */
/* @var $model ReportingUserPhysicalRating */

$this->breadcrumbs=array(
	'Reporting User Physical Ratings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReportingUserPhysicalRating', 'url'=>array('index')),
	array('label'=>'Manage ReportingUserPhysicalRating', 'url'=>array('admin')),
);
?>

<h1>Create ReportingUserPhysicalRating</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>