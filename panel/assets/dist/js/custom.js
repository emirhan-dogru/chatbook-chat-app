//data input-mask
$(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    //Money Euro
    $('[data-mask]').inputmask();

})

$(document).ready(function(){

	$('.remove-btn').click(function(e){

		var $data_url = $(this).data("url");

		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = $data_url;
			}
		})

	})

})
