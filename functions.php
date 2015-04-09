<?
function do_damage($field,$damage)
{
  global $boardobject;
  global $game;

  #var_dump($boardobject);

  if ($boardobject[$field]['id'] != '')
  {
    $damage -= $boardobject[$field]['armor'];
    if ($damage >= $boardobject[$field]['live'])
    {
      delete_boardobject($field);
      echo 'kill';
      $return = 'kill';
    }
    elseif($damage > 0)
    {
      $SQL = "UPDATE boardobjects SET live=live-'".$damage."' WHERE id='".$boardobject[$field]['id']."' && game='".$game."'";
      query($SQL);
      $boardobject[$field]['live'] -= $damage;
      $return = $damage;
    }
    return $return;
  }
}

function do_heal($field,$heal)
{
  global $boardobject;
  global $game;

  echo 'eins';

  if ($boardobject[$field]['id'] != '')
  {
  echo 'zwei*'.$boardobject[$field]['live'].'*'.$boardobject[$field]['maxlive'];
    if ($boardobject[$field]['live'] < $boardobject[$field]['maxlive'])
    {
      $newlive = min($boardobject[$field]['live'] + $heal,$boardobject[$field]['maxlive']);
      echo 'drei'.$newlive;
      $SQL = "UPDATE boardobjects SET live='".$newlive."' WHERE id='".$boardobject[$field]['id']."' && game='".$game."'";
      query($SQL);
      $boardobject[$field]['live'] = $newlive;
    }
  }
}

function delete_boardobject($field)
{
  global $boardobject;
  global $game;
  $SQL = "DELETE FROM boardobjects WHERE field='".$field."' && game='".$game."'";
  query($SQL);
  $SQL = "DELETE FROM effects WHERE target_object='".$boardobject[$field]['id']."' && game='".$game."'";
  query($SQL);
  $SQL = "DELETE FROM gamevars WHERE variable='selected' && value='board*".$field."' && game='".$game."'";
  query($SQL);
  unset ($boardobject[$field]);
}

function create_boardobject($object,$field,$player)
{
  global $game;
  global $boardobject;
  $SQL = "SELECT * FROM objectbase WHERE id='".$object."'";
  $Result = query($SQL);
  if (mysqli_num_rows($Result) == 1)
  {
    $Resultrow = $Result->fetch_assoc();
    $id_flag = create_id ('boardobjects','id');
    $SQL = "INSERT INTO boardobjects (id,field,player,game,name,move,attack,weaponattack,armor,live,maxlive)
    VALUES ('".$id_flag."','".$field."','".$player."','".$game."','".$object."','".
    $Resultrow['move']."','".$Resultrow['attack']."','".$Resultrow['weaponattack']."','".$Resultrow['armor']."','".$Resultrow['live']."','".$Resultrow['maxlive']."')";
    query($SQL);

    $SQL = "SELECT bo.*, ob.name, ob.buildtype, ob.cost, ob.text, ob.icon,ob.spell, ob.creatureprice,ob.buildingprice FROM boardobjects as bo LEFT JOIN objectbase as ob ON bo.name = ob.id where field='".
    $field."' && game='".$game."'";
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

      echo 'test:'.$fieldflag.'*<br>';
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


  }
}

function move_boardobject($oldfield,$id,$field,$player)
{
  global $game;
  global $game_var;
  global $boardobject;
  #hier noch auf fallen und andere Spells kontrollieren
  $SQL = "UPDATE boardobjects SET field='".$field."' WHERE id='".$id."' && game='".$game."'";
  query($SQL);
  #das sql knn später weg?

  #qqq
  echo '*'.$SQL.'*'.$oldfield.'<br>';



  $boardobject[$field]['id'] = $boardobject[$oldfield]['id'];
  $boardobject[$field]['player'] = $boardobject[$oldfield]['player'];
  $boardobject[$field]['name'] = $boardobject[$oldfield]['name'];
  $boardobject[$field]['buildtype'] = $boardobject[$oldfield]['buildtype'];
  $boardobject[$field]['cost'] = $boardobject[$oldfield]['cost'];
  $boardobject[$field]['move'] = $boardobject[$oldfield]['move'];
  $boardobject[$field]['attack'] = $boardobject[$oldfield]['attack'];
  $boardobject[$field]['armor'] = $boardobject[$oldfield]['armor'];
  $boardobject[$field]['live'] = $boardobject[$oldfield]['live'];
  $boardobject[$field]['maxlive'] = $boardobject[$oldfield]['maxlive'];
  $boardobject[$field]['text'] = $boardobject[$oldfield]['text'];
  $boardobject[$field]['icon'] = $boardobject[$oldfield]['icon'];
  $boardobject[$field]['spell'] = $boardobject[$oldfield]['spell'];
  $boardobject[$field]['creatureprice'] = $boardobject[$oldfield]['creatureprice'];
  $boardobject[$field]['buildingprice'] = $boardobject[$oldfield]['buildingprice'];
  $boardobject[$field]['rangedattack'] = $boardobject[$oldfield]['rangedattack'];
  $boardobject[$field]['firststrike'] = $boardobject[$oldfield]['firststrike'];

  $boardobject[$oldfield]['id'] = '';
  $boardobject[$oldfield]['player'] = '';
  $boardobject[$oldfield]['name'] = '';
  $boardobject[$oldfield]['buildtype'] = '';
  $boardobject[$oldfield]['cost'] = '';
  $boardobject[$oldfield]['move'] = '';
  $boardobject[$oldfield]['attack'] = '';
  $boardobject[$oldfield]['armor'] = '';
  $boardobject[$oldfield]['live'] = '';
  $boardobject[$oldfield]['maxlive'] = '';
  $boardobject[$oldfield]['text'] = '';
  $boardobject[$oldfield]['icon'] = '';
  $boardobject[$oldfield]['spell'] = '';
  $boardobject[$oldfield]['creatureprice'] = '';
  $boardobject[$oldfield]['buildingprice'] = '';
  $boardobject[$oldfield]['rangedattack'] = '';
  $boardobject[$oldfield]['firststrike'] = '';

  field_change($field,$player);
  add_message($selectedobject['name'].' bewegt');
}

function field_change($field,$player)
{
  global $fieldowner;
  global $fieldsowned;
  global $game_var;
  global $visiblefield;
  global $board_width;
  global $board_height;

  if ($fieldowner[$field] != $player)
  {
    $fieldsowned[$player]++;
    $game_var[$player]['buildpointsrefresh']++;
  }
  $fieldowner[$field] = $player;

  $flag = explode('*',$field);
  #var_dump($flag);

  for ($xflag = max(1,$flag[0]-1); $xflag <= min($board_width,$flag[0]+1); $xflag++)
  {
    for ($yflag = max(1,$flag[1]-1); $yflag <= min($board_height,$flag[1]+1); $yflag++)
    {
      $visiblefield[$xflag.'*'.$yflag] = true;
    }
  }

/*

  global $game;
  $SQL = "SELECT player FROM fieldowner WHERE field='".$field."' && game='".$game."'";
  $Result = query($SQL);
  if (mysqli_num_rows($Result) == 1)
  {
    $Resultrow = $Result->fetch_assoc();
    if ($Resultrow['player'] != $player)
    {
      $SQL = "UPDATE fieldowner SET player='".$player."' WHERE field='".$field."' && game='".$game."'";
      $Result = query($SQL);
    }
  }
  else
  {
    $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".$field."','".$player."','".$game."')";
    query($SQL);
  }
  */
}


function new_game()
{
  global $board_width;
  global $board_height;
  global $game;
  global $playercount;

  $SQL = "DELETE FROM boardobjects WHERE game='".$game."'";
  query($SQL);
  $SQL = "DELETE FROM message WHERE game='".$game."'";
  query($SQL);
  $SQL = "DELETE FROM effects WHERE game='".$game."'";
  query($SQL);
  $SQL = "DELETE FROM inventions WHERE game='".$game."'";
  query($SQL);
  $SQL = "DELETE FROM gamevars WHERE game='".$game."'";
  query($SQL);
  $SQL = "DELETE FROM fieldowner WHERE game='".$game."'";
  query($SQL);

  $x_offset = round(0.5+$board_width/8);
  $y_offset = round(0.5+$board_height/2);
  create_boardobject('LEADER',($x_offset+1).'*'.$y_offset,'1');
  create_boardobject('LEADER',($board_width-$x_offset).'*'.$y_offset,'2');

    #qqq es ergeben sich minuswerte in den koordinaten
  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".($x_offset+1).'*'.$y_offset."','1','".$game."')";
  query($SQL);
  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".($board_width-$x_offset).'*'.$y_offset."','2','".$game."')";
  query($SQL);
  #qqq hier könnte man noch eine Prüfung bei kleinen feldern machen
  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".$x_offset.'*'.($y_offset-1)."','1','".$game."')";
  query($SQL);
  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".$x_offset.'*'.($y_offset+1)."','1','".$game."')";
  query($SQL);
  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".($x_offset+2).'*'.($y_offset-1)."','1','".$game."')";
  query($SQL);
  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".($x_offset+2).'*'.($y_offset+1)."','1','".$game."')";
  query($SQL);
  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".($x_offset+1).'*'.($y_offset-1)."','1','".$game."')";
  query($SQL);
  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".($x_offset+1).'*'.($y_offset+1)."','1','".$game."')";
  query($SQL);
  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".$x_offset.'*'.$y_offset."','1','".$game."')";
  query($SQL);
  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".($x_offset+2).'*'.$y_offset."','1','".$game."')";
  query($SQL);

  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".($board_width-$x_offset-1).'*'.($y_offset-1)."','2','".$game."')";
  query($SQL);
  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".($board_width-$x_offset-1).'*'.($y_offset+1)."','2','".$game."')";
  query($SQL);
  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".($board_width-$x_offset+1).'*'.($y_offset-1)."','2','".$game."')";
  query($SQL);
  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".($board_width-$x_offset+1).'*'.($y_offset+1)."','2','".$game."')";
  query($SQL);
  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".($board_width-$x_offset).'*'.($y_offset-1)."','2','".$game."')";
  query($SQL);
  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".($board_width-$x_offset).'*'.($y_offset+1)."','2','".$game."')";
  query($SQL);
  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".($board_width-$x_offset-1).'*'.$y_offset."','2','".$game."')";
  query($SQL);
  $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id ('fieldowner','id')."','".($board_width-$x_offset+1).'*'.$y_offset."','2','".$game."')";
  query($SQL);

  $SQL = "INSERT INTO gamevars (id,player,variable,value,game) VALUES ('".create_id ('gamevars','id')."','game','round','1','".$game."')";
  query($SQL);


  for ($a=1;$a<$playercount+1;$a++)
  {
    if ($a == 1)
    {
      $SQL = "INSERT INTO gamevars (id,player,variable,value,game) VALUES ('".create_id ('gamevars','id')."','".$a."','buildpoints','9991','".$game."')";
      query($SQL);
    }
    else
    {
      $SQL = "INSERT INTO gamevars (id,player,variable,value,game) VALUES ('".create_id ('gamevars','id')."','".$a."','buildpoints','9941','".$game."')";
      query($SQL);
    }
    $SQL = "INSERT INTO gamevars (id,player,variable,value,game) VALUES ('".create_id ('gamevars','id')."','".$a."','maxbuildpoints','99191','".$game."')";
    query($SQL);
    $SQL = "INSERT INTO gamevars (id,player,variable,value,game) VALUES ('".create_id ('gamevars','id')."','".$a."','buildpointsrefresh','99100','".$game."')";
    query($SQL);

    $SQL = "INSERT INTO inventions (id,object,player,game) VALUES ('".create_id ('inventions','id')."','AIR','".$a."','".$game."')";
    query($SQL);
    $SQL = "INSERT INTO inventions (id,object,player,game) VALUES ('".create_id ('inventions','id')."','EARTH','".$a."','".$game."')";
    query($SQL);
    $SQL = "INSERT INTO inventions (id,object,player,game) VALUES ('".create_id ('inventions','id')."','FIRE','".$a."','".$game."')";
    query($SQL);
    $SQL = "INSERT INTO inventions (id,object,player,game) VALUES ('".create_id ('inventions','id')."','WATER','".$a."','".$game."')";
    query($SQL);
  }
}
?>