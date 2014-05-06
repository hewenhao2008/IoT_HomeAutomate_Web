<?php
/* @var $this UserController */
/* @var $model ReportingUser */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reporting-user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'firstName'); ?>
		<?php echo $form->textField($model,'firstName',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'firstName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'firstSeen'); ?>
		<?php echo $form->textField($model,'firstSeen'); ?>
		<?php echo $form->error($model,'firstSeen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastName'); ?>
		<?php echo $form->textField($model,'lastName',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'lastName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastSeen'); ?>
		<?php echo $form->textField($model,'lastSeen'); ?>
		<?php echo $form->error($model,'lastSeen'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'userName'); ?>
		<?php echo $form->textField($model,'userName',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'userName'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->