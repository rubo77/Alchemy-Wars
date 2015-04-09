<?
include_once ('server.php');
include_once ('functions.php');
include_once ('get.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name=viewport content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel=stylesheet type="text/css" href="style.css">
<title>Game</title>
<meta name="language" content="DE">
<meta name="keywords" lang="de" content="Game">
<meta name="description" content="Tolle Game.">
<meta name="revisit-after" content="14 days">
</head>

<body>
<div class=board>
<?
include_once ('board.php');
?>
</div>

<div class=stock>
<?
include_once ('stock.php');
?>
</div>

<div class=status>
<?
include_once ('statusbar.php');
?>
</div>


<?
if ($boardobject[$board_x.'*'.$board_y]['player'] == 1)
{
  echo '<div class=objectinfo_player1>';
}
elseif ($boardobject[$board_x.'*'.$board_y]['player'] == 2)
{
  echo '<div class=objectinfo_player2>';
}
else
{
  echo '<div class=objectinfo>';
}
include ('objectinfo.php');
echo '</div>';
?>


<div class=invention>
<?
include ('invention.php');
?>
</div>


<div class=buttons>
<?
include ('buttons.php');
?>
</div>

<div class=message>
<?
include ('output.php');
echo '<br><br>';
include ('message.php');
?>
</div>

</body></html>
<?
include ('set.php');
#include ('output.php');
?>