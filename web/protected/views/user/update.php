<?php
/* @var $this UserController */
/* @var $model ReportingUser */

$this->breadcrumbs=array(
	'Reporting Users'=>array('index'),
	$model->reportingUserId=>array('view','id'=>$model->reportingUserId),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReportingUser', 'url'=>array('index')),
	array('label'=>'Create ReportingUser', 'url'=>array('create')),
	array('label'=>'View ReportingUser', 'url'=>array('view', 'id'=>$model->reportingUserId)),
	array('label'=>'Manage ReportingUser', 'url'=>array('admin')),
);
?>

<h1>Update ReportingUser <?php echo $model->reportingUserId; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>