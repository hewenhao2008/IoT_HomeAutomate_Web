<?php
/* @var $this SensorController */
/* @var $data BarometricPayload */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('barometricPayloadId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->barometricPayloadId), array('barometric/view', 'id'=>$data->barometricPayloadId)); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('temperature')); ?>:</b>
	<?php echo CHtml::encode($data->temperature); ?>
	<br />

</div>
