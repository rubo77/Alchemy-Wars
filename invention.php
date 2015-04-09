<?
echo '<table border=1><tr>';
if ($game_var[$currentplayer]['invent'] == 'yes')
{
  echo '<td class="invent_selected">';
}
else
{
  echo '<td class="invent">';
}

#qqq die unterscheidung ist eigentlich unnötig
if (substr($game_var[$currentplayer]['selected'],0,6) == 'stock*')
{
  echo '<a href="index.php?player='.$currentplayer.'&invent=yes"><img src="b/blind.png"></a></td>';
}
else
{
   echo '<a href="index.php?player='.$currentplayer.'&invent=yes"><img src="b/blind.png"></a></td>';
}

echo '</tr></table>';
?>