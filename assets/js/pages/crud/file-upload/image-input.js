'use strict';
var KTImageInputDemo = function () 
{
	var initDemos = function () 
	{
		var avatar5 = new KTImageInput('kt_image_5');

		avatar5.on('cancel', function(imageInput) 
		{
			/*Swal.fire(
			{
				position: "top-right",
				icon: "success",
				title: "Imagen Eliminada",
				showConfirmButton: false,
				timer: 1500
			});*/
		});

		avatar5.on('change', function(imageInput) 
		{
			/*Swal.fire(
			{
				position: "top-right",
				icon: "success",
				title: "Imagen Cargada",
				showConfirmButton: false,
				timer: 1500
			});*/
		});
	}

	return {
		init: function() {
			initDemos();
		}
	};
}();

KTUtil.ready(function() {
	KTImageInputDemo.init();
});
