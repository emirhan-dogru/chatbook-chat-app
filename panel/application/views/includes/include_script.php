<script type="text/javascript">

$(document).ready(function(){

	setInterval(function() {$(".friends").load("<?php echo base_url("reload_friendList"); ?>");}, 1000);

})



</script>
