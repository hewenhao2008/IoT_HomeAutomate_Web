<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reporting Users',
);

$this->menu=array(
	array('label'=>'Create ReportingUser', 'url'=>array('create'), 'visible'=>Yii::app()->user->getState("admin")),
	array('label'=>'Manage ReportingUser', 'url'=>array('admin'), 'visible'=>Yii::app()->user->getState("admin")),
);
?>

<h1>Reporting Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
