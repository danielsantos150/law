<?php

    include_once "casos_juridicos_list.php";

    $model = new Model;

    $nomeAdvogado = "Dr. Fernando Junior";

    if(isset($_GET["caso"])){
        $idcaso = $_GET["caso"];

        $result_caso = $model->busca_caso_juridico_por_id("10701027681", $idcaso, $con);

        while ($linha_caso = mysqli_fetch_array($result_caso)){

            $titulo_processo        = $linha_caso["titulo_processo"];
            $cpfcnpj_advogado       = $linha_caso["cpfcnpj_advogado"];
            $status                 = $linha_caso["status"];
            $ultima_alteracao       = $linha_caso["ultima_alteracao"];
            $nome_cliente           = $linha_caso["nome_cliente"];
            $tipo_processo          = $linha_caso["tipo_processo"];
            $autuacao               = $linha_caso["autuacao"];
            $ramo_direito           = $linha_caso["ramo_direito"];
            $relator                = $linha_caso["relator"];
            $numero_caso            = $linha_caso["numero_caso"];
            $classe_judicial        = $linha_caso["classe_judicial"];
            $orgao_julgador         = $linha_caso["orgao_julgador"];
        }
    }
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
          <span>Tabelas</span></a>
      </li>
    </ul>

        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php">Painel de Controle</a>
                    </li>
                    <li class="breadcrumb-item active">Casos Jurídicos</li>
                    <li class="breadcrumb-item active">Caso nº <?php echo $numero_caso; ?></li>
                </ol>
                <div class="card">
                    <p class="card-header h6" data-toggle="collapse" href="#dadosResumido" role="button" aria-expanded="false" aria-controls="dadosResumido">
                        Dados do Processo <span style="float: right; color: #ccc;" class="fa fa-chevron-down"></span>
                    </p>

                    <div class="collapse" id="dadosResumido">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <span style="font-weight: bold;">Número Processo</span><br>
                                    <?php echo $numero_caso; ?><br>
                                    <span style="font-weight: bold;">Nome do Cliente</span><br>
                                    <?php echo $nome_cliente; ?>
                                </div>
                                <div class="col-sm-4">
                                    <span style="font-weight: bold;">Classe Judicial</span><br>
                                    <?php echo $classe_judicial; ?><br>
                                    <span style="font-weight: bold;">Órgão Julgador</span><br>
                                    <?php echo $orgao_julgador; ?>
                                </div>
                                <div class="col-sm-4">
                                    <span style="font-weight: bold;">Assunto</span><br>
                                    <?php echo $titulo_processo; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 5px;">
                    <p class="card-header h6">Polo Ativo</p>
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="img-picker"></div>
                            </div>
                            <div class="col-sm-9">
                                <span style="font-weight: bold;">Número Processo</span><br>
                                <?php echo $numero_caso; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin-top: 5px;">
                    <p class="card-header h6">Polo Passivo</p>
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <span style="font-weight: bold;">Número Processo</span><br>
                                <?php echo $numero_caso; ?>
                            </div>
                            <div class="col-sm-9">
                                <span style="font-weight: bold;">Número Processo</span><br>
                                <?php echo $numero_caso; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <p>
                    <button data-toggle="progressbar" data-target="#myProgressbar" data-value="reset" data-level="info" class="btn btn-success">Reset</button>
                    <button data-toggle="progressbar" data-target="#myProgressbar" data-value="0" class="btn btn-default">0%</button>
                    <button data-toggle="progressbar" data-target="#myProgressbar" data-value="10" class="btn btn-default">10%</button>
                    <button data-toggle="progressbar" data-target="#myProgressbar" data-value="30" class="btn btn-default">30%</button>
                    <button data-toggle="progressbar" data-target="#myProgressbar" data-value="75" class="btn btn-default">75%</button>
                    <button data-toggle="progressbar" data-target="#myProgressbar" data-value="100" class="btn btn-default">100%</button>
                    <button data-toggle="progressbar" data-target="#myProgressbar" data-value="finish" data-level="success" class="btn btn-default">Finish</button>
                </p>

                <div id="myProgressbar" class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                        <span class="sr-only">0% Complete</span>
                    </div>
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

  <script src="https://code.jquery.com/jquery.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  <script src="../Util/js/progressbar.js"></script>

</body>

</html>
