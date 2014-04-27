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

	<b><?php echo CHtml::encode($data->getAttributeLabel('temperature')); ?>:</b>
	<?php echo CHtml::encode($data->temperature); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reportingGateway_gatewayId')); ?>:</b>
	<?php echo CHtml::encode($data->reportingGateway_gatewayId); ?>
	<br />


</div>