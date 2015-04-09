<?
$count = 1;
#qqq
#var_dump($invention);

echo '<table border=1>';

for ($y=1;$y<=$stock_height;$y++)
{
  echo '<tr>';
  for ($x=1;$x<=$stock_width;$x++)
  {
    $actionflag = '';
    $costflag = 0;

    if ($count <= count($invention[$currentplayer]))
    {
      if ($game_var[$currentplayer]['invent'] == 'yes')
      {
        $actionflag = 'INVENT '.$invention[$currentplayer][$count]['name'];
        $costflag = 20;
      }
      elseif($game_var[$currentplayer]['selected'] == 'stock*'.($count+1))
      {
        $actionflag = 'UNSELECT '.$invention[$currentplayer][$count]['name'];
        $costflag = 0;
      }
      else
      {
        $actionflag = 'SELECT '.$invention[$currentplayer][$count]['name'];
        $costflag = 0;
      }

      if ($costflag <= $game_var[$currentplayer]['buildpoints'])
      {
        $titleflag = $actionflag.' (Cost: '.$costflag.')';
      }
      else
      {
        $titleflag = $actionflag.' (COST: '.$costflag.')';
        $actionflag = '';
      }

      if ($game_var[$currentplayer]['selected'] == 'stock*'.($count))
      {
        echo '<td class="player1_selected" title="'.$titleflag.'">';
      }
      else
      {
        echo '<td class="player1" title="'.$titleflag.'">';
      }

      if ($actionflag == '')
      {
        echo '<img src="b/objects/'.$invention[$currentplayer][$count]['icon'].'"></td>';
      }
      else
      {
        echo '<a href="index.php?player='.$currentplayer.'&stock='.(($y-1)*$stock_width+$x).'"><img src="b/objects/'.$invention[$currentplayer][$count]['icon'].'"></a></td>';
      }
    }
    else
    {
      #qqq eigentlich: empty td
      echo '<td><a href="index.php?player='.$currentplayer.'&x='.$x.'&y='.$y.'"><img src="b/board_background.png"></a></td>';
    }
    $count++;
  }
  echo '</tr>';
}
echo '</table>';
?>