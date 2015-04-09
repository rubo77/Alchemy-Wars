<?
#echo 'invent';
$SQL = "SELECT result FROM inventionbase WHERE (base1='".$selectedobject['id']."' && base2='".$invention[$currentplayer][$stock]['id']."') || (base2='".$selectedobject['id']."' && base1='".$invention[$currentplayer][$stock]['id']."')";
$Result = query($SQL);
#echo $SQL.'*'.mysqli_num_rows($Result).'<br>';
if (mysqli_num_rows($Result) == 1)
{
  $Resultrow = $Result->fetch_assoc();
  $newinvention = $Resultrow['result'];
  $SQL = "SELECT object FROM inventions WHERE player='".$currentplayer."' && game ='".$game."' && object='".$newinvention."'";
  $Result = query($SQL);
  if(mysqli_num_rows($Result) == 0)
  {
    $SQL = "INSERT INTO inventions (id,player,object,game) VALUES ('".create_id ('inventions','id')."','".$currentplayer."','".$newinvention."','".$game."')";
    query($SQL);
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

      if ($newinvention == $Resultrow['object'])
      {
        #qqq gucken ob das klappt
        $game_var[$currentplayer]['selected'] = 'stock*'.$a+1;
        $selectedobject = $invention[$currentplayer][$a+1];
      }
    }
    $game_var[$currentplayer]['invent'] = '';
    $game_var[$currentplayer]['buildpoints'] -= 15;



    if ($newinvention == 'AMBOS')
    {
      $game_var[$currentplayer]['buildpoints'] += 8;
      $game_var[$currentplayer]['maxbuildpoints'] += 8;
    }
    elseif ($newinvention == 'ASH')
    {
      $SQL = "UPDATE boardobjects SET live=live+1,maxlive=maxlive+1 WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['live'] += 1;
        $boardobject[$Resultrow['field']]['maxlive'] += 1;
      }
    }
    elseif ($newinvention == 'BANK')
    {
      $game_var[$currentplayer]['buildpoints'] += 20;
      $game_var[$currentplayer]['maxbuildpoints'] += 20;
      $game_var[$currentplayer]['buildpointsrefresh'] += 5;
    }
    elseif ($newinvention == 'CASTLE')
    {
      $SQL = "UPDATE boardobjects SET attack=attack+2,armor=armor+2 WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['attack'] += 2;
        $boardobject[$Resultrow['field']]['armor'] += 2;
      }
    }
    elseif ($newinvention == 'CAVE')
    {
      $SQL = "UPDATE boardobjects SET live=live+2,maxlive=maxlive+2,armor=armor+2 WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['live'] += 2;
        $boardobject[$Resultrow['field']]['maxlive'] += 2;
        $boardobject[$Resultrow['field']]['armor'] += 2;
      }
    }
    elseif ($newinvention == 'CLAY')
    {
      $game_var[$currentplayer]['buildpoints'] += 4;
      $game_var[$currentplayer]['maxbuildpoints'] += 4;
    }
    elseif ($newinvention == 'DAY')
    {
      $SQL = "UPDATE boardobjects SET move=move-2 WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['move'] -= 2;
      }
    }
    elseif ($newinvention == 'FOG')
    {
      $SQL = "UPDATE boardobjects SET live=live+2,maxlive=maxlive+2 WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['live'] += 2;
        $boardobject[$Resultrow['field']]['maxlive'] += 2;
      }
    }
    elseif ($newinvention == 'FOREST')
    {
      $game_var[$currentplayer]['buildpoints'] += 8;
      $game_var[$currentplayer]['maxbuildpoints'] += 8;
      $SQL = "UPDATE boardobjects SET live=live+4,maxlive=maxlive+4 WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['live'] += 4;
        $boardobject[$Resultrow['field']]['maxlive'] += 4;
      }
    }
    elseif ($newinvention == 'FORGE')
    {
      $game_var[$currentplayer]['buildpoints'] += 10;
      $game_var[$currentplayer]['maxbuildpoints'] += 10;
      $game_var[$currentplayer]['buildpointsrefresh'] += 5;
    }
    elseif ($newinvention == 'FORTRESS')
    {
      $SQL = "UPDATE boardobjects SET attack=attack+1,armor+1 WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['attack'] += 1;
        $boardobject[$Resultrow['field']]['armor'] += 1;
      }
    }
    elseif ($newinvention == 'HILL')
    {
      $SQL = "UPDATE boardobjects SET live=live+1,maxlive=maxlive+1,armor=armor+1 WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['live'] += 1;
        $boardobject[$Resultrow['field']]['maxlive'] += 1;
        $boardobject[$Resultrow['field']]['armor'] += 1;
      }
    }
    elseif ($newinvention == 'ISLAND')
    {
      $SQL = "UPDATE boardobjects SET live=live+3,maxlive=maxlive+3 WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['live'] += 3;
        $boardobject[$Resultrow['field']]['maxlive'] += 3;
      }
    }
    elseif ($newinvention == 'IRON')
    {
      $SQL = "UPDATE boardobjects SET armor=armor+2 WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['armor'] += 2;
      }
    }
    elseif ($newinvention == 'LAKE')
    {
      $SQL = "UPDATE boardobjects SET live=live+3,maxlive=maxlive+3 WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['live'] += 3;
        $boardobject[$Resultrow['field']]['maxlive'] += 3;
      }
    }
    elseif ($newinvention == 'MOUNTAIN')
    {
      $SQL = "UPDATE boardobjects SET live=live+5,maxlive=maxlive+5 WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['live'] += 5;
        $boardobject[$Resultrow['field']]['maxlive'] += 5;
      }
    }
    elseif ($newinvention == 'OCEAN')
    {
      $SQL = "UPDATE boardobjects SET move=move-1 WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['move'] -= 1;
      }
    }
    elseif ($newinvention == 'PLAINS')
    {
      $SQL = "UPDATE boardobjects SET move=move-2 WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      echo $SQL.'*'.mysqli_num_rows($Result).'<br>';
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['move'] -= 2;
      }
    }
    elseif ($newinvention == 'SAND')
    {
      $game_var[$currentplayer]['buildpoints'] += 5;
      $game_var[$currentplayer]['maxbuildpoints'] += 5;
    }
    elseif ($newinvention == 'SKY')
    {
      $SQL = "UPDATE boardobjects SET move=move-1 WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['move'] -= 1;
      }
    }
    elseif ($newinvention == 'STEEL')
    {
      $SQL = "UPDATE boardobjects SET attack=attack+3 WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['attack'] += 3;
      }
    }
    elseif ($newinvention == 'SUN')
    {
      $SQL = "UPDATE boardobjects SET attack=attack+2,live=live+5,maxlive=maxlive+5 WHERE name='Anführer' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['attack'] += 2;
        $boardobject[$Resultrow['field']]['live'] += 5;
        $boardobject[$Resultrow['field']]['maxlive'] += 5;
      }
    }
    elseif ($newinvention == 'SWAMP')
    {
      $SQL = "UPDATE boardobjects SET live=live+2,maxlive=maxlive+2 WHERE name='Anführer' && player='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['live'] += 2;
        $boardobject[$Resultrow['field']]['maxlive'] += 2;
      }
    }
    elseif ($newinvention == 'TREE')
    {
      $game_var[$currentplayer]['buildpoints'] += 3;
      $game_var[$currentplayer]['maxbuildpoints'] += 3;
    }
    elseif ($newinvention == 'VACUUM')
    {
      $SQL = "UPDATE boardobjects SET live=live-4,maxlive=maxlive-4 WHERE name='Anführer' && player!='".$currentplayer."' && game='".$game."'";
      query($SQL);
      $SQL = "SELECT field FROM boardobjects WHERE name='LEADER' && player!='".$currentplayer."' && game='".$game."'";
      $Result = query($SQL);
      for ($a=0; $a<mysqli_num_rows($Result);$a++)
      {
        $Resultrow = $Result->fetch_assoc();
        $boardobject[$Resultrow['field']]['live'] -= 4;
        $boardobject[$Resultrow['field']]['maxlive'] -= 4;
      }
    }
    #qqq
    echo $SQL.'*';
  }
  else
  {
    $knownitem = true;
  }
}

if (!$knownitem)
{
  $game_var[$currentplayer]['buildpoints'] -= 5;
  add_message('Arbeitet im Laboratorium');
}
?>