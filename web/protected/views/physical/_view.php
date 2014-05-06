<?php
/* @var $this PhysicalController */
/* @var $data ReportingUserPhysicalRating */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('reportingUserPhysicalRatingId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->reportingUserPhysicalRatingId), array('view', 'id'=>$data->reportingUserPhysicalRatingId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('matchConfidence')); ?>:</b>
	<?php echo CHtml::encode($data->matchConfidence); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reportedLatitude')); ?>:</b>
	<?php echo CHtml::encode($data->reportedLatitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reportedLongitude')); ?>:</b>
	<?php echo CHtml::encode($data->reportedLongitude); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('barometricPayloadId')); ?>:</b>
	<?php echo CHtml::encode($data->barometricPayloadId); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('reportingUserId')); ?>:</b>
	<?php echo CHtml::encode($data->reportingUserId); ?>
	<br />

	*/ ?>

</div>