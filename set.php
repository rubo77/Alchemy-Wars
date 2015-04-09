<?
#var_dump ($game_var);
#echo '<br>';
#var_dump ($game_var_before);

#save changed gamevars
if (isset($game_var))
{
  if($game_var != $game_var_before)
  {
    foreach($game_var as $playerkey => $playerval)
    {
      if ($playerval != $game_var_before[$playerkey])
      {
        foreach($playerval as $paramkey => $paramval)
        {
          if ($paramval != $game_var_before[$playerkey][$paramkey])
          {
            if (isset($game_var_before[$playerkey][$paramkey]))
            {
              if ($game_var[$playerkey][$paramkey] != $game_var_before[$playerkey][$paramkey])
              {
                if ($paramval == '')
                {
                  $SQL = "DELETE FROM gamevars WHERE player='".$playerkey."' && variable='".$paramkey."' && game='".$game.
                  "' && value='".$game_var_before[$playerkey][$paramkey]."'";
                  query($SQL);
                  #qqq
                  #echo $SQL.'<br>';
                }
                elseif ($paramval != $game_var_before[$playerkey][$paramkey])
                {
                  $SQL = "UPDATE gamevars SET value='".$paramval."' WHERE player='".$playerkey."' && variable='".$paramkey."' && game='".$game.
                  "' && value='".$game_var_before[$playerkey][$paramkey]."'";
                  query($SQL);
#qqq
                  #echo $SQL.'<br>';
                }
              }
            }
            else
            {
              $SQL = "INSERT INTO gamevars (id,player,variable,value,game) VALUES ('".create_id('gamevars','id')."','".
              $playerkey."','".$paramkey."','".$paramval."','".$game."')";
              query($SQL);
#qqq
                  #echo $SQL.'<br>';
            }
          }
        }
      }
    }
  }
}

#save changed fieldowner
if (isset($fieldowner))
{
  if($fieldowner != $fieldowner_before)
  {
    foreach($fieldowner as $fieldkey => $fieldval)
    {
      if ($fieldowner[$fieldkey] != $fieldowner_before[$fieldkey])
      {
        if ($fieldval == '')
        {
          $SQL = "DELETE FROM fieldowner WHERE field='".$fieldkey."' && game='".$game.
          "' && player='".$fieldowner_before[$fieldkey]."'";
          query($SQL);
          #qqq
          echo $SQL.'<br>';
        }
        elseif($fieldowner_before[$fieldkey] == '')
        {
          $SQL = "INSERT INTO fieldowner (id,field,player,game) VALUES ('".create_id('fieldowner','id')."','".
          $fieldkey."','".$fieldval."','".$game."')";
          query($SQL);
          #qqq
           echo $SQL.'<br>';
        }
        elseif ($fieldval != $fieldowner_before[$fieldkey])
        {
          $SQL = "UPDATE fieldowner SET player='".$fieldval."' WHERE field='".$fieldkey."' && game='".$game.
          "'";
          query($SQL);
#qqq
          echo $SQL.'<br>';
        }
      }
      else
      {

      }
    }
  }
}
?>