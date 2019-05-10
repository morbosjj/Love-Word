<script src="jquery.js"></script>
<script type="text/javascript">
	$(document).click(function(){
		$("#id").fadeIn(500);
	});
</script>
<?php if (count($error2) > 0): ?>
	<div id="error"> 
		<?php foreach ($error2 as $error): ?>
			<p><?php echo $error; ?></p>
		<?php endforeach ?>	
	</div>
<?php endif ?>