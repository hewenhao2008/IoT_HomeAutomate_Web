<?php
/* @var $this PhysicalController */
/* @var $model ReportingUserPhysicalRating */

$this->breadcrumbs=array(
	'Reporting User Physical Ratings'=>array('index'),
	$model->reportingUserPhysicalRatingId=>array('view','id'=>$model->reportingUserPhysicalRatingId),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReportingUserPhysicalRating', 'url'=>array('index')),
	array('label'=>'Create ReportingUserPhysicalRating', 'url'=>array('create')),
	array('label'=>'View ReportingUserPhysicalRating', 'url'=>array('view', 'id'=>$model->reportingUserPhysicalRatingId)),
	array('label'=>'Manage ReportingUserPhysicalRating', 'url'=>array('admin')),
);
?>

<h1>Update ReportingUserPhysicalRating <?php echo $model->reportingUserPhysicalRatingId; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>