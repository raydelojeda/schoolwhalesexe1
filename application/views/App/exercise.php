<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise</title>

    <link rel="canonical" href="https://keenthemes.com/metronic" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    <!-- INCLUDE CSS -->
    <link href="<?php echo base_url('assets/css/plugins.bundle.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/style.bundle.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/dataTable.css')?>" rel="stylesheet" type="text/css" />

</head>
<body>
    <?php include('modal.php');?>
    <div class="container mt-10">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title text-dark" style="font-size: 25px;">
                    <!-- TITLE -->
                    <strong>CRUD</strong>
                </h3>
            </div>
            <div class="card-body">
                <div class="container">
                    <!-- SEARCH DATA TABLE -->
                    <div class="row">
                        <div class="col-12 col-lg-3">
                            <div class="input-icon">
                                <input type="text" class="form-control form-control-solid" placeholder="Filter..." id="kt_datatable_search_query" />
                                <span>
                                    <i class="flaticon2-search-1 text-muted"></i>
                                </span>
                            </div>
                        </div>
                        <!-- BTN ADD -->
                        <div class="col-12 col-lg-9">
                            <div class="text-right">
                                <button id="btn-add" type="button" class="btn btn-clean text-primary" title="añadir artículo"><i class="flaticon-add text-primary"></i> ADD</button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-10">
                        <div class="col-12">
                            <div class="card card-custom">
                                <div class="card-body">
                                    <div style="width: 100%;" class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div> 
                                </div>
                            </div>
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#0BB783", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#D7F9EF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
<script src="<?php 	echo base_url('assets/js/plugins.bundle.js');?>"></script>
<script src="<?php echo base_url('assets/js/scripts.bundle.js');?>"></script>

<script>
    $(document).ready(function () 
    {
        $('#btn-add').on('click', function () 
        {
            $('#modal').modal('show');
        });

        /* SECTION DATA TABLE */
        var KTDatatableDataLocalDemo = function() 
        {
            var demo = function() 
            {
                var dataJSONArray = JSON.parse('<?php echo $data;?>');

                var datatable = $('#kt_datatable').KTDatatable(
                {
                    data: 
                    {
                        type: 'local',
                        source: dataJSONArray,
                        pageSize: 5,
                        saveState: false,
                    },

                    layout: 
                    {
                        scroll: false, 
                        footer: false, 
                    },

                    sortable: false,
                    pagination: false,

                    search: 
                    {
                        input: $('#kt_datatable_search_query'),
                        key: 'generalSearch',
                    },

                    rows:
                    {
                        autoHide: false,
                    },

                    columns: 
                    [
                        {
                            field: 'ID',
                            title: 'ID',     
                        },  

                        {
                            field: 'name',
                            title: 'NAME',     
                        }, 

                        {
                            field: 'lastName',
                            title: 'LAST NAME',     
                        }, 

                        {
                            field: 'email',
                            title: 'EMAIL',     
                        },

                        {
                            field: '',
                            title: '',
                            sortable: false,
                            overflow: 'visible',

                            template: function(row) 
                            {
                                return '\
                                    <button data-edit-ID="' + row.ID + '" data-result-val="' + row.ID + '" class="btn btn-clean icon-md" title="Editar">\
                                        <i class="fas fa-edit icon-md"></i>\
                                    </button>\
                                    \<button data-del-ID="' + row.ID + '" data-result-val="'+ row.ID +'" class="btn btn-clean icon-md" title="Eliminar">\
                                        <i class="fas fa-trash-alt icon-md"></i>\
                                    </button>'
                            }
                        },
                    ],
                });

                datatable.on('click', '[data-edit-ID]', function() // EDIT  
                {
                    
                    let ID = $(this).data('result-val');
                    let name = '';

                    let post = {
                        ID : ID,
                        name : name
                    }

                    console.log(ID);

                    /*$.ajax({
                        type: "post",
                        url: "<?php echo base_url('Article/callEditCategorie');?>",
                        data: {post},
                        dataType: "html",
                    
                    }).done( function(response)
                    {
                        $('#main-container').html(response);

                    }).fail( function(response)
                    {
                        swal.fire({ title: "Ha ocurrido un error inténtelo nuevamente si el problema persiste espere unos minutos", icon: "error", buttonsStyling: false, confirmButtonText: "Cerrar", customClass: {confirmButton: "btn font-weight-bold btn-light-primary"}});
                    });*/

                });

                datatable.on('click', '[data-del-ID]', function() // DEL CATEGORIE 
                {
                    let post = $(this).data('result-val'); 

                    console.log(post);

                    /*$.ajax(
                    {
                        type: "post",
                        url: "<?php echo base_url('Article/delCategorie');?>",
                        data: {post},
                        dataType: "html",
                        
                    }).done( function(response)
                    {
                        if(response == 'success')
                        {
                            swal.fire({position: "top-right",icon: "success",title: "Categoría eliminada",showConfirmButton: false,timer: 1500});

                            $.ajax( // RELOAD DATA TABLE
                            {
                                type: "post",
                                url: "<?php echo base_url('Article/dtCategorie');?>",
                                dataType: "html",
                            
                            }).done( function(response)
                            {
                                $("#dataTable").html(response);

                            }).fail( function(response)
                            {
                                swal.fire({ title: "Ha ocurrido un error inténtelo nuevamente si el problema persiste espere unos minutos", icon: "error", buttonsStyling: false, confirmButtonText: "Cerrar", customClass: {confirmButton: "btn font-weight-bold btn-light-primary"}});
                            });
                        }
                        else
                        {
                            swal.fire({ title: "No se puede eliminar una categoría que esté relacionada con 1 o más artículos", icon: "error", buttonsStyling: false, confirmButtonText: "Cerrar", customClass: {confirmButton: "btn font-weight-bold btn-light-primary"}});
                        }
                    }).fail( function(response)
                    {
                        swal.fire({ title: "Ha ocurrido un error inténtelo nuevamente si el problema persiste espere unos minutos", icon: "error", buttonsStyling: false, confirmButtonText: "Cerrar", customClass: {confirmButton: "btn font-weight-bold btn-light-primary"}});
                    });*/
                });  
            };
            return {
                        init: function() 
                        {
                            demo();
                        },
                    };
        }();

        jQuery(document).ready(function() 
        {
            KTDatatableDataLocalDemo.init();
        });
    });
</script>