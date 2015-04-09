<?php
$j=array();

$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

for ($x=0; $x<15; $x++){
	for ($y=0; $y<10; $y++){
		$a["x"]=$x;
		$a["y"]=$y;
		$a["c"]='#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
		$j[]=$a;
	}
}
echo json_encode($j);