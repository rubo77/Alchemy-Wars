<?
$SQL = "DELETE FROM effects WHERE end_round<'".$round."'";
$Result = query($SQL);


#movement
$SQL = "SELECT value,target_object FROM effects WHERE effect='movement' && start_round<='".$round."' && game='".$game."'";
$Result = query($SQL);
for ($a=0; $a<mysqli_num_rows($Result);$a++)
{
  $Resultrow = $Result->fetch_assoc();
  $objectflag = $Resultrow['target_object'];
  if ($movement[$objectflag] ==  0)
  {
    $movement[$objectflag] = 1;
  }
  $movement[$objectflag] = $movement[$objectflag] * $Resultrow['value'];
}
if (count($movement) > 0)
{
  $keyflag = array_keys($movement);
  for ($a=0; $a < count($keyflag); $a++)
  {
    #echo $keyflag[$a].'*'.$wound[$keyflag[$a]].'<br>';
    $SQL = "SELECT field FROM boardobjects WHERE id='".$keyflag[$a]."' && game='".$game."'";
    $Result = query($SQL);
    if(mysqli_num_rows($Result) == 1)
    {
      $Resultrow = $Result->fetch_assoc();
      $fieldflag = $Resultrow['field'];
      $boardobject[$fieldflag]['move'] = round($boardobject[$fieldflag]['move'] * $movement[$keyflag[$a]]);
      if ($selectedobject['id'] == $boardobject[$fieldflag]['id'])
      {
        $selectedobject['move'] = round($selectedobject['move'] * $movement[$keyflag[$a]]);
      }
    }
  }
}

#wound
$SQL = "SELECT value,target_object FROM effects WHERE effect='wound' && start_round<='".$round."' && game='".$game."'";
$Result = query($SQL);
for ($a=0; $a<mysqli_num_rows($Result);$a++)
{
  $Resultrow = $Result->fetch_assoc();
  $objectflag = $Resultrow['target_object'];
  $wound[$objectflag] += $Resultrow['value'];
}
if (count($wound) > 0)
{
  $keyflag = array_keys($wound);
  for ($a=0; $a < count($keyflag); $a++)
  {
    #echo $keyflag[$a].'*'.$wound[$keyflag[$a]].'<br>';
    $SQL = "SELECT field FROM boardobjects WHERE id='".$keyflag[$a]."' && game='".$game."'";
    $Result = query($SQL);
    if(mysqli_num_rows($Result) == 1)
    {
      $Resultrow = $Result->fetch_assoc();
      $fieldflag = $Resultrow['field'];
      $boardobject[$fieldflag]['live'] -= $wound[$keyflag[$a]];
      if ($selectedobject['id'] == $boardobject[$fieldflag]['id'])
      {
        $selectedobject['live'] -= $wound[$keyflag[$a]];
      }

      if ($boardobject[$fieldflag]['live'] <= 0)
      {
        $SQL = "DELETE FROM boardobjects WHERE field='".$fieldflag."' && game='".$game."'";
        query($SQL);
        $SQL = "DELETE FROM effects WHERE target_object='".$boardobject[$fieldflag]['id']."' && game='".$game."'";
        query($SQL);
        unset ($boardobject[$fieldflag]);
        if ($selectedobject['id'] == $boardobject[$fieldflag]['id'])
        {
          unset($selectedobject);
        }
      }
    }
  }
}
?>