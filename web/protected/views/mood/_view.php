<?php
/* @var $this MoodController */
/* @var $data GatewayUserMoodRating */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('gatewayUserMoodRatingId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->gatewayUserMoodRatingId), array('view', 'id'=>$data->gatewayUserMoodRatingId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gatewayMoodId')); ?>:</b>
	<?php echo CHtml::encode($data->gatewayMoodId); ?>
	<br />


</div>