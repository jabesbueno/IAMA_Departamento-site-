<?php
	ini_set('default_charset','UTF-8'); 
    session_start();
?>
<HTML>
    <HEAD>
        <meta charset="UTF-8">
        <TITLE>Gerenciamento</TITLE>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script> 
        <script type="text/javascript" src="../js/javascripts-mascaras.php"></script>
		<script type="text/javascript" src="../js/javascripts-abas.php"></script>
    </HEAD>
    <BODY>
        <div id="headerwrap" style="background-color: #FEFEFE;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class=""></span>
                            <span class=""></span>
                            <span class=""></span>
                            </button>
                            <a class="navbar-brand" href="frmTelaPrincipal.php">Departamento Meio Ambiente</a>
                        </div>
                        <div class="navbar-collapse collapse navbar-right">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Usuário</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="frmTelaPrincipal.php">TELA PRINCIPAL</a></li>
                                        <li><a href="">SAIR</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Nav tabs -->
                    <div class="col-md-12">  
                        <ul class="nav nav-tabs" role="tablist" id="tabs_navegacao_gerenciamento">
                            <li role="presentation"><a href="#inicio" aria-controls="home" class="btn btn-light" role="tab" data-toggle="tab">Início</a></li>
                            <li role="presentation"><a href="#usuario" class="btn btn-light" role="tab" data-toggle="tab">Usuário</a></li>
                            <li role="presentation"><a href="#notificacao" class="btn btn-light" role="tab" data-toggle="tab">Notificação</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="inicio" class="tab-pane fade">
                                <h3>Inicio</h3>
                                <p>O processo é lento mas vai valer a pena!</p>
                            </div>
                            <div class="tab-pane" id="usuario" class="tab-pane fade">
                                <?php include_once 'frmAbaUsuario.php'?>
                            </div>
                            <div class="tab-pane" id="notificacao" class="tab-pane fade">
                                <?php include_once 'frmAbaNotificacao.php'?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /headerwrap -->
    </BODY>
</HTML>