<?php
	ini_set('default_charset','UTF-8'); 
	include_once "../dao/daoNotificacao.php";
	//require_once "../helpers/checarLogin.php"; 
	if(basename($_SERVER['PHP_SELF']) != 'frmGerenciamento.php') header("Location: frmGerenciamento.php#notificacao");
	
	$busca = new DaoNotificacao();
	$select = $busca->buscaNotificacao();
	
	if(!isset($_SESSION['session_pesquisaNotificacao'])) $_SESSION['session_pesquisaNotificacao'] = '';
    if(!isset($_SESSION['session_listarNotificacao'])) $_SESSION['session_listarNotificacao'] = 'normal';

	if(!isset($_SESSION['sessionNotificacao_Nm_Bairro'])) $_SESSION['sessionNotificacao_Nm_Bairro'] = '';
	if(!isset($_SESSION['sessionNotificacao_Nm_Rua'])) $_SESSION['sessionNotificacao_Nm_Rua'] = '';
	if(!isset($_SESSION['sessionNotificacao_Ds_PontoProximo'])) $_SESSION['sessionNotificacao_Ds_PontoProximo'] = '';
	if(!isset($_SESSION['sessionNotificacao_Ft_Notificacao'])) $_SESSION['sessionNotificacao_Ft_Notificacao'] = '';
	if(!isset($_SESSION['sessionNotificacao_Ds_Notificacao'])) $_SESSION['sessionNotificacao_Ds_Notificacao'] = '';
?>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Notificação</TITLE>
    </HEAD>
    <BODY>
        <br>
        <div class="row">
            <div class="col-md-2">
                <button type="button" class="btn btn-primary btn_adicionar_notificacao" href="#" data-toggle="modal" data-target="#modalNotificacao">Adicionar Notificação</button>
            </div>
            <!--<form name="formNotificacao" id="formNotificacao" method="post" action="../../controllers/controllerNotificacao.php">
                <div class="col-sm-8">
                    <span class="pull-right">
                    <input type="text" class="form-control frm-pesquisa" id="Ds_Pesquisa" name="Ds_Pesquisa" style="text-transform:uppercase" maxlength="100" value="<?php echo $_SESSION['session_pesquisaNotificacao'] ?>" placeholder="PRODUTO">
                    </span>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-pesquisar-produto" name="botao" value="2">Pesquisar</button>
                </div>
            </form>-->
        </div>
        <br>
        <br>
        <!-- MODAL DE NOTIFICAÇÃO -->
        <div id="modalNotificacao" class="modal fade"  tabindex="-1" role="dialog" ref="formNotificacao">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Notificação</h3>
                    </div>
                    <form name="formNotificacao" id="formNotificacao" method="post" enctype="multipart/form-data" action="../controllers/controllerNotificacao.php">
                        <div class="modal-body">
                            <input type="hidden" name="ID_Notificacao" />
							<input type="hidden" name="ID_Usuario" value="<?PHP $_SESSION['session_ID_Logado'] ?>" />
                            <input type="hidden" name="acao" value="" />
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Nm_Bairro">Bairro</label>
                                    <input type="text" class="form-control" id="Nm_Bairro" name="Nm_Bairro" maxlength="100">
									<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionNotificacao_Nm_Bairro']) . '</div>';?>
                                </div>
                            </div>
							<div class="row">
								<div class="col-md-12">
                                    <label for="Nm_Rua">Rua</label>
                                    <input type="text" class="form-control" id="Nm_Rua" name="Nm_Rua" maxlength="100">
									<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionNotificacao_Nm_Rua']) . '</div>';?>
                                </div>
                            </div>
                            <div class="row">
								<div class="col-md-12">
                                    <label for="Ds_PontoProximo">Ponto próximo</label>
                                    <input type="text" class="form-control" id="Ds_PontoProximo" name="Ds_PontoProximo">
									<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionNotificacao_Ds_PontoProximo']) . '</div>';?>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <label for="Ft_Notificacao">Imagem</label><br>
									<img src="" alt="#" class="img-rounded" id="Foto_Notificacao" name="Foto_Notificacao">
									<input type="file" id="Ft_Notificacao" class="form-control" name="Ft_Notificacao"/>
									<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionNotificacao_Ft_Notificacao']) . '</div>';?>
                                </div>
                            </div>
							<div class="row">
								<div class="col-md-12">
                                    <label for="Ds_Notificacao">Descrição</label>
                                     <textarea style="resize: none" maxlength = "500" class="form-control" rows="3" id="Ds_Notificacao" name="Ds_Notificacao"></textarea>
									 <?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionNotificacao_Ds_Notificacao']) . '</div>';?>
                                </div>
							</div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-inserir-notificacao" name="botao" value="1">Inserir</button>
                            <button type="reset" class="btn btn-secondary btn-limpar-notificacao">Limpar Campos</button>
                            <button type="button" class="btn btn-primary btn-fechar-notificacao" name="botao" value="0" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- FIM DO MODAL -->
		
		 <!-- MODAL DE NOTIFICAÇÃO DE VISUALIZAÇÃO -->
        <div id="modalNotificacaoVisaulizacao" class="modal fade"  tabindex="-1" role="dialog" ref="formVisualizaNotificacao">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Visualizando notificação</h3>
                    </div>
                    <form name="formVisualizaNotificacao" id="formVisualizaNotificacao" method="post" enctype="multipart/form-data" action="../controllers/controllerNotificacao.php">
                        <div class="modal-body">
                            <input type="hidden" name="ID_Notificacao" />
							<input type="hidden" name="ID_Usuario"/>
							<input type="hidden" name="ID_Historico"/>
							<p align="justify" name="txtNotificacao" id="txtNotificacao"><p/>							
							<div class="row">
                                <div class="col-md-12">
									<img src="" alt="#" class="rounded mx-auto d-block" id="Fot_Notificacao" name="Fot_Notificacao">
                                </div>
                            </div>
							<div class="row">
								<div class="col-md-12">
                                    <label for="Ds_Observacao">Observação</label>
                                     <textarea style="resize: none" maxlength = "500" class="form-control" rows="3" id="Ds_Observacao" name="Ds_Observacao" required></textarea>
                                </div>
							</div>
							
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-responder-notificacao" name="botao" value="4">Responder</button>
                            <button type="button" class="btn btn-primary btn-fechar-notificacao" name="botao" value="0" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- FIM DO MODAL DE VISUALIZAÇÃO -->
        <table class="table table-hover">
            <thead thead-default>
                <tr>
                    <th>Bairro</th>
                    <th>Rua</th>
                    <th>Entrada em</th>
                    <th>Ponto Próximo</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
				<?php 
                    if($_SESSION['session_listarNotificacao'] == 'pesquisa') 
                    {
                        while($notificacao = $select2->fetch())
                        {  
                    ?>
                            <tr>
                                <td><?php echo utf8_encode($notificacao["Nm_Bairro"]) ?></td>
                                <td><?php echo $notificacao["Nm_Rua"] ?></td>
                                <td><?php echo date("d/m/Y", strtotime($notificacao["Dt_Notificacao"])) ?></td>
                                <td><?php echo utf8_encode($notificacao["Ds_PontoProximo"]) ?></td>
                                <td><a href="#notificacao" data='<?php echo json_encode(array_map("utf8_encode", $notificacao)) ?>' id="visualizar_notificacao_<?php echo $notificacao["ID_Notificacao"]?>" class="btn btn-primary btn_visualizar_notificacao">Visualizar</a></td>
                            </tr>
                    <?php 
                        }
                    
                        $_SESSION['session_listarNotificacao'] = 'normal';
                        $_SESSION['session_pesquisaNotificacao'] = '';
                    }
                    else
                    { 
                        while($notificacao = $select->fetch())
                        { ?>
                            <tr>
                                <td><?php echo utf8_encode($notificacao["Nm_Bairro"]) ?></td>
                                <td><?php echo utf8_encode($notificacao["Nm_Rua"]) ?></td>
                                <td><?php echo date("d/m/Y", strtotime($notificacao["Dt_Notificacao"])) ?></td>
                                <td><?php echo $notificacao["Ds_PontoProximo"] ?></td>
                                <td><a href="#notificacao" data='<?php echo json_encode(array_map("utf8_encode", $notificacao)) ?>' id="visualizar_notificacao_<?php echo $notificacao["ID_Notificacao"]?>" class="btn btn-primary btn_visualizar_notificacao">Visualizar</a></td>
                                <!--<td><a href="#notificacao" data='<?php echo json_encode(array_map("utf8_encode", $notificacao)) ?>' id="excluir_notificacao_<?php echo $notificacao["ID_Notificacao"]?>" class="btn btn-danger btn_excluir_notificacao">Excluir</a></td>-->
                            </tr>
                    <?php 
                        }
                    } ?>
            </tbody>
        </table>