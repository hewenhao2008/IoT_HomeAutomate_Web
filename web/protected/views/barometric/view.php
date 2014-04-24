<?php
/* @var $this BarometricController */
/* @var $model BarometricPayload */

$this->breadcrumbs=array(
	'Barometric Payloads'=>array('index'),
	$model->barometricPayloadId,
);

$this->menu=array(
	array('label'=>'List BarometricPayload', 'url'=>array('index')),
	array('label'=>'Create BarometricPayload', 'url'=>array('create')),
	array('label'=>'Update BarometricPayload', 'url'=>array('update', 'id'=>$model->barometricPayloadId)),
	array('label'=>'Delete BarometricPayload', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->barometricPayloadId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BarometricPayload', 'url'=>array('admin')),
);
?>

<h1>View BarometricPayload #<?php echo $model->barometricPayloadId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'barometricPayloadId',
		'date',
		'pressure',
		'temperature',
		'reportingGateway_gatewayId',
	),
)); ?>
