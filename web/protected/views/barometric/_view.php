<?php
/* @var $this BarometricController */
/* @var $data BarometricPayload */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('barometricPayloadId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->barometricPayloadId), array('view', 'id'=>$data->barometricPayloadId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pressure')); ?>:</b>
	<?php echo CHtml::encode($data->pressure); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reportedLatitude')); ?>:</b>
	<?php echo CHtml::encode($data->reportedLatitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reportedLongitude')); ?>:</b>
	<?php echo CHtml::encode($data->reportedLongitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sensorIdentifier')); ?>:</b>
	<?php echo CHtml::encode($data->sensorIdentifier); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sensorManufacturer')); ?>:</b>
	<?php echo CHtml::encode($data->sensorManufacturer); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('temperature')); ?>:</b>
	<?php echo CHtml::encode($data->temperature); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gatewayId')); ?>:</b>
	<?php echo CHtml::encode($data->gatewayId); ?>
	<br />


</div>
