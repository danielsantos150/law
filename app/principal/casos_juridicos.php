<?php

    include_once "casos_juridicos_list.php";

    $nomeAdvogado = "Dr. Fernando Junior";

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

    <style type="text/css">
        #corteIframe {
            position: absolute;
            clip: rect(0px,1080px,750px,0px);
             /* pode colocar o mesmo valor do segundo parâmetro */
        }
    </style>

    <script>
        function Mudarestado(el) {
            var display = document.getElementById(el).style.display;
            if(display == "none"){
                document.getElementById(el).style.display = 'block';
                document.getElementById('interno').style.display = 'none';
                $('#framepje').attr('src', $('#framepje').attr('src'));
            }else{
                document.getElementById(el).style.display = 'none';
                document.getElementById('interno').style.display = 'block';
                $('#framepje').attr('src', $('#framepje').attr('src'));
            }
        }
    </script>

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
          <li class="nav-item">
              <a class="nav-link" href="index.php">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>Painel de Controle</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="mensagens.php">
                  <i class="fas fa-fw fa-envelope"></i>
                  <span>Mensagens</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="calendario.php">
                  <i class="fas fa-fw fa-calendar"></i>
                  <span>Agenda</span>
              </a>
          </li>
          <li class="nav-item active">
              <a class="nav-link" href="casos_juridicos.php">
                  <i class="fas fa-fw fa-newspaper"></i>
                  <span>Casos Jurídicos</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="advogados.php">
                  <i class="fas fa-fw fa-pencil-ruler"></i>
                  <span>Advogados</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="charts.php">
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
            </ol>

            <!-- Page Content -->
            <h1>Casos Jurídicos</h1>
            <hr>
            <p>Caro Advogado(a), nesta secção serão apresentados todos os casos jurídicos por você cadastrados na plataforma.</p>
            <hr>
            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-folder-open"></i>
                        Casos Jurídicos do <?php echo $nomeAdvogado; ?>
                    <button class="btn btn-success" style="float: right; width: 250px;" onclick="Mudarestado('externo')"><i class="fa fa-external-link-alt" ></i>&nbsp;&nbsp;Abrir Consulta Externa</button>
                </div>
                <div id="interno">
                    <?php echo $listagem_casos; ?>
                </div>
                <div id="externo" style="display:none; margin: 5px;">
                    <p>Realize a pesquisa do caso jurídico pela nossa parceira o <b>PJe Consulta Pública</b>.</p>
                    <div id="corteIframe" style="margin-top: 10px;">
                        <iframe id='framepje' src="https://pje.tjmg.jus.br/pje/ConsultaPublica/listView.seam" style="width:1080px; height:600px; border: none; " scrolling="no"></iframe>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</body>

</html>
