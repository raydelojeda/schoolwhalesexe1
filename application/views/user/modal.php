<div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="modal-content">
            <div class="modal-header">
                <!-- MODAL TITLE -->
                <h5 class="modal-title">Form</h5>
                <!-- MODAL BTN CLOSE MODAL -->
                <button type="button" class="btn btn-clean text-dark closeModal">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body mb-10" style="height: 80%;">
                <div class="container"> 
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <label for=""><strong>Name:</strong>
                                <input type="text" class="form-control require clear" id="name" />
                            </label>
                        </div>
                        <div class="col-6 col-lg-6">
                            <label for=""><strong>Last Name:</strong>
                                <input type="text" class="form-control require clear" id="lastName" />
                            </label>
                        </div>
                    </div>
                    <div class="row mt-15">
                        <div class="col-12">
                        <label for=""><strong>Email:</strong>
                                <input type="text" class="form-control require email clear" id="email" />
                            </label>
                        </div>
                    </div>
                </div>   
            </div>
            <!-- MODAL FOOTER -->
            <div class="modal-footer mt-10">
                <button id="btn-submit" type="button" class="btn btn-sm btn-primary">Submit</button>
                <button type="button" class="btn btn-sm btn-secondary closeModal">Close</button>            
            </div>
        </div>
    </div>
</div>

<input class="clear" type="text" id="id" hidden />

<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#0BB783", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#D7F9EF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
<script src="<?php 	echo base_url('assets/js/plugins.bundle.js');?>"></script>
<script src="<?php echo base_url('assets/js/scripts.bundle.js');?>"></script>

<script>
    $(document).ready(function () 
    {
        $('#btn-submit').on('click', function () 
        {
            let validateForm = requireValues('require');

            if(validateForm === 'success')
            {
                let validEmail = myValidEmail($('#email').val());

                if(validEmail === 'valid')
                {
                    var target = document.getElementById('modal-content'); 
                    var spinner = new Spinner(opts).spin(target);

                    let post = {
                        ID : $('#id').val(),
                        name: $('#name').val(),
                        lastName: $('#lastName').val(),
                        email: $('#email').val() 
                    }

                    if($('#id').val() == '')
                        functionName = 'create';
                    else
                        functionName = 'update';

                    $.ajax({
                    type: "post",
                    url: "<?php echo base_url('CUser/');?>"+functionName,
                    data: {post},
                    dataType: "html",
                   
                    }).done( function(response)
                    {
                        if(response === 'success')
						{
                            Swal.fire({position: "top-right",icon: "success", title: "success",showConfirmButton: false,timer: 2500});	
                            setTimeout(function()
                            {
                                spinner.stop();
                                $('.closeModal').click();
                            }, 3000);						
						}
                        else
                        {
                            spinner.stop();
                        	swal.fire({text: "An error has occurred",icon: "error", buttonsStyling: false, confirmButtonText: "Close",customClass: {confirmButton: "btn font-weight-bold btn-light-primary closeModal"}});
                        }

                    }).fail( function(response)
                    {
                        spinner.stop();
                        swal.fire({text: "An error has occurred",icon: "error", buttonsStyling: false, confirmButtonText: "Close",customClass: {confirmButton: "btn font-weight-bold btn-light-primary closeModal"}});
                    });
                }
                else
                    $('.email').addClass('is-invalid');
            }
        });

        $('.closeModal').on('click', function ()
        {
            $('#modal').modal('hide');
            $('.modal-backdrop').remove(); /* REMOVE SHOW MODAL */
            $('#kt_body').removeClass('modal-open'); /* QUI TO BODY CLASS MODAL OPEN */

            window.location.reload();
        });
    });
    
</script>
