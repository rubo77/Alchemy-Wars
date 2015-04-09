<?
$game = gettest($_REQUEST['game']);                 #id des Spiels
$newgame = gettest($_REQUEST['newgame']);           #set to "yes" to start a new game
$nextround = gettest($_REQUEST['nextround']);       #set to "yes" to finish round for current player
$currentplayer = gettest($_REQUEST['player']);      #index (1,...n) des aktuellen Spieler #qqq: eventuell mit sessid oder token, w. cheating

#get user input
$board_x = gettest($_REQUEST['board_x']);
$board_y = gettest($_REQUEST['board_y']);
$stock = gettest($_REQUEST['stock']);
$invent = gettest($_REQUEST['invent']);


#qqq hier abfrage auf $game-Daten in db
$game = 'testgame';
$board_width = 15;
$board_height = 11;
$stock_width = 15;
$stock_height = 10;
$playercount = 2;
$player = Array('player1','player2');   #qqq actung ein player darf nicht game heissen und das der gamenamedarf kein numerischer index sein, wegen abfrage der gamevars

if ($newgame == 'yes')
{
  new_game();
  unset($_REQUEST);
  $currentplayer = 1;
}


if ($nextround == 'yes')
{
  if($currentplayer == $playercount)
  {
    $currentplayer = 1;
  }
  else
  {
    $currentplayer += 1;
  }
}

#qqq hier eventuell noch ein globales unset
include ('get_from_db.php');


if ($nextround == 'yes')
{
  #qqq ist das hier richtig? -d.h ist fieldsowned schon bestimmt?
  $game_var[$currentplayer]['buildpoints'] += $fieldsowned[$currentplayer];
  $game_var[$currentplayer]['maxbuildpoints'] += $fieldsowned[$currentplayer];
  $game_var[$currentplayer]['buildpointsrefresh'] += $fieldsowned[$currentplayer];

  $game_var[$currentplayer]['buildpoints'] = min($game_var[$currentplayer]['buildpoints'] + $game_var[$currentplayer]['buildpointsrefresh'],$game_var[$currentplayer]['maxbuildpoints']);

  #add_message('Erhält '.($newbuildpointsflag-$buildpointsflag).' neue Baupunkte');

  #qqq brauche ich das noch?
  #$SQL = "DELETE FROM gamevars WHERE player='".$currentplayer."' && variable='invent' && game='".$game."'";
  #query($SQL);
  #$SQL = "DELETE FROM gamevars WHERE player='".$currentplayer."' && variable='selected' && game='".$game."'";
  #query($SQL);

  #qqq lebenspunkt für anführer muss ich noch einbauen
  #$SQL = "UPDATE boardobjects SET live=min(3,4) WHERE name='Anführer' && player='".$currentplayer."' && game='".$game."'";
  #query($SQL);

  #qqq do the effects for round start
}

# gucken wo dre hinmuss
include ('do_effects.php');


If ($invent == 'yes')
{
  if ($game_var[$currentplayer]['invent'] == 'yes')
  {
    $game_var[$currentplayer]['invent'] = '';
  }
  else
  {
    $game_var[$currentplayer]['invent'] = 'yes';
  }
}

#qqq betrugscheck: immer vorher testen, ob genug buildpoints



if ($stock > 0)
{
  if ($game_var[$currentplayer]['invent'] == 'yes' && substr($game_var[$currentplayer]['selected'],0,6) == 'stock*')
  {
    include ('do_invent.php');
  }
  elseif ($game_var[$currentplayer]['selected'] == 'stock*'.$stock)
  {
    $game_var[$currentplayer]['selected'] = '';
    unset($selectedobject);
  }
  else
  {
    $game_var[$currentplayer]['selected'] = 'stock*'.$stock;
    $selectedobject = $invention[$currentplayer][$stock];
    #var_dump($selectedobject);
  }
}


#qqq
#echo $currentplayer.'*'.$game_var[$currentplayer]['selected'].'#'.$board_x.'*'.$board_y.'*<br>';
if ($board_x > 0 && $board_y > 0)
{
  if (substr($game_var[$currentplayer]['selected'],0,6) == 'stock*')
  {
#echo 'eins';
#var_dump($selectedobject);
    if ($boardobject[$board_x.'*'.$board_y]['id'] == '' && $fieldowner[$board_x.'*'.$board_y] == $currentplayer && $selectedobject['spell'] == '')
    {
      $costflag = $selectedobject['cost'];
      if ($selectedobject['buildtype'] == 'creature')
      {
        $costflag = round($costflag * $creatureprice[$currentplayer]);
      }
      elseif ($selectedobject['buildtype'] == 'building')
      {
        $costflag = round($costflag * $buildingprice[$currentplayer]);
      }
      if ($costflag <= $game_var[$currentplayer]['buildpoints'])
      {
        $game_var[$currentplayer]['buildpoints'] -= $costflag;
        create_boardobject($selectedobject['id'],$board_x.'*'.$board_y,$currentplayer);
        add_message($selectedobject['name'].' beschworen');
      }
      $game_var[$currentplayer]['selected'] = 'board*'.$board_x.'*'.$board_y;
    }
    elseif (substr($selectedobject['spell'],0,4) == 'all*' || (substr($selectedobject['spell'],0,5) == 'self*' && $boardobject[$board_x.'*'.$board_y]['player'] == $currentplayer)
      || (substr($selectedobject['spell'],0,6) == 'enemy*' && $boardobject[$board_x.'*'.$board_y]['player'] != $currentplayer))
    {
      $costflag = $selectedobject['cost'];
      if ($costflag <= $game_var[$currentplayer]['buildpoints'])
      {
        $game_var[$currentplayer]['buildpoints'] -= $costflag;
        include ('do_spell.php');
        add_message($selectedobject['name'].' qqq gezaubert');
      }
      $game_var[$currentplayer]['selected'] = 'board*'.$board_x.'*'.$board_y;
      $selectedobject = $boardobject[$board_x.'*'.$board_y];
    }
    else
    {
      $game_var[$currentplayer]['selected'] = 'board*'.$board_x.'*'.$board_y;
      $selectedobject = $boardobject[$board_x.'*'.$board_y];
    }
  }
  elseif (substr($game_var[$currentplayer]['selected'],0,6) == 'board*')
  {
    echo 'zwei';
    #qqq, hier gibt es noch einen Fehler, wenn man etwa eine GEGNERISCHE Figur zur Info ausgewählt hat
    $movestart = explode('*',$game_var[$currentplayer]['selected']);
    if (abs($movestart[1] - $board_x) == 0 && abs($movestart[2] - $board_y) == 0)
    {
      $game_var[$currentplayer]['selected'] = '';
      unset($selectedobject);
      echo 'A';
    }
    elseif ((abs($movestart[1] - $board_x) == 0 || abs($movestart[1] - $board_x) == 1) && (abs($movestart[2] - $board_y) == 0 || abs($movestart[2] - $board_y) == 1) && $selectedobject['move'] > 0)
    {
      $costflag = round(sqrt(pow(abs($movestart[1] - $board_x),2) + pow(abs($movestart[2] - $board_y),2)) * $selectedobject['move']) ;
      if ($costflag <= $game_var[$currentplayer]['buildpoints'])
      {
        echo 'B';
        $game_var[$currentplayer]['buildpoints'] -= $costflag;
        #qqq eventuell muss man invent aktivieren bevor man onboard verwandeln kann?
        if ($boardobject[$board_x.'*'.$board_y]['id'] == '')
        {
          move_boardobject($movestart[1].'*'.$movestart[2],$selectedobject['id'],$board_x."*".$board_y,$currentplayer);
          $game_var[$currentplayer]['selected'] = 'board*'.$board_x.'*'.$board_y;
        }
        else
        {
          include ('do_combat.php');
        }
      }
      echo $costflag.' >= '.$game_var[$currentplayer]['buildpoints'];
    }
    else
    {
      $game_var[$currentplayer]['selected'] = 'board*'.$board_x.'*'.$board_y;
      $selectedobject = $boardobject[$board_x.'*'.$board_y];
      echo 'C';
    }
  }
  else
  {
    echo 'drei';
    $game_var[$currentplayer]['selected'] = 'board*'.$board_x.'*'.$board_y;
    $selectedobject = $boardobject[$board_x.'*'.$board_y];
  }
}

#include ('get_from_db.php');
#include ('do_effects.php');

include ('get_selected_object.php');
?>