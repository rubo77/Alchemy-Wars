<?
/*
#get selected object
unset ($selectedobject);
if (substr($game_var[$currentplayer]['selected'],0,6) == 'stock*')
{
  $SQL = "SELECT * FROM objectbase where id='".$invention[$currentplayer][substr($game_var[$currentplayer]['selected'],6,strlen($game_var[$currentplayer]['selected'])-6)-1]."'";
  $Result = query($SQL);
  if (mysqli_num_rows($Result) == 1)
  {
    $Resultrow = $Result->fetch_assoc();
    $selectedobject['id'] = $Resultrow['id'];
    $selectedobject['name'] = $Resultrow['name'];
    $selectedobject['buildtype'] = $Resultrow['buildtype'];
    $selectedobject['cost'] = $Resultrow['cost'];
    $selectedobject['move'] = $Resultrow['move'];
    $selectedobject['attack'] = $Resultrow['attack'] + $Resultrow['weaponattack'];
    $selectedobject['armor'] = $Resultrow['armor'];
    $selectedobject['live'] = $Resultrow['live'];
    $selectedobject['maxlive'] = $Resultrow['maxlive'];
    $selectedobject['text'] = $Resultrow['text'];
    $selectedobject['icon'] = $Resultrow['icon'];
    $selectedobject['spell'] = $Resultrow['spell'];
    $selectedobject['creatureprice'] = $Resultrow['creatureprice'];
    $selectedobject['buildingprice'] = $Resultrow['buildingprice'];
    $selectedobject['rangedattack'] = $Resultrow['rangedattack'];
    $selectedobject['firststrike'] = $Resultrow['firststrike'];
  }
}
elseif (substr($game_var[$currentplayer]['selected'],0,6) == 'board*')
{
  $fieldflag = substr($game_var[$currentplayer]['selected'],6,strlen($game_var[$currentplayer]['selected'])-6);
  $selectedobject['id'] = $boardobject[$fieldflag]['id'];
  $selectedobject['player'] = $boardobject[$fieldflag]['player'];
  $selectedobject['name'] = $boardobject[$fieldflag]['name'];
  $selectedobject['buildtype'] = $boardobject[$fieldflag]['buildtype'];
  $selectedobject['cost'] = $boardobject[$fieldflag]['cost'];
  $selectedobject['move'] = $boardobject[$fieldflag]['move'];
  $selectedobject['attack'] = $boardobject[$fieldflag]['attack'];
  $selectedobject['armor'] = $boardobject[$fieldflag]['armor'];
  $selectedobject['live'] = $boardobject[$fieldflag]['live'];
  $selectedobject['maxlive'] = $boardobject[$fieldflag]['maxlive'];
  $selectedobject['text'] = $boardobject[$fieldflag]['text'];
  $selectedobject['icon'] = $boardobject[$fieldflag]['icon'];
  $selectedobject['spell'] = $boardobject[$fieldflag]['spell'];
  $selectedobject['creatureprice'] = $boardobject[$fieldflag]['creatureprice'];
  $selectedobject['buildingprice'] = $boardobject[$fieldflag]['buildingprice'];
  $selectedobject['rangedattack'] = $boardobject[$fieldflag]['rangedattack'];
  $selectedobject['firststrike'] = $boardobject[$fieldflag]['firststrike'];
}

if ($selectedobject['buildtype'] == 'creature')
{
  $selectedobject['cost'] = round($selectedobject['cost'] * $creatureprice[$currentplayer]);
}
elseif ($selectedobject['buildtype'] == 'building')
{
  $selectedobject['cost'] = round($selectedobject['cost'] * $buildingprice[$currentplayer]);
}
*/
?>