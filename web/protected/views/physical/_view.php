<?php
/* @var $this PhysicalController */
/* @var $data GatewayUserPhysicalRating */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('gatewayUserPhysicalRatingId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->gatewayUserPhysicalRatingId), array('view', 'id'=>$data->gatewayUserPhysicalRatingId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gatewayUserId')); ?>:</b>
	<?php echo CHtml::encode($data->gatewayUserId); ?>
	<br />


</div>