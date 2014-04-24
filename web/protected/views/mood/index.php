<?php
/* @var $this MoodController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gateway User Mood Ratings',
);

$this->menu=array(
	array('label'=>'Create GatewayUserMoodRating', 'url'=>array('create')),
	array('label'=>'Manage GatewayUserMoodRating', 'url'=>array('admin')),
);
?>

<h1>Gateway User Mood Ratings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
