<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $moodData = Plotter::scatterMoodData(); ?>
<?php $physicalData = Plotter::scatterPhysicalData(); ?>

<table style="width:100%">
<tr>
<td>
<?php
$moodData['type']="Coorelation of Mood with Pressure";
$moodData['series']=1;
$encodedMoodData = urlencode(json_encode($moodData));
echo CHtml::image(Yii::app()->request->baseUrl.$this->createUrl('plot/scatter',array('data'=>$encodedMoodData) )); 
?>
</td>
<td>
<?php
$physicalData['type']="Coorelation of Physical with Pressure";
$physicalData['series']=1;
$encodedPhysicalData = urlencode(json_encode($physicalData));
$url = Yii::app()->request->baseUrl.$this->createUrl('plot/scatter',array('data'=>$encodedPhysicalData) );
echo CHtml::image(Yii::app()->request->baseUrl.$this->createUrl('plot/scatter',array('data'=>$encodedPhysicalData) )); 
?>
</td>
</tr>
</table> 
