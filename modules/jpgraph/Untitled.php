<?php

//JPGraph Info
include ("jpgraph/jpgraph.php"); //Path to Jpgraph
include ("jpgraph/jpgraph_line.php"); //Path to Jpgraph
include ("jpgraph/jpgraph_date.php"); //Path to Jpgraph


@mysql_connect($host, $user, $pass) or die("Unable to connect");
mysql_select_db($db) or die("Unable to select database");

//SET THE COUNT FOR MOVING AVERAGE  (i.e. last 50 pc. average)
$precision = 20;

//GATHER THE DATA

$data = mysql_query ("SELECT Year, February FROM etemp");

while ($row=mysql_fetch_array($data)) {

  $ydata[] = $row['February'];
  $avedata[] = $row['February'];
  $xdata[] = $row['Year'];
  $RowCount++;
  }

//CALCULATE MOVING AVERAGES
while ($RowCount > 0)
{

$Divider = $precision;
$loopcount = 1;

WHILE ($loopcount < $precision) {

IF ($avedata[$Count - $loopcount] == 0) { $Divider--;}
$loopcount++;
}

$adder = 0;

WHILE ($adder < $precision) { $Average[$Count] = $Average[$Count] + $avedata[$Count - $adder];
$adder++; }

$Average[$Count] = $Average[$Count] / $Divider;


$Count++;
$RowCount--;
}

// Create the graph.
$graph = new Graph(700,500,"auto",30);
$graph->SetScale("textlin");
$graph->yaxis->scale->SetGrace(10);
$graph->SetMarginColor("white");

// Create a line pot
$lplot = new LinePlot($ydata);
$lplot->SetWeight(2);
$lplot->SetColor('#7070FE');

$sp1 = new LinePlot($Average);
$sp1->SetWeight(2);
$sp1->SetColor("red");


//Add plot
$graph->Add($lplot);
$graph->Add($sp1);

// titles
$graph->title->Set("Temperature ");
$graph->title->SetColor("black");
$graph->title->SetFont(FF_ARIAL,FS_BOLD,10);

//x-axis
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD,8);
$graph->xaxis->SetFont(FF_ARIAL,FS_BOLD,8);
$graph->xaxis->SetTitlemargin(25);
$graph->xaxis->Settitle("Year");
$graph->xaxis->SetLabelMargin(10);
$graph->xaxis->SetTickLabels($xdata);
$graph->xaxis->SetLabelAngle(45);
$graph->xaxis->SetTextLabelInterval(10);
$graph->xaxis->SetPos("min");
$graph->xaxis->HideTicks(true,true);
$graph->xaxis->SetColor("black");
$graph->xgrid->Show(true);

//y-axis
$graph->yaxis->SetFont(FF_ARIAL,FS_BOLD,8);
$graph->yaxis->SetColor("black");
$graph->yaxis->SetLabelFormat('%1.1f');
$graph->yaxis->HideTicks(true,true);

// Display the graph
$graph->Stroke();
