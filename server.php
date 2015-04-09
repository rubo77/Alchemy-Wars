<?
#connect to server
## connection variables
#if ($_SERVER['HTTP_HOST'] == 'localhost')
{
  $dbhostname = 'localhost';          #name of mysql database host
  $dbname = 'game';                   #name of mysql database
  $dbuser = 'game';                   #username for mysql database
  $dbpass = 'game';                   #password for mysql database
  $dbprefix = 'cms_';                 #prefix for datatablenames (optional)
}

##connect to server
$server = mysqli_connect($dbhostname,$dbuser,$dbpass,$dbname);
if (!$server)
{
  $error = date('d.m.Y H:i:s').' Datenbank-Verbindungsfehler ('.mysqli_connect_errno().'): '.mysqli_connect_error();
  if ($_SERVER['HTTP_HOST'] == 'localhost')
  {
    echo $error;
  }
  else
  {
    #yyy hier steht noch die falsche email
    #@mail('admin@slampoet.de','Slam - FEHLER',$errorflag);
  }
  die ('Please reload - Bitte die Seite neu laden');
}


#functions
function query($query_SQL, $query_user='system')
{
  global $server;

  if (!$Result = mysqli_query($server,$query_SQL))
  {
    $errorflag = $user.' ('.date('d.m.Y H:i:s').') '.mysqli_error($server).' in '.$query_SQL;

    if ($_SERVER['HTTP_HOST'] == 'localhost')
    {
      echo '§'.$errorflag;
    }
    else
    {
      @mail('admin@slampoet.de','Slam - FEHLER',$errorflag);
    }
    die ('Please reload - Bitte die Seite neu laden');
  }

  #return result
  return $Result;
}

function gettest($get)
{
  if (isset($get))
  {
    global $server;
    $get = get_magic_quotes_gpc() ? stripslashes($get) : $get;
    $get = mysqli_real_escape_string($server,$get);
  }
  return $get;
}

function create_id($table='',$id_colname='')
{
  #get globals
  global $sys_dbprefix;

  #create the id
  #62 allowedchars with lenght 10: 62^10 = 839.299.365.868.340.224 combinations
  $length = 10;
  $allowedchars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  for ($a=0; $a<$length; $a++)
  {
    $rand = mt_rand(0,strlen($allowedchars)-1);
    $return .= substr($allowedchars,$rand,1);
  }
  ##check if id exists
  if ($table != '' && $id_colname != '')
  {
    $SQL = "SELECT ".$id_colname." FROM ".$table." WHERE ".$id_colname." = '".$return."'";
    $Result = query($SQL);
    if (mysqli_num_rows($Result) == 1)
    {
      $return = create_id($table,$id_colname);
    }
  }

  #return result
  return $return;
}

function add_message($text)
{
  global $game;
  global $round;
  $SQL = "INSERT INTO message (id,player,round,message,time,game) VALUES ('".create_id('message','id')."','".$currentplayer."','".$round."','".$text."','".time()."','".$game."')";
  query($SQL);
}
?>