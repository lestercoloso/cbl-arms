
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,
    'api.adobomall.com');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $contents = curl_exec ($ch);
    echo "<pre>";
    print_r(json_decode($contents, TRUE));
    echo "</pre>";
    curl_close ($ch);
?>

<style>
.warehouse_container {
	position: relative;
	top: 3px;
	left: 3px;
    width: 445px;
    height: 445px;
    background: #fff;
    -webkit-clip-path: polygon(0% 0%, 75% 0%, 100% 50%, 75% 100%, 0% 100%);
    clip-path: polygon(0% 0%, 0% 0%, 70% 0%, 75% 100%, 0% 80%);
}
.warehouse_border {
	margin: 20px auto;
    width: 453px;
    height: 452px;
    background: #000;
    -webkit-clip-path: polygon(0% 0%, 75% 0%, 100% 50%, 75% 100%, 0% 100%);
    clip-path: polygon(0% 0%, 0% 0%, 70% 0%, 75% 100%, 0% 80%);
}

/* Center the demo */
html, body {
  height: 100%;
}
body {
/*  display: flex;
  justify-content: center;
  align-items: center;*/
}
</style>

<div class="warehouse_border">
<div class="warehouse_container"></div>
</div>