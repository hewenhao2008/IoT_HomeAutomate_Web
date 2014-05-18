<?php

// force import of all required files for pChart
require_once(Yii::app()->basePath."/vendors/pchart/class/pDraw.class.php");
require_once(Yii::app()->basePath."/vendors/pchart/class/pImage.class.php");
require_once(Yii::app()->basePath."/vendors/pchart/class/pData.class.php");

class PlotController extends Controller
{
	public function actionIndex()
	{

		/* Create the pChart object */
 		$myPicture = new pImage(700,230);

 		/* Draw the background */
 		$Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107);
 		$myPicture->drawFilledRectangle(0,0,700,230,$Settings);

 		/* Overlay with a gradient */
 		$Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);
 		$myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,$Settings);
 		$myPicture->drawGradientArea(0,0,700,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>80));

 		/* Draw the picture border */ 
 		$myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0));
 
 		/* Write the picture title */ 
 		$myPicture->setFontProperties(array("FontName"=>Yii::app()->basePath."/vendors/pchart/fonts/Silkscreen.ttf","FontSize"=>6));
 		$myPicture->drawText(10,13,"drawLine() - Basis",array("R"=>255,"G"=>255,"B"=>255));

 		/* Turn on shadow computing */ 
 		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>20));

 		/* Draw some lines */ 
 		for($i=1;$i<=100;$i=$i+4)
  		$myPicture->drawLine($i+5,215,$i*7+5,30,array("R"=>rand(0,255),"G"=>rand(0,255),"B"=>rand(0,255),"Ticks"=>rand(0,4)));

 		/* Draw an horizontal dashed line with extra weight */
 		$myPicture->drawLine(370,160,650,160,array("R"=>0,"G"=>0,"B"=>0,"Ticks"=>4,"Weight"=>3));

 		/* Another example of extra weight */
 		$myPicture->drawLine(370,180,650,200,array("R"=>255,"G"=>255,"B"=>255,"Ticks"=>15,"Weight"=>1));

		header ('Content-type: image/png');
		$myPicture->Render(null);
		
	}

	public function actionMultiscale()
	{
		if(isset($_GET['data'])){
			$dataUrl=(string)$_GET['data'];
			$dataJson=urldecode($dataUrl);
			$data=json_decode($dataJson);
		}
		else
			throw new CHttpException(404,'invalid request');

		/* Create and populate the pData object */
		$MyData = new pData();
		$MyData->addPoints($data->rating,"Rating");
		$MyData->addPoints($data->temperature,"Temperature");
		$MyData->addPoints($data->pressure,"Pressure");
 		$MyData->setSerieWeight("Rating",2);
 		$MyData->setSerieTicks("Temperature",4);
 		$MyData->setSerieTicks("Pressure",4);

 		/* Create the pChart object */
 		$myPicture = new pImage(700,230,$MyData);

 		/* Turn of Antialiasing */
 		$myPicture->Antialias = FALSE;

 		/* Draw the background */
 		$Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107);
 		$myPicture->drawFilledRectangle(0,0,700,230,$Settings);

 		/* Overlay with a gradient */
 		$Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);
 		$myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,$Settings);
 		$myPicture->drawGradientArea(0,0,700,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>80));

 		/* Add a border to the picture */
 		$myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0));
 
 		/* Write the chart title */ 
 		$myPicture->setFontProperties(array("FontName"=>Yii::app()->basePath."/vendors/pchart/fonts/Aller_Rg.ttf","FontSize"=>8,"R"=>255,"G"=>255,"B"=>255));
 		$myPicture->drawText(10,18,$data->type.' Relative to Temperature and Pressure',array("FontSize"=>9,"Align"=>TEXT_ALIGN_BOTTOMLEFT));

 		/* Set the default font */
 		$myPicture->setFontProperties(array("FontName"=>Yii::app()->basePath."/vendors/pchart/fonts//pf_arma_five.ttf","FontSize"=>6,"R"=>0,"G"=>0,"B"=>0));

 		/* Define the chart area */
 		$myPicture->setGraphArea(60,40,650,200);

 		/* Draw the scale */
 		$scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
 		$myPicture->drawScale($scaleSettings);

 		/* Turn on Antialiasing */
 		$myPicture->Antialias = TRUE;

 		/* Enable shadow computing */
 		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

 		/* Draw the line chart */
 		$myPicture->drawLineChart();
 		$myPicture->drawPlotChart(array("DisplayValues"=>FALSE,"PlotBorder"=>TRUE,"BorderSize"=>2,"Surrounding"=>-60,"BorderAlpha"=>80));

 		/* Write the chart legend */
 		$myPicture->drawLegend(530,9,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL, "FontR"=>255,"FontG"=>255,"FontB"=>255));

		header ('Content-type: image/png');
		$myPicture->Render(null);
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
