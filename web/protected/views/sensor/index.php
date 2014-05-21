<?php
/* @var $this SensorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sensors',
);
?>

<h1>Sensors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
