<?
#var_dump($selectedobject);
if ($selectedobject['name'] != '')
{
  echo '<table border=1>';
  if ($selectedobject['cost'] < 0)
  {
    echo '<tr><td><img src="b/objects/'.$selectedobject['icon'].'"></td><td><b>'.$selectedobject['name'].'</b></td><td class=build> -- </td></tr>';
  }
  else
  {
    echo '<tr><td><img src="b/objects/'.$selectedobject['icon'].'"></td><td><b>'.$selectedobject['name'].'</b></td><td class=build>'.$selectedobject['cost'].'</td></tr>';
  }
  if ($selectedobject['move'] < 0)
  {
    echo '<tr><td colspan=2 rowspan=4 valign=top style="padding:10px;">'.$selectedobject['text'].'</td><td class=move> -- </td></tr>';
  }
  else
  {
    echo '<tr><td colspan=2 rowspan=4 valign=top style="padding:10px;">'.$selectedobject['text'].'</td><td class=move>'.$selectedobject['move'].'</td></tr>';
  }

  echo '<tr><td class=attack>'.$selectedobject['attack'].'</td></tr>';
  echo '<tr><td class=armor>'.$selectedobject['armor'].'</td></tr>';
  echo '<tr><td class=live>'.$selectedobject['live'].' / '.$selectedobject['maxlive'].'</td></tr>';
  echo '</table>';
}
?>
