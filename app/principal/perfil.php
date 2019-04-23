<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 19/04/2019
 * Time: 17:21
 */
    include_once "../connections/conections.php";
    include_once "../connections/model.php";
    $model = new Model();

    $dados_mural = "";
    include_once "mural_perfil_law.php";

    $nome_advogado = "FERNANDO DE MAGALHAES JUNIOR ";
    $area_atuacao = "Imobiliário";
    $website = "https://www.advocaciafernandojr.com.br/";
    $numero_registro_oab = "58751";
    $seccional = "MG";
    $subsecao = "Belo Horizonte";
    $data_inscricao = "10/02/1993";
    $telefone_principal = "(31) 32260-6766";
    $cep = 30380010;
    $endereco_profissional = "RUA BERNARDO MASCARENHAS, 25 CIDADE JARDIM, CEP: ".$cep;
    $formacao = "UNIVERSIDADE FEDERAL DE MINAS GERAIS - UFMG / Ano: 1992";

    if(isset($_POST["mural"]) && $_POST["mural"] != ""){
        $mural_novo = $_POST["mural"];

        $is_link = strstr($mural_novo, "www.") ? 1 : 0;

        if($is_link){
            $mural_novo = "O advogado disponibilizou um novo link".$mural_novo;
        }

        $result_novo_mural = $model->inserir_mural_advogado("10701027681", $mural_novo, $is_link, $con);
        $_POST["mural"] = NULL;

        echo "<meta HTTP-EQUIV='refresh' CONTENT='1;URL=perfil.php'>";
    }

    $dados_mural_existente = $dados_mural;

?>

<!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-LAW - Seu caso no seu controle</title>

    <!-- Custom fonts for this template-->
    <link href="../Util/principal/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../Util/principal/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../Util/principal/css/sb-admin.css" rel="stylesheet">

    <link href="perfil_css/perfil_css.css" rel="stylesheet">

</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">E-LAW</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="group">
            <p>&nbsp;</p>
        </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger">1</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                <a class="dropdown-item" href="#">Ver notificações</a>
            </div>
        </li>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="perfil.php">Meu Perfil</a>
                <a class="dropdown-item" href="#">Preferências</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Sair</a>
            </div>
        </li>
    </ul>

</nav>

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Painel de Controle</span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Páginas</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <!-- <h6 class="dropdown-header">Other Pages:</h6> -->
                <a class="dropdown-item" href="mensagens.html">Mensagens</a>
                <a class="dropdown-item" href="calendario.php">Calendário</a>
                <a class="dropdown-item" href="casos_juridicos.php">Casos Jurídicos</a>
                <a class="dropdown-item" href="anotacoes.html">Anotações</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Gráficos</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tabelas.html">
                <i class="fas fa-fw fa-table"></i>
                <span>Tables</span></a>
        </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Painel de Controle</a>
                </li>
                <li class="breadcrumb-item active">Perfil</li>
            </ol>


            <div class="container emp-profile">
                <form method="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-img">
                                <img src="https://www.oabmg.org.br/fotosAdv/50821.jpg" alt="" />
                                <!-- <div class="file btn btn-lg btn-primary">
                                    Change Photo
                                    <input type="file" name="file"/>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-head">
                                <h5>
                                    <?php echo $nome_advogado; ?>
                                </h5>
                                <h6>
                                   Área de Atuação: <?php echo $area_atuacao; ?>
                                </h6>
                                <p class="proile-website">WEBSITE : <span><a href="http://www.advocaciafernandojr.com.br/" target="_blank">Visitar</a></span></p>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Sobre</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Mural</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-2"> <!-- VER COMO FAZER PARA EDITAR O PERFIL -->
                            <button class="profile-edit-btn" name="btnAddMore" onclick="exibirEdicao('perfil_Edit', 'perfil')">Editar Perfil</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-work">
                                <p>Dados OAB</p>
                                <a href="" style="pointer-events: none; cursor: default;">Inscrição: <span style="color: #8c8c8c;"><?php echo $numero_registro_oab; ?></span></a><br/>
                                <a href="" style="pointer-events: none; cursor: default;">Seccional: <span style="color: #8c8c8c;"><?php echo $seccional; ?></span></a><br/>
                                <a href="" style="pointer-events: none; cursor: default;">Subseção: <span style="color: #8c8c8c;"><?php echo $subsecao; ?></span></a><br/>
                                <a href="" style="pointer-events: none; cursor: default;">Data de Inscrição: <span style="color: #8c8c8c;"><?php echo $data_inscricao; ?></span></a><br/>
                            </div>
                        </div>
                        <div id="perfil" name="perfil" class="col-md-8" style="display: block;">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nome Completo</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $nome_advogado; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Telefone Profissional</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $telefone_principal; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Formação Profissional</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $formacao; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Endereço Profissional</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $endereco_profissional; ?></p>
                                            <p><a target="_blank" href="https://www.google.com/maps/dir/?api=1&origin=&destination=<?php echo $cep; ?>">Ver Trajeto<img src="https://img.icons8.com/color/420/google-maps.png" height="30" width="30"></a></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <p><?php echo $dados_mural_existente; ?></p>
                                    <div class="row">
                                        <form class="form" method="POST" id="form_mural" action="?novo=m">
                                            <div class="col-md-8">
                                                <textarea type="text" class="form-control" id="mural" name="mural" placeholder="Digite aqui o seu texto"></textarea>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-outline-success">Postar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="edit_perfil" name="edit_perfil" style="display: none;">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nome Completo</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input id="input_nome" name="input_nome" value="<?php echo $nome_advogado; ?>"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Telefone Profissional</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input id="input_nome" name="input_nome" value="<?php echo $telefone_principal; ?>"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Formação Profissional</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input id="input_nome" name="input_nome" value="<?php echo $formacao; ?>"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Endereço Profissional</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo $endereco_profissional; ?></p>
                                        <p><a target="_blank" href="https://www.google.com/maps/dir/?api=1&origin=&destination=<?php echo $cep; ?>">Ver Trajeto<img src="https://img.icons8.com/color/420/google-maps.png" height="30" width="30"></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Your Website 2019</span>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../Util/principal/vendor/jquery/jquery.min.js"></script>
<script src="../Util/principal/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../Util/principal/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../Util/principal/js/sb-admin.min.js"></script>

</body>

</html>

