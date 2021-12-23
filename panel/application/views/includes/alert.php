<?php 

$alert = $this->session->userdata('alert');

if($alert) { ?>
<script type="text/javascript">
	iziToast.<?php echo $alert['type'];?>({
    title: '<?php echo $alert['title'];?>',
    message: '<?php echo $alert['text'];?>',
    position: 'topCenter'
});
</script><?php 
}

 ?>