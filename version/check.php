<pre>
<?php
$alphas = range('A', 'Z');
print_r($alphas);
session_start();
print_r($_SESSION);
print_r($_COOKIE);
print_r($GLOBALS);
print_r($_SERVER);
print_r($_SERVER['PHP_SELF']);

phpinfo();

?>