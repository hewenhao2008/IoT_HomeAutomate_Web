<?php
/* @var $this UserController */
/* @var $model ReportingUser */

$this->breadcrumbs=array(
	'Reporting Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReportingUser', 'url'=>array('index')),
	array('label'=>'Manage ReportingUser', 'url'=>array('admin')),
);
?>

<h1>Create ReportingUser</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>