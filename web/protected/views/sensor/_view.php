<?php
/* @var $this SensorController */
/* @var $data BarometricPayload */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sensorIdentifier')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sensorIdentifier), array('view', 'id'=>$data->sensorIdentifier)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sensorManufacturer')); ?>:</b>
	<?php echo CHtml::encode($data->sensorManufacturer); ?>
	<br />

</div>
