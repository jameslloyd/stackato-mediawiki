<?php
$local = True;



if ($local == True):
  $db['dbhost'] = 'localhost';
  $db['user'] = 'root';
  $db['pass'] = 'root';
  $db['dbname'] = 'wiki';
else:
  $url_parts = parse_url($_SERVER['DATABASE_URL']);
  $db_name = substr( $url_parts{'path'}, 1 );
  $db['dbhost'] = $url_parts{'host'} .':'.$url_parts{'port'};
  $db['user'] = $url_parts{'user'};
  $db['pass'] = $url_parts{'pass'};
  $db['dbname'] = $db_name;
endif;
$mysqli = new mysqli($db['dbhost'],$db['user'],$db['pass'],$db['dbname']);


$sql = 'select 1 from `page` LIMIT 1';
$test = $mysqli->query($sql);

if($test !== FALSE):
  echo "DB already exists GROOVEY!!!!!\n";
else:
  echo "creating db.........\n";
  $sql = file_get_contents('./tables.sql',true);
  mysqli_multi_query($mysqli,$sql);
endif;
