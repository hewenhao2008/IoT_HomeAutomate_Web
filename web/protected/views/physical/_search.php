<?php
/* @var $this PhysicalController */
/* @var $model ReportingUserPhysicalRating */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'reportingUserPhysicalRatingId'); ?>
		<?php echo $form->textField($model,'reportingUserPhysicalRatingId',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'matchConfidence'); ?>
		<?php echo $form->textField($model,'matchConfidence'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reportedLatitude'); ?>
		<?php echo $form->textField($model,'reportedLatitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reportedLongitude'); ?>
		<?php echo $form->textField($model,'reportedLongitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rating'); ?>
		<?php echo $form->textField($model,'rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'barometricPayloadId'); ?>
		<?php echo $form->textField($model,'barometricPayloadId',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reportingUserId'); ?>
		<?php echo $form->textField($model,'reportingUserId',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->