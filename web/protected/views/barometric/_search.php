<?php
/* @var $this BarometricController */
/* @var $model BarometricPayload */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'barometricPayloadId'); ?>
		<?php echo $form->textField($model,'barometricPayloadId',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pressure'); ?>
		<?php echo $form->textField($model,'pressure'); ?>
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
		<?php echo $form->label($model,'sensorIdentifier'); ?>
		<?php echo $form->textField($model,'sensorIdentifier',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sensorManufacturer'); ?>
		<?php echo $form->textField($model,'sensorManufacturer',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'temperature'); ?>
		<?php echo $form->textField($model,'temperature'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gatewayId'); ?>
		<?php echo $form->textField($model,'gatewayId',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
