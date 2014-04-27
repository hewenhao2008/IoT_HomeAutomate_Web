<?php
/* @var $this BarometricController */
/* @var $model BarometricPayload */

$this->breadcrumbs=array(
	'Barometric Payloads'=>array('index'),
	$model->barometricPayloadId=>array('view','id'=>$model->barometricPayloadId),
	'Update',
);

$this->menu=array(
	array('label'=>'List BarometricPayload', 'url'=>array('index')),
	array('label'=>'Create BarometricPayload', 'url'=>array('create')),
	array('label'=>'View BarometricPayload', 'url'=>array('view', 'id'=>$model->barometricPayloadId)),
	array('label'=>'Manage BarometricPayload', 'url'=>array('admin')),
);
?>

<h1>Update BarometricPayload <?php echo $model->barometricPayloadId; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>