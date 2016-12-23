<?
session_start();
foreach( $_SESSION as $a => $b )
{
	echo '<br>'. $a .'='.$b;
}

foreach( $_SERVER as $a => $b )
{
	echo '<br>'. $a .'='.$b;
}

?>