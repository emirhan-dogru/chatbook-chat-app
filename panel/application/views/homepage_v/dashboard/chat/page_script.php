<script type="text/javascript">


	$(function() {
		$("#message").load("<?php echo base_url("reload_message/$friend_id") ?>");
		$("#scroll").animate({ scrollTop: "10000px" });


	});

	setInterval(function() {$("#message").load("<?php echo base_url("reload_message/$friend_id") ?>");}, 1500);
</script>
