<script type="text/javascript">
	
	$(document).ready(function(){
	
		$('.ui-tab').click(function(e){

			$(this).attr('aria-controls','');
			window.location.href=$(this).find('.ui-tabs-anchor').attr('href');
		});

		$('.ui-tab').each(function(e){
			$(this).attr('aria-controls','');
		});
	});

	$( "#tabs" ).tabs({ active: <?php echo $warehouselinks['active']; ?> });

</script>