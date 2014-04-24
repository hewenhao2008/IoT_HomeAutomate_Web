<?php
/* @var $this BarometricController */
/* @var $model BarometricPayload */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'barometric-payload-form',
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
		<?php echo $form->labelEx($model,'pressure'); ?>
		<?php echo $form->textField($model,'pressure'); ?>
		<?php echo $form->error($model,'pressure'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'temperature'); ?>
		<?php echo $form->textField($model,'temperature'); ?>
		<?php echo $form->error($model,'temperature'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reportingGateway_gatewayId'); ?>
		<?php echo $form->textField($model,'reportingGateway_gatewayId',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'reportingGateway_gatewayId'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->