<?php
/* @var $this MoodController */
/* @var $model GatewayUserMoodRating */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gateway-user-mood-rating-form',
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
		<?php echo $form->labelEx($model,'rating'); ?>
		<?php echo $form->textField($model,'rating'); ?>
		<?php echo $form->error($model,'rating'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gatewayMoodId'); ?>
		<?php echo $form->textField($model,'gatewayMoodId',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'gatewayMoodId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->