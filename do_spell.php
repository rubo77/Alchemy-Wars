<?
$do_spellfield = $board_x.'*'.$board_y;
echo 'SPELL'.$selectedobject['spell'].'*';
$spellflag = explode('*',$selectedobject['spell']);

if($spellflag[1] == 'areadamage' || $spellflag[1] == 'areabuildingdamage')
{
  $messageflag = 'Schießt Zauberspruch auf '.$board_x.'/'.$board_y;
  for ($x=-1;$x<=1;$x++)
  {
    for ($y=-1;$y<=1;$y++)
    {
      if ($board_x+$x > 0 && $board_x+$x <= $board_width && $board_y+$y > 0 && $board_y+$y <= $board_height)
      {
        $damageflag = round(rand(0,$spellflag[2]/(abs($x)+abs($y)+1)) + $spellflag[2]/(abs($x)+abs($y)+2));
        #echo ($board_x+$x).'*'.($board_y+$y).'*'.$boardobject[($board_x+$x).'*'.($board_y+$y)]['buildtype'].'*<br>';
        if ($boardobject[($board_x+$x).'*'.($board_y+$y)]['buildtype'] == 'building')
        {
          $damagereturn = do_damage(($board_x+$x).'*'.($board_y+$y),$damageflag);
        }
      }
    }
  }

  $damageflag = round(rand(0,$spellflag[2]) + $spellflag[2]/2);
  $damagereturn = do_damage($do_spellfield,$damageflag);
  if ($damagereturn == 'kill')
  {
    $messageflag .= ' und tötet ihn';
  }
  elseif ($damagereturn > 0)
  {
    $messageflag .= ' und verletzt ihn';
  }

  add_message($messageflag);
}
elseif($spellflag[1] == 'damage')
{
  $messageflag = 'Schießt Zauberspruch auf '.$boardobject[$do_spellfield]['name'];

  $damageflag = round(rand(0,$spellflag[2]) + $spellflag[2]/2);
  $damagereturn = do_damage($do_spellfield,$damageflag);
  if ($damagereturn == 'kill')
  {
    $messageflag .= ' und tötet ihn';
  }
  elseif ($damagereturn > 0)
  {
    $messageflag .= ' und verletzt ihn';
  }

  add_message($messageflag);
}
elseif($spellflag[1] == 'heal')
{
  $messageflag = 'Wirkt Zauberspruch auf '.$boardobject[$do_spellfield]['name'];

  $damagereturn = do_heal($do_spellfield,$spellflag[2]);

  add_message($messageflag);
}
elseif($spellflag[1] == 'movement')
{
  $messageflag = 'Verlangsamt die Bewegung von '.$boardobject[$do_spellfield]['name'];

  if ($currentplayer == 'player1')
  {
    $endround = $round+1;
  }
  elseif ($currentplayer == 'player2')
  {
    $endround = $round+2;
  }

  $SQL = "INSERT INTO effects (id,effect,value,target_object,target_player,target_field,start_round,end_round,game)
  VALUES ('".create_id('effects','id')."','movement','".$spellflag[2]."','".$boardobject[$do_spellfield]['id']."','','','".$round."','".$endround."','".$game."')";
  query($SQL);
  add_message($messageflag);
}
elseif($spellflag[1] == 'rust')
{
  $messageflag = 'Beschädigt die Waffe von '.$boardobject[$do_spellfield]['name'];

  $SQL = "UPDATE boardobjects SET weaponattack=round(weaponattack*'".$spellflag[2]."') WHERE field='".$do_spellfield."' && game='".$game."'";
  query($SQL);
  $boardobject[$do_spellfield]['attack'] -= $boardobject[$do_spellfield]['weaponattack'];
  $boardobject[$do_spellfield]['weaponattack'] = round($boardobject[$do_spellfield]['weaponattack']*$spellflag[2]);
  $boardobject[$do_spellfield]['attack'] += $boardobject[$do_spellfield]['weaponattack'];
  add_message($messageflag);
}
elseif($spellflag[1] == 'stealresources')
{
  $messageflag = 'Verlangsamt die Produktion des Gegners';

  $SQL = "UPDATE gamevars SET value=value-'".$spellflag[2]."' WHERE variable='buildpoints' && player!='".$currentplayer."' && game='".$game."'";
  query($SQL);
  for ($a=0; $a<$playercount;$a++)
  {
    if ($a != $currentplayer)
    {
      $game_var[$a]['buildpoints'] -= $spellflag[2];
    }
  }
  add_message($messageflag);
}
elseif($spellflag[1] == 'weapon')
{
  $messageflag = 'Stattet '.$boardobject[$do_spellfield]['name'].' mit Waffen aus';

  $SQL = "UPDATE boardobjects SET weaponattack='".$spellflag[2]."' WHERE field='".$do_spellfield."' && game='".$game."'";
  query($SQL);
  $boardobject[$do_spellfield]['attack'] -= $boardobject[$do_spellfield]['weaponattack'];
  $boardobject[$do_spellfield]['weaponattack'] = $spellflag[2];
  $boardobject[$do_spellfield]['attack'] += $boardobject[$do_spellfield]['weaponattack'];
  add_message($messageflag);
}
?>