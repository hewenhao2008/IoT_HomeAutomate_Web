<?php
/* @var $this PhysicalController */
/* @var $model ReportingUserPhysicalRating */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reporting-user-physical-rating-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'matchConfidence'); ?>
		<?php echo $form->textField($model,'matchConfidence'); ?>
		<?php echo $form->error($model,'matchConfidence'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reportedLatitude'); ?>
		<?php echo $form->textField($model,'reportedLatitude'); ?>
		<?php echo $form->error($model,'reportedLatitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reportedLongitude'); ?>
		<?php echo $form->textField($model,'reportedLongitude'); ?>
		<?php echo $form->error($model,'reportedLongitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rating'); ?>
		<?php echo $form->textField($model,'rating'); ?>
		<?php echo $form->error($model,'rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'barometricPayloadId'); ?>
		<?php echo $form->textField($model,'barometricPayloadId',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'barometricPayloadId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reportingUserId'); ?>
		<?php echo $form->textField($model,'reportingUserId',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'reportingUserId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->