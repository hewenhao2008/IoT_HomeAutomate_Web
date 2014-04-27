<?php
/* @var $this UserController */
/* @var $data GatewayUser */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('gatewayUserId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->gatewayUserId), array('view', 'id'=>$data->gatewayUserId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firstName')); ?>:</b>
	<?php echo CHtml::encode($data->firstName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firstSeen')); ?>:</b>
	<?php echo CHtml::encode($data->firstSeen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastName')); ?>:</b>
	<?php echo CHtml::encode($data->lastName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastSeen')); ?>:</b>
	<?php echo CHtml::encode($data->lastSeen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('userName')); ?>:</b>
	<?php echo CHtml::encode($data->userName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gatewayId')); ?>:</b>
	<?php echo CHtml::encode($data->gatewayId); ?>
	<br />

	*/ ?>

</div>