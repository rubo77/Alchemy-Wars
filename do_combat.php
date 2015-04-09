<?
if ($boardobject[$board_x.'*'.$board_y]['player'] == $currentplayer)
{
  echo 'unition';
}
elseif ($boardobject[$board_x.'*'.$board_y]['player'] != $currentplayer)
{
  $messageflag = $selectedobject['name'].' greift '.$boardobject[$board_x.'*'.$board_y]['name'].' an';
  $damageflag1 = round(rand(0,$boardobject[$movestart[1].'*'.$movestart[2]]['attack']) + $boardobject[$movestart[1].'*'.$movestart[2]]['attack']/2);
  $damageflag2 = round(rand(0,$boardobject[$board_x.'*'.$board_y]['attack']) + $boardobject[$board_x.'*'.$board_y]['attack']/2);

  if ($boardobject[$movestart[1].'*'.$movestart[2]]['firststrike'] != 'yes' && $boardobject[$board_x.'*'.$board_y]['firststrike'] == 'yes')
  {
    if ($damageflag2 > 0)
    {
      $damagereturn = do_damage($movestart[1].'*'.$movestart[2],$damageflag2);
      if ($damagereturn == 'kill')
      {
        $messageflag .= ' und stirbt selbst dabei';
      }
      elseif ($damagereturn > 0)
      {
        $messageflag .= ' und wird selbst verletzt';
      }
      #echo $movestart[1].'*'.$movestart[2].'#'.$damagereturn.'*'.$damageflag2;
    }

    if ($damageflag1 > 0 && $damagereturn != 'kill')
    {
      $damagereturn = do_damage($board_x.'*'.$board_y,$damageflag1);
      if ($damagereturn == 'kill')
      {
        $messageflag .= ' und tötet ihn';
      }
      elseif ($damagereturn > 0)
      {
        $messageflag .= ' und verletzt ihn';
      }
    }
  }
  else
  {
    if ($damageflag1 > 0)
    {
      $damagereturn = do_damage($board_x.'*'.$board_y,$damageflag1);
      if ($damagereturn == 'kill')
      {
        $messageflag .= ' und tötet ihn';
      }
      elseif ($damagereturn > 0)
      {
        $messageflag .= ' und verletzt ihn';
      }
    }

    if ($damageflag2 > 0 && $boardobject[$movestart[1].'*'.$movestart[2]]['rangedattack'] != 'yes' && ($boardobject[$movestart[1].'*'.$movestart[2]]['firststrike'] != 'yes' || $damagereturn != 'kill'))
    {
      $damagereturn = do_damage($movestart[1].'*'.$movestart[2],$damageflag2);
      if ($damagereturn == 'kill')
      {
        $messageflag .= ' und stirbt selbst dabei';
      }
      elseif ($damagereturn > 0)
      {
        $messageflag .= ' und wird selbst verletzt';
      }
      #echo $movestart[1].'*'.$movestart[2].'#'.$damagereturn.'*'.$damageflag2;
    }
  }

  add_message($messageflag);
}
?>