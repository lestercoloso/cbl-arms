<?php

$fetch = isset($_POST['fetch']) ? $_POST['fetch'] : "";
$post = isset($_POST['branch']) ? $_POST['branch'] : " ";


?>
<form method="post">

<input type="text" name="branch" id="branch" value="<?php echo trim($post);?>">
<input type="hidden" name="fetch" id="fetch">
<br>
<br>
<input type="submit" name="submit" value="Find" >
<input type="submit" name="refresh" onclick="clck();" value="Fetch" >

</form>
<script>
	document.getElementById("branch").focus();

	function clck(){
		document.getElementById("fetch").value = "1";
	}
</script>


<pre>
<?php
chdir('C:\/xampp\/htdocs\/nelsoft_inventory');

if($fetch){
	exec("git fetch");
}

exec("git branch -r" , $output);

$return = [];
foreach($output as $branches){
	
	$post = !empty($post) ? $post : " ";

	if (strpos(strtolower($branches), strtolower($post)) !== false) {
		$return[] =  $branches;
	}

}

print_r($return);

?>