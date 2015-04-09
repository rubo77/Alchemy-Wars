<?
#var_dump($boardobject);
echo '<table border=1>';
for ($y=1;$y<=$board_height;$y++)
{
  echo '<tr>';
  for ($x=1;$x<=$board_width;$x++)
  {
    $actionflag = '';
    $costflag = 0;

    if ($visiblefield[$x.'*'.$y])
    {
      if ($game_var[$currentplayer]['selected'] == 'board*'.$x.'*'.$y)
      {
        $actionflag = "UNSELECT";
        $costflag = 0;
      }
      elseif (substr($game_var[$currentplayer]['selected'],0,6) == 'stock*')
      {
        if (substr($selectedobject['spell'],0,4) == 'all*' || (substr($selectedobject['spell'],0,5) == 'self*' && $boardobject[$x.'*'.$y]['player'] == $currentplayer)
        || (substr($selectedobject['spell'],0,6) == 'enemy*' && $boardobject[$x.'*'.$y]['player'] != $currentplayer))
        {
          #qqq hier muss ich noch feuerbälle etc activieren
          $actionflag = "SPELL";
          $costflag = $selectedobject['cost'];
        }
        elseif ($boardobject[$x.'*'.$y]['player'] == $currentplayer)
        {
          $actionflag = "SELECT";
          $costflag = 0;
        }
        elseif ($boardobject[$x.'*'.$y]['player'] != $currentplayer && $boardobject[$x.'*'.$y]['player'] > 0)
        {
          $actionflag = "INFO";
          $costflag = 0;
        }
        elseif ($fieldowner[$x.'*'.$y] == $currentplayer && $boardobject[$x.'*'.$y]['id'] == '' && $selectedobject['cost'] > 0)
        {
          $actionflag = "SUMMON";
          $costflag = $selectedobject['cost'];
          if ($selectedobject['buildtype'] == 'creature')
          {
            $costflag = round($costflag * $creatureprice[$currentplayer]);
          }
          elseif ($selectedobject['buildtype'] == 'building')
          {
            $costflag = round($costflag * $buildingprice[$currentplayer]);
          }
        }
      }
      elseif (substr($game_var[$currentplayer]['selected'],0,6) == 'board*')
      {
        $flag = explode('*',$game_var[$currentplayer]['selected']);
        #qqq hier muss ich noch vögel und teleporter beachten
        if ($selectedobject['player'] == $currentplayer && (abs($flag[1] - $x) == 0 || abs($flag[1] - $x) == 1) && (abs($flag[2] - $y) == 0 || abs($flag[2] - $y) == 1))
        {
          if ($boardobject[$x.'*'.$y]['player'] == $currentplayer)
          {
            $actionflag = "";
            $costflag = 0;
            #qqq die muss ich noch festlegen
            #qqq will ich das überhaupt zulassen?
            #$actionflag = "UPGRADE";
            #$costflag = $selectedobject['cost'];
          }
          elseif ($boardobject[$x.'*'.$y]['player'] != $currentplayer && $boardobject[$x.'*'.$y]['player'] != "")
          {
            $actionflag = "ATTACK ".$boardobject[$x.'*'.$y]['name'].' ('.$boardobject[$x.'*'.$y]['attack'].'/'.$boardobject[$x.'*'.$y]['armor'].'/'.$boardobject[$x.'*'.$y]['live'].')';
            $costflag = round(sqrt(pow(abs($flag[1] - $x),2) + pow(abs($flag[2] - $y),2)) * $selectedobject['move']);
          }
          elseif ($selectedobject['move'] > 0)
          {
            $actionflag = "MOVE";
            #qqq die muss ich noch richtig anpassen
            $costflag = round(sqrt(pow(abs($flag[1] - $x),2) + pow(abs($flag[2] - $y),2)) * $selectedobject['move']);
          }
        }
        elseif($boardobject[$x.'*'.$y]['player'] == $currentplayer)
        {
          $actionflag = "SELECT";
          $costflag = 0;
        }
        elseif($boardobject[$x.'*'.$y]['player'] != $currentplayer && $boardobject[$x.'*'.$y]['player'] != "")
        {
          $actionflag = "INFO";
          $costflag = 0;
        }
      }
      elseif($boardobject[$x.'*'.$y]['player'] == $currentplayer)
      {
        $actionflag = "SELECT";
        $costflag = 0;
      }
      elseif($boardobject[$x.'*'.$y]['player'] != $currentplayer && $boardobject[$x.'*'.$y]['player'] != "")
      {
        $actionflag = "INFO";
        $costflag = 0;
      }
    }

    if ($actionflag != "")
    {
      if ($costflag <= $game_var[$currentplayer]['buildpoints'])
      {
        $titleflag = $actionflag.' (Cost: '.$costflag.')';
      }
      else
      {
        $titleflag = $actionflag.' (COST: '.$costflag.')';
        $actionflag = '';
      }
    }
    else
    {
      $titleflag = '';
    }

    if(!$visiblefield[$x.'*'.$y])
    {
      echo '<td class="invisible" title="unbekanntes Gebiet">';
    }
    elseif($game_var[$currentplayer]['selected'] == 'board*'.$x.'*'.$y && $fieldowner[$x.'*'.$y] == $currentplayer)
    {
      echo '<td class="player1_base_selected" title="'.$titleflag.'">';
    }
    elseif($fieldowner[$x.'*'.$y] == $currentplayer)
    {
      echo '<td class="player1_base" title="'.$titleflag.'">';
    }
    elseif($game_var[$currentplayer]['selected'] == 'board*'.$x.'*'.$y && $fieldowner[$x.'*'.$y] != $currentplayer && $fieldowner[$x.'*'.$y] > 0)
    {
      echo '<td class="player2_base_selected" title="'.$titleflag.'">';
    }
    elseif($fieldowner[$x.'*'.$y] != $currentplayer && $fieldowner[$x.'*'.$y] > 0)
    {
      echo '<td class="player2_base" title="'.$titleflag.'">';
    }
    elseif($game_var[$currentplayer]['selected'] == 'board*'.$x.'*'.$y)
    {
      echo '<td class="neutral_selected" title="'.$titleflag.'">';
    }
    else
    {
      echo '<td class="neutral" title="qqq'.$titleflag.'">';
    }

    if ($actionflag != '')
    {
      echo '<a href="index.php?player='.$currentplayer.'&board_x='.$x.'&board_y='.$y.'">';
    }

    #qqq
    #echo $x.'/'.$y.' *'.$actionflag.'*';

    if($boardobject[$x.'*'.$y]['icon'] != '' && $visiblefield[$x.'*'.$y])
    {
      echo '<img src="b/objects/'.$boardobject[$x.'*'.$y]['icon'].'">';
    }
    else
    {
      echo '<img src="b/blind.png">';
    }

    if ($actionflag != '')
    {
      echo '</a>';
    }
    echo '</td>';
  }
  echo '</tr>';
}
echo '</table>';
?>