<?php

    include_once "../connections/conections.php";
    include_once "../connections/model.php";

    $model = new Model();

    $result_agenda = $model->busca_compromissos_agenda("10701027681", $con);
    $dados_edicao = $model->busca_compromissos_agenda("10701027681", $con);

    if(isset($_GET['new']) && $_GET['new'] == true){

        $nomeNovaTarefa = $_POST['nomeNovaTarefa'];
        $dataInicioNovaTarefa = $_POST['dataInicioNovaTarefa'];
        $dataFimNovaTarefa = $_POST['dataFimNovaTarefa'];
        $descricaoNovaTarefa = $_POST['descricaoNovaTarefa'];
        $nivel = $_POST['colorNovaTarefa'];

        $result_nova_agenda = $model->adiciona_novos_compromissos("10701027681", $nomeNovaTarefa, $dataInicioNovaTarefa,
            $dataFimNovaTarefa, $nivel, $descricaoNovaTarefa, $con);

        echo "<meta HTTP-EQUIV='refresh' CONTENT='1;URL=calendario.php'>";
    }

    if(isset($_GET["edit"])  && $_GET['edit'] == true){
        var_dump($_POST);exit;
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

    <link href='../Util/principal/css_calendar/fullcalendar.min.css' rel='stylesheet' />
    <link href='../Util/principal/css_calendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src='../Util/principal/js_calendar/moment.min.js'></script>
    <script src='../Util/principal/js_calendar/jquery.min.js'></script>
    <script src='../Util/principal/lib_calendar/fullcalendar.min.js'></script>
    <script src='../Util/principal/locale/pt-br.js'></script>

  <!-- Custom fonts for this template-->
  <link href="../Util/principal/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../Util/principal/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../Util/principal/css/sb-admin.css" rel="stylesheet">

  <script>

    $(document).ready(function() {

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

      $('#calendar').fullCalendar({

        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        defaultDate: Date(),
        navLinks: true,
        editable: false,
        eventLimit: true,
      eventClick: function(event) {

          $('#detalhes #id').text(event.id);
          $('#detalhes #title').text(event.title);
          $('#detalhes #start').text(event.start.format('DD/MM/YYYY HH:mm'));
          $('#detalhes #end').text(event.end.format('DD/MM/YYYY HH:mm'));
          $('#detalhes #description').text(event.description);
          $('#detalhes').modal('show');
            return false;
      },
        events: [
            <?php
                while ($linha_agenda = mysqli_fetch_array($result_agenda)){
               ?>
                  {
                    id: '<?php echo $linha_agenda['idagenda'];?>',
                    title: '<?php echo $linha_agenda['tarefa'];?>',
                    start: '<?php echo $linha_agenda['data_inicio'];?>',
                    end: '<?php echo $linha_agenda['data_fim'];?>',
                    color: '<?php echo $linha_agenda['nivel'];?>',
                    description: '<?php echo $linha_agenda['descricao'];?>',
                  },
                <?php
                }
                ?>
        ]
        });
    });

    function editaTarefas(componente_1, componente_2){
        if(document.getElementById(componente_1).style.display == "none"){
            document.getElementById(componente_1).style.display = "block";
            document.getElementById(componente_2).style.display = "none";
        }
        else {
            document.getElementById(componente_1).style.display = "none";
            document.getElementById(componente_2).style.display = "block";
        }
    }

  </script>
    <style>
        #calendar {
            max-width: 1500px;
            margin: 0 auto;
        }
    </style>


</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">E-LAW</a>

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
          <a class="dropdown-item" href="#">Meu Perfil</a>
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
        <a class="nav-link" href="index.html">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Painel de Controle</span>
        </a>
      </li>
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Páginas</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <!-- <h6 class="dropdown-header">Other Pages:</h6> -->
          <a class="dropdown-item" href="mensagens.html">Mensagens</a>
          <a class="dropdown-item active" href="calendario.php">Calendário</a>
          <a class="dropdown-item" href="casos_juridicos.html">Casos Jurídicos</a>
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
              <a href="index.html">Painel de Controle</a>
            </li>
            <li class="breadcrumb-item active">Calendario</li>
          </ol>

          <!-- Page Content -->
           <h1 style="display: inline-block">Agenda</h1>
           <button class="btn btn-outline-info" style="float: right;margin-left: 5px;" data-toggle="modal" data-target="#adicionar">
               Adicionar
           </button>
            <button class="btn btn-outline-warning" style="float: right;" onclick="editaTarefas('agenda', 'alteraAgenda')">
                Editar
            </button>

          <hr>
            <div id="agenda">
                <div id='calendar'></div>
            </div>
            <div id="alteraAgenda">
                <?php
                //var_dump(mysqli_fetch_array($dados_edicao));exit;
                    while ($linha = mysqli_fetch_array($dados_edicao)){
                        /*var_dump($linha['idagenda']);
                        var_dump($linha['tarefa']);
                        var_dump($linha['data_inicio']);
                        var_dump($linha['data_fim']);
                        var_dump($linha['nivel']);
                        var_dump($linha['descricao']);*/

                        echo '<form class="form-inline" method="POST" action="?edit=TRUE" style="padding: 5px;">
                                  <div class="form-group">
                                    <input type="text" class="form-control" id="tarefa" name="tarefa" value='.$linha['tarefa'].'>&nbsp;
                                  </div>
                                  <div class="form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="Data de início anterior">'.date('d-m-Y H:m', strtotime($linha['data_inicio'])).'</span>                                    
                                    </div>
                                    <input class="form-control" type="datetime-local" id="data_inicio" name="data_inicio">&nbsp;                                    
                                  </div>
                                  <div class="form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" data-toggle="tooltip" data-placement="top" title="Data de término anterior">'.date('d-m-Y H:m', strtotime($linha['data_fim'])).'</span>                                    
                                    </div>
                                    <input class="form-control" type="datetime-local" name="data_fim" id="data_fim">&nbsp;
                                  </div>
                                  <input id="idagenda" type="hidden">
                                  <input type="checkbox" class="form-check" name="excluir" id="excluir" value="X" data-toggle="tooltip" data-placement="top" title="Excluir">&nbsp;
                                  <button type="submit" class="btn btn-outline-success" data-toggle="tooltip" data-placement="top" title="Salvar">OK</button>                                                               
                               </form>';
                    }
                ?>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © E-LAW 2019</span>
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

  <div class="modal fade" id="detalhes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Dados do Evento</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form>
                      <div class="form-group row">
                          <label for="titleTarefa" class="col-sm-2 col-form-label" style="font-weight: bold;">Tarefa:</label>
                          <div class="col-sm-10">
                              <dd id="title" class="form-group" style="margin-top: 7px;"></dd>
                          </div>
                          <label for="titleDescrition" class="col-sm-2 col-form-label" style="font-weight: bold;">Descrição:</label>
                          <div class="col-sm-10">
                              <dd id="description" class="form-group" style="margin-top: 7px;"></dd>
                          </div>
                          <label for="dateInicio" class="col-sm-2 col-form-label" style="font-weight: bold;">Início:</label>
                          <div class="col-sm-10">
                              <dd id="start" class="form-group" style="margin-top: 7px;"></dd>
                          </div>
                          <label for="dateFim" class="col-sm-2 col-form-label" style="font-weight: bold;">Fim:</label>
                          <div class="col-sm-10">
                              <dd id="end" class="form-group" style="margin-top: 7px;"></dd>
                          </div>
                          <dd id="id" style="display: none;"></dd>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>


  <div class="modal fade" id="adicionar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Dados do Evento</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form role="form" id="form-cadastro" action="?new=true" method="POST">
                      <div class="form-group">
                          <label for="tituloTarefa">Tarefa</label>
                          <input type="text" class="form-control" id="nomeTarefa" name="nomeNovaTarefa">
                      </div>
                      <div class="form-group">
                          <label for="dataInicio" class="col-form-label">Data Início</label>
                          <input class="form-control" type="datetime-local" id="dataInicioTarefa" name="dataInicioNovaTarefa">
                      </div>
                      <div class="form-group">
                          <label for="dataFim" class="col-form-label">Data Fim</label>
                          <input class="form-control" type="datetime-local" id="dataFimTarefa" name="dataFimNovaTarefa">
                      </div>
                      <div class="form-group">
                          <label for="nivel" class="col-form-label">Cor</label>
                          <input class="form-control" type="color" id="colorNovaTarefa" name="colorNovaTarefa" value="#87CEFA">
                      </div>
                      <div class="form-group">
                          <label for="descricao">Descrição</label>
                          <textarea type="text" class="form-control" id="descricaoTarefa" name="descricaoNovaTarefa"></textarea>
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
  <!-- JS comentado devido a importação anterior de outro js para o calendario -->
  <!-- <script src="../Util/principal/vendor/jquery/jquery.min.js"></script> -->
  <script src="../Util/principal/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../Util/principal/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../Util/principal/js/sb-admin.min.js"></script>

</body>

</html>
