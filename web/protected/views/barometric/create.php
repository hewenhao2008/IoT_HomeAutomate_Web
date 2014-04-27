<?php
/* @var $this BarometricController */
/* @var $model BarometricPayload */

$this->breadcrumbs=array(
	'Barometric Payloads'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BarometricPayload', 'url'=>array('index')),
	array('label'=>'Manage BarometricPayload', 'url'=>array('admin')),
);
?>

<h1>Create BarometricPayload</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>