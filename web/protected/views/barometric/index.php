<?php
/* @var $this BarometricController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Barometric Payloads',
);

$this->menu=array(
	array('label'=>'Create BarometricPayload', 'url'=>array('create'), 'visible'=>Yii::app()->user->getState("admin")),
	array('label'=>'Manage BarometricPayload', 'url'=>array('admin'), 'visible'=>Yii::app()->user->getState("admin")),
);
?>

<h1>Barometric Payloads</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
