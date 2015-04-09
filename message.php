<?
  $SQL = "SELECT player,round,message FROM message where game='".$game."' ORDER BY time DESC";
  $Result = query($SQL);
  for ($a=0; $a<mysqli_num_rows($Result); $a++)
  {
    $Resultrow = $Result->fetch_assoc();
    if ($Resultrow['round'] %2 == 0)
    {
      echo '<font color=blue>Runde '.$Resultrow['round'].': </font>';
    }
    else
    {
      echo '<font color=yellow>Runde '.$Resultrow['round'].': </font>';
    }

    if ($Resultrow['player'] == $currentplayer)
    {
      echo '<font color=green>'.$Resultrow['message'].'</font><br>';
    }
    else
    {
      echo '<font color=red>'.$Resultrow['message'].'</font><br>';
    }
  }
?>