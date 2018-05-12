<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<head>

    <base href="<?php echo base_url() ?>">
    <?php
    $this->load->view("template/html_head_section");
    ?>
</head>
    <body data-open="click"
          data-menu="vertical-menu"
          data-col="2-columns"
          class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar">
    <!-- - var navbarShadow = true-->
    <!-- fixed-top-->
    <!-- Star of nav -->
    <?php
    $this->load->view("template/html_nav_section");
    ?>



    <!-- Left Menu-->
    <?php
    $this->load->view("template/html_left_menu");
    ?>




    <!-- CONTENIDO -->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-2">


                    <div class="d-flex w-100 justify-content-between">

                        <div class="align-left">

                            <h3 class="content-header-title mb-0">Generación de reportes</h3>
                            <div class="row breadcrumbs-top">
                                <div class="breadcrumb-wrapper col-12">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item glyphicon glyphicon-eye-open" ><a href="" onclick="return false;">Reporte Balance</a>
                                        </li>
                                    </ol>
                                </div>
                            </div>

                        </div>




                    </div>

                </div>
            </div>
            <div class="content-body">

                <form id="formulario" action="" method="post">


                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="perodoMes">Periodo Mes:</label>
                                <select id="perodoMes"
                                        name="perodoMes"
                                        class="form-control"
                                >
                                    <option value="10">Ocubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="perodoAnno">Periodo A&nacute;o:</label>
                                <select id="perodoAnno"
                                        name="perodoAnno"
                                        class="form-control"
                                >
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                </select>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="card">
                            <div class="card-content">
                                <div class="media align-items-stretch">
                                    <div class="p-2 text-center bg-primary bg-darken-2">
                                        <i class="glyphicon glyphicon-paste"></i>
                                    </div>
                                    <div class="p-2 bg-gradient-x-primary white media-body">
                                        <h5>Reporte de Comprobaci&oacute;n</h5>
                                        <h5 class="text-bold-400 mb-0"><i class="ft-plus"></i> 28</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>





                </form>


                <div class="row">
                    <div class="col-sm-12">



                    </div>
                </div>



            </div>
        </div>
    </div>




    <!-- start of footer -->
    <?php
    $this->load->view("template/html_footer_section");
    ?>
    <!-- enf of footer -->

        <script>
            $(document).ready( function (e) {
                    $(".card").click(function () {
                        //e.preventDefault();
                        try {
                            $('#formulario').attr('action', "<?= $url ?>/AUCReportes/reporteComprobacion").submit();
                        }
                        catch(err) {
                            alert(err.message);
                        }

                    });
                }
            );



            function generateExcel() {
                try {
                    $('#formulario').attr('action', "<?= $url ?>/AUCReportes/generaExcelComprobacion").submit();
                }
                catch(err) {
                    alert(err.message);
                }
            }

        </script>

    </body>
</html>