<?php
/* @var $this UserController */
/* @var $model ReportingUser */

$this->breadcrumbs=array(
	'Reporting Users'=>array('index'),
	$model->reportingUserId,
);

$this->menu=array(
	array('label'=>'List ReportingUser', 'url'=>array('index')),
	array('label'=>'Create ReportingUser', 'url'=>array('create')),
	array('label'=>'Update ReportingUser', 'url'=>array('update', 'id'=>$model->reportingUserId)),
	array('label'=>'Delete ReportingUser', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->reportingUserId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ReportingUser', 'url'=>array('admin')),
);
?>

<h1>View ReportingUser #<?php echo $model->reportingUserId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'reportingUserId',
		'active',
		'firstName',
		'firstSeen',
		'lastName',
		'lastSeen',
		'password',
		'userName',
	),
)); ?>
