<?php

    include_once "../connections/conections.php";
    include_once "../connections/model.php";
    include_once "mail/enviaEmail.php";

    $model = new Model;
    $result_advogados = $model->busca_advogados_cadastrados($con);

    $meu_cpf = "10701027681";

    if(isset($_GET["mensagem"])){

        $mensagem = $_POST["descricaoMensagem"];

        $destino = $_POST["advogadosSistema"];

        $result_busca_advogado_email = $model->busca_Advogado_porEmail($destino, $con);

        $resultado_query_email = mysqli_fetch_array($result_busca_advogado_email);
        $cpf_advogado_retornado_email = $resultado_query_email["cpf"];

        $result_mensagem = $model->cadastra_nova_mensagem($meu_cpf, $mensagem, $cpf_advogado_retornado_email, $con);


        $email = encaminhaEmail($destino, $mensagem, $email_origem, $senha_email_origem, "Contato eLAW - Portal do Advogado Online");

        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=mensagens.php'>";
    }

    $result_mensagens_enviadas = $model->busca_mensagens($meu_cpf, $con);

    $result_clientes = $model->busca_casos_juridicos($meu_cpf, $con);

    if(isset($_GET["notifica"])){

        $aNotificaCliente = explode(';', $_POST["clientesAdvogado"]);
        $email_cliente = $aNotificaCliente[0];
        $numero_caso = $aNotificaCliente[1];
        $id_caso = $aNotificaCliente[2];
        $mensagem = utf8_decode("O seu caso jurídico de número: ".$numero_caso.", recebeu uma atualização por parte do Advogado com a seguinte mensagem:
         ".$_POST["descricaoNotificacao"]);

        $mes_vigencia = intval($_POST["mesFeedback"]);
        $data = date('Y-m-d');

        $result_new_feedback = $model->cadastra_novo_feedback($meu_cpf, $email_cliente, $data, $id_caso, $mes_vigencia, $con);

        
        $email = encaminhaEmail($email_cliente, $mensagem, $email_origem, $senha_email_origem, "Contato eLAW - Portal do Advogado Online");

        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=mensagens.php'>";
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
        <a class="nav-link" href="advogados.php">
          <i class="fas fa-fw fa-pencil-alt"></i>
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
                    <div style="margin-bottom: 5px;">
                        <button class="btn btn-outline-success" style="float: right;" data-toggle="modal" data-target="#notificaCliente"><i class="fa fa-envelope-open-text" ></i>&nbsp;&nbsp;Notificar Cliente</button>
                    </div>
                        <?php
                        while ($lista_mensagens = mysqli_fetch_array($result_mensagens_enviadas)){
                            echo '<div class="card">
                                  <div class="card-header" style="color: white; background-color: #8a6d3b; ">
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
                        <div class="col-md-12" style="background-color: #c0a16b;border-radius: 10px;margin-right: 3px;">
                            <div style="color: white; text-align: center;">* As mensagens enviadas foram, também, encaminhadas por e-mail.</div>
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
                                      if($lista_advogados['cpf'] != $meu_cpf){
                                          echo "<option id='advogado_nome' value='".$lista_advogados['email']."'>".$lista_advogados['nome_completo']."</option>";
                                      }
                                  }
                                  ?>
                              </select>
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

  <!-- Modal Notifica Clientes -->
  <div class="modal fade" id="notificaCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Nova Notificação</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form role="form" id="form-cadastro" action="?notifica=true" method="POST">
                      <div class="form-group">
                          <label for="clientesAdvogado">Clientes</label>
                          <select class="form-control" id="clientesAdvogado" name="clientesAdvogado">
                              <?php
                              while ($lista_clientes = mysqli_fetch_array($result_clientes)){
                                  echo "<option id='cliente_email' value='".$lista_clientes['email_cliente'].";".$lista_clientes['numero_caso'].";".$lista_clientes['id_caso']."'>".$lista_clientes['nome_cliente']."</option>";
                              }
                              ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="mesFeedback">Mês</label>
                          <select class="form-control" id="mesFeedback" name="mesFeedback">
                              <?php
                              $c = 1;
                              while ($c <= 12){
                                  echo "<option id='mes' value='".$c."'>".$c."</option>";
                                  $c = $c+1;
                              }
                              ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="mensagem">Descrição</label>
                          <textarea type="text" class="form-control" id="descricaoNotificacao" name="descricaoNotificacao"></textarea>
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
