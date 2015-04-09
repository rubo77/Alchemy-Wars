<?
echo json_encode($game_var['game']);
echo json_encode($game_var['1']);
echo json_encode($visiblefield);
echo json_encode($fieldowner);


/*
unset ($x);
unset ($y);
unset ($a);
unset ($b);
unset ($j);
unset ($k);

$j=array();
$k=array();

$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');

for ($x=0; $x<2; $x++){
  for ($y=0; $y<3; $y++){
    $a["x"]=$x;
    $a["y"]=$y;
    $a["c"]='#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
    $j[]=$a;
  }
}

#echo json_encode($j);

for ($x=0; $x<2; $x++){
  for ($y=0; $y<3; $y++){
    $b["x"]=$x;
    $b["y"]=$y;
    $b["c"]='#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
    $k[]=$b;
  }
}

#echo json_encode($k);
*/
?>