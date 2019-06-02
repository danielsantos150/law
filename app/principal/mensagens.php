<?php

    include_once "../connections/conections.php";
    include_once "../connections/model.php";

    $model = new Model;
    $result_advogados = $model->busca_advogados_cadastrados($con);

    if(isset($_GET["mensagem"])){

        $mensagem = $_POST["descricaoMensagem"];
        $origem = "10701027681";
        $destino = $_POST["advogadosSistema"];
        $tipo_contato = $_POST["tipoContato"];

        $result_mensagem = $model->cadastra_nova_mensagem($destino, $mensagem, $origem, $tipo_contato, $con);

        echo "<meta HTTP-EQUIV='refresh' CONTENT='1;URL=mensagens.php?'>";
    }

    $result_mensagens_enviadas = $model->busca_mensagens("10701027681", $con);

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
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Painel de Controle</span>
        </a>
      </li>
      <li class="nav-item active">
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
      <li class="nav-item">
        <a class="nav-link" href="casos_juridicos.php">
          <i class="fas fa-fw fa-th-list"></i>
          <span>Casos Jurídicos</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="anotacoes.html">
          <i class="fas fa-fw fa-pencil-alt"></i>
          <span>Anotações</span>
        </a>
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
            <li class="breadcrumb-item active">Mensagens</li>
          </ol>

          <!-- Page Content -->
            <div class="card" style="margin-top: 5px;">
                <div class="card-header h6">Mensagens
                    <button class="btn btn-success" style="position: relative; float: right;" data-toggle="modal" data-target="#cadastroMensagens">
                        <span class="fa fa-plus"></span>
                    </button>
                </div>
                <div class="card card-body">
                        <?php
                        while ($lista_mensagens = mysqli_fetch_array($result_mensagens_enviadas)){
                            echo '<div class="card">
                                  <div class="card-header" style="color: white; background-color: '.$lista_mensagens["tipo_contato"].'; ">
                                    Destinatário: '.$lista_mensagens["nome_completo"].'
                                  </div>
                                  <div class="card-body">
                                    <blockquote class="blockquote mb-0">
                                      <p>'.$lista_mensagens["mensagem"].'</p>
                                      <footer class="blockquote-footer">Enviada em <cite title="Source Title">'.$lista_mensagens["data"].'</cite></footer>
                                    </blockquote>
                                  </div>
                                </div>';
                        }
                        ?>
                </div>
                <div class="card card-footer">
                    <div class="row">
                        <div class="col-md-4" style="background-color: #8fdf82;border-radius: 10px;margin-right: 3px;">
                            <div style="color: white; text-align: center;">* Mensagens de cunho pessoal</div>
                        </div>
                        <div class="col-md-5" style="background-color: green; border-radius: 10px;">
                            <div style="color: white; text-align: center;">** Mensagens de cunho profissional (coworking)</div>
                        </div>
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

  <!-- Mensagens Modal -->
  <div class="modal fade" id="cadastroMensagens" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Nova Mensagem</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form role="form" id="form-cadastro" action="?mensagem=true" method="POST">
                      <div class="form-group">
                          <div class="form-group">
                              <label for="advogadosSistema">Advogados</label>
                              <select class="form-control" id="advogadosSistema" name="advogadosSistema">
                                  <?php
                                  while ($lista_advogados = mysqli_fetch_array($result_advogados)){
                                      echo "<option id='advogado_nome' value='".$lista_advogados['cpf']."'>".$lista_advogados['nome_completo']."</option>";
                                  }
                                  ?>
                              </select>
                          </div>

                          <label for="tipoContato">Tipo de Contato:</label>
                          <div class="form-group">
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="tipoContato" id="contatoCoworking" value="green">
                                  <label class="form-check-label" for="inlineRadio1">Coworking</label>
                              </div>
                              <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="tipoContato" id="contatoPessoal" value="#8fdf82">
                                  <label class="form-check-label" for="inlineRadio2">Pessoal</label>
                              </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="mensagem">Mensagem</label>
                          <textarea type="text" class="form-control" id="descricaoMensagem" name="descricaoMensagem"></textarea>
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-success">Cadastrar</button>
                      </div>
                  </form>
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
