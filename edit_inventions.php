<?
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once ('server.php');



$SQL = "SELECT id FROM objectbase ORDER BY id";
$Result = query($SQL);
for ($a=0; $a<mysqli_num_rows($Result); $a++)
{
  $Resultrow = $Result->fetch_assoc();
  $object[] = $Resultrow['id'];
}

$selected_object = gettest($_REQUEST['form_selected_object']);
if (gettest($_REQUEST['submit']) == 'Edit' && $selected_object != '')
{
  #$SQL = "TRUNCATE inventionbase";
  #query($SQL);
  #echo $SQL.'<br><br>';



  $SQL = "DELETE FROM inventionbase WHERE base1='".$selected_object."' || base2='".$selected_object."'";
  query($SQL);
  #echo $SQL.'<br><br>';

  for ($a=0; $a<count($object); $a++)
  {
    $value= gettest($_REQUEST['form_'.$object[$a].'_'.$selected_object]);
    if ($value != '')
    {
      $SQL = "INSERT INTO inventionbase (id,base1,base2,result) VALUES ('".create_id('inventionbase','id')."','".$object[$a]."','".$selected_object."','".$value."')";
      query($SQL);
      #echo $SQL.'<br><br>';
    }
  }

  #qqq abgeschnittene tabelle
  /*
  for ($a=0; $a<count($object); $a++)
  {
    for ($b=0; $b<=$a; $b++)
    {
      $value = gettest($_REQUEST['form_'.$object[$a].'_'.$object[$b]]);
      if ($value != '')
      {
        $SQL = "INSERT INTO inventionbase (id,base1,base2,result) VALUES ('".create_id('inventionbase','id')."','".$object[$a]."','".$object[$b]."','".$value."')";
        query($SQL);
        #echo $SQL.'<br><br>';
      }
    }
  }
  */
}
#var_dump($_REQUEST);
#isset



$SQL = "SELECT * FROM inventionbase";
$Result = query($SQL);
$idnum = mysqli_num_rows($Result);
for ($a=0; $a<mysqli_num_rows($Result); $a++)
{
  $Resultrow = $Result->fetch_assoc();
  $inventid[$Resultrow['base1']][$Resultrow['base2']] = $Resultrow['id'];
  $inventresult[$Resultrow['base1']][$Resultrow['base2']] = $Resultrow['result'];
}



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name=viewport content="width=600px,initial-scale=1">
<link rel=stylesheet type="text/css" href="style.css">
<title>Game</title>
<meta name="language" content="DE">
<meta name="keywords" lang="de" content="Game">
<meta name="description" content="Tolle Game.">
<meta name="revisit-after" content="14 days">
</head>

<body>
<?
echo '<form name=invents action="'.$PHP_SELF.'" method=post>';
echo 'Selected Object: <input size=6 name="form_selected_object" type="text" value="'.$selected_object.'"/> <input name="submit" type="submit" value="Load"/>';

if ($selected_object != '')
{
  echo '<table border=1>';
  echo '<tr><td>X</td>';
  echo '<td>'.$selected_object.'</td>';
  echo '</tr>';

  for ($a=0; $a<count($object); $a++)
  {
    echo '<tr><td>'.$object[$a].'</td>';
    echo '<td><input size=6 name="form_'.$object[$a].'_'.$selected_object.'" type="text" value="'.$inventresult[$object[$a]][$selected_object].'"/></td>';

    echo '</tr>';
  }
  echo '<tr><td colspan='.(count($object)+1).'><input style="width:100%;" name="submit" type="submit" value="Edit"/></td></tr>';
  echo '</table>';
}
else
{
  echo '<table border=1>';
  echo '<tr><td>X</td>';
  for ($b=0; $b<count($object); $b++)
  {
    echo '<td>'.$object[$b].'</td>';
  }
  echo '</tr>';

  for ($a=0; $a<count($object); $a++)
  {
    echo '<tr><td>'.$object[$a].'</td>';
    for ($b=0; $b<=$a; $b++)
    {
      echo '<td>'.$inventresult[$object[$a]][$object[$b]].'</td>';
    }
    echo '</tr>';
  }
  echo '</table>';
}
echo '</form>';
?>
</body></html>