<?
echo '<table border=1>';
echo '<tr>';
echo '<td>Runde: '.$round.'</td>';
echo '<td>'.$currentplayer.'</td></tr>';
echo '<tr><td colspan=2>'.$game_var[$currentplayer]['buildpoints'].' / '.$game_var[$currentplayer]['maxbuildpoints'].' (+'.$game_var[$currentplayer]['buildpointsrefresh'].' / Runde)</td>';
echo '</tr>';
echo '</table>';
?>