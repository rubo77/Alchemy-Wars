<?
#get game_vars from database
$SQL = "SELECT player,variable,value FROM gamevars WHERE game='".$game."'";
$Result = query($SQL);
for ($a=0; $a<mysqli_num_rows($Result);$a++)
{
  $Resultrow = $Result->fetch_assoc();
  $game_var[$Resultrow['player']][$Resultrow['variable']] = $Resultrow['value'];
}
$game_var_before = $game_var;


#qqq alle gets möglichst datenbank nahe gestalten...

#$selectedobject




#get fieldowner from database
unset ($fieldowner);
unset ($fieldsowned);
unset ($visiblefield);
$SQL = "SELECT * FROM fieldowner WHERE game='".$game."'";
$Result = query($SQL);
for ($a=0; $a<mysqli_num_rows($Result);$a++)
{
  $Resultrow = $Result->fetch_assoc();
  $fieldowner[$Resultrow['field']] = $Resultrow['player'];
  $fieldsowned[$Resultrow['player']]++;
  if ($fieldowner[$Resultrow['field']] == $currentplayer)
  {
    $flag = explode('*',$Resultrow['field']);
    {
      for ($xflag = max(1,$flag[0]-1); $xflag <= min($board_width,$flag[0]+1); $xflag++)
      {
        for ($yflag = max(1,$flag[1]-1); $yflag <= min($board_height,$flag[1]+1); $yflag++)
        {
          $visiblefield[$xflag.'*'.$yflag] = true;
        }
      }
    }
  }
}
$fieldowner_before = $fieldowner;


#qqq hier fehlt noch der objectname!!
#get board object
unset ($boardobject);
unset ($creatureprice);
unset ($buildingprice);
for ($a=1; $a<= $playercount; $a++)
{
  $creatureprice[$a] = 1;
  $buildingprice[$a] = 1;
}
$SQL = "SELECT bo.*, ob.name, ob.buildtype, ob.cost, ob.text, ob.icon,ob.spell, ob.creatureprice,ob.buildingprice FROM boardobjects as bo LEFT JOIN objectbase as ob ON bo.name = ob.id where game='".$game."'";
$Result = query($SQL);
for ($a=0; $a<mysqli_num_rows($Result);$a++)
{
  $Resultrow = $Result->fetch_assoc();
  $fieldflag = $Resultrow['field'];
  $boardobject[$fieldflag]['id'] = $Resultrow['id'];
  $boardobject[$fieldflag]['player'] = $Resultrow['player'];
  $boardobject[$fieldflag]['name'] = $Resultrow['name'];
  $boardobject[$fieldflag]['buildtype'] = $Resultrow['buildtype'];
  $boardobject[$fieldflag]['cost'] = $Resultrow['cost'];
  $boardobject[$fieldflag]['move'] = $Resultrow['move'];
  $boardobject[$fieldflag]['weaponattack'] = $Resultrow['weaponattack'];
  $boardobject[$fieldflag]['attack'] = $Resultrow['attack'] + $Resultrow['weaponattack'];
  $boardobject[$fieldflag]['armor'] = $Resultrow['armor'];
  $boardobject[$fieldflag]['live'] = $Resultrow['live'];
  $boardobject[$fieldflag]['maxlive'] = $Resultrow['maxlive'];
  $boardobject[$fieldflag]['text'] = $Resultrow['text'];
  $boardobject[$fieldflag]['icon'] = $Resultrow['icon'];
  $boardobject[$fieldflag]['spell'] = $Resultrow['spell'];
  $boardobject[$fieldflag]['creatureprice'] = $Resultrow['creatureprice'];
  $boardobject[$fieldflag]['buildingprice'] = $Resultrow['buildingprice'];
  $boardobject[$fieldflag]['rangedattack'] = $Resultrow['rangedattack'];
  $boardobject[$fieldflag]['firststrike'] = $Resultrow['firststrike'];


  #if ($a==0) var_dump($Resultrow);



  if ($boardobject[$fieldflag]['creatureprice'] > 0)
  {
    $creatureprice[$Resultrow['player']] = $creatureprice[$Resultrow['player']] * $boardobject[$fieldflag]['creatureprice'];
  }
  if ($boardobject[$fieldflag]['buildingprice'] > 0)
  {
    $buildingprice[$Resultrow['player']] = $buildingprice[$Resultrow['player']] * $boardobject[$fieldflag]['buildingprice'];
  }
}



#get inventions from database
/*
unset ($invention);
$SQL = "SELECT i.object,i.player,o.icon FROM inventions as i LEFT JOIN objectbase as o ON i.object=o.id WHERE i.game='".$game."' ORDER BY o.name";
$Result = query($SQL);
for ($a=0; $a<mysqli_num_rows($Result);$a++)
{
  $Resultrow = $Result->fetch_assoc();
  $invention[$Resultrow['player']][] = $Resultrow['object'];
  $invention_icon[$Resultrow['player']][] = $Resultrow['icon'];
}
*/


#get inventions from database
unset ($invention);
$SQL = "SELECT i.*, ob.* FROM inventions as i LEFT JOIN objectbase as ob ON i.object = ob.id where game='".$game."' && player='".$currentplayer."' ORDER BY ob.name";
$Result = query($SQL);
for ($a=0; $a<mysqli_num_rows($Result);$a++)
{
  $Resultrow = $Result->fetch_assoc();
  $playerflag = $Resultrow['player'];
  $invention[$playerflag][$a+1]['id'] = $Resultrow['id'];
  $invention[$playerflag][$a+1]['name'] = $Resultrow['name'];
  $invention[$playerflag][$a+1]['buildtype'] = $Resultrow['buildtype'];
  $invention[$playerflag][$a+1]['cost'] = $Resultrow['cost'];
  $invention[$playerflag][$a+1]['move'] = $Resultrow['move'];
  $invention[$playerflag][$a+1]['weaponattack'] = $Resultrow['weaponattack'];
  $invention[$playerflag][$a+1]['attack'] = $Resultrow['attack'] + $Resultrow['weaponattack'];
  $invention[$playerflag][$a+1]['armor'] = $Resultrow['armor'];
  $invention[$playerflag][$a+1]['live'] = $Resultrow['live'];
  $invention[$playerflag][$a+1]['maxlive'] = $Resultrow['maxlive'];
  $invention[$playerflag][$a+1]['text'] = $Resultrow['text'];
  $invention[$playerflag][$a+1]['icon'] = $Resultrow['icon'];
  $invention[$playerflag][$a+1]['spell'] = $Resultrow['spell'];
  $invention[$playerflag][$a+1]['creatureprice'] = $Resultrow['creatureprice'];
  $invention[$playerflag][$a+1]['buildingprice'] = $Resultrow['buildingprice'];
  $invention[$playerflag][$a+1]['rangedattack'] = $Resultrow['rangedattack'];
  $invention[$playerflag][$a+1]['firststrike'] = $Resultrow['firststrike'];
}

#qqg das brauche ich dann nicht mehr
#include ('get_selected_object.php');

if (substr($game_var[$currentplayer]['selected'],0,6) == 'stock*')
{
  $selectedobject = $invention[$currentplayer][substr($game_var[$currentplayer]['selected'],6,strlen($game_var[$currentplayer]['selected'])-6)];
  echo '*'.substr($game_var[$currentplayer]['selected'],6,strlen($game_var[$currentplayer]['selected'])-6).'*';
}
elseif (substr($game_var[$currentplayer]['selected'],0,6) == 'board*')
{
  $selectedobject = $boardobject[substr($game_var[$currentplayer]['selected'],6,strlen($game_var[$currentplayer]['selected'])-6)];
  echo '*'.substr($game_var[$currentplayer]['selected'],6,strlen($game_var[$currentplayer]['selected'])-6).'*';
}

?>