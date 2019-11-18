<?php
ini_set('default_charset','UTF-8'); 
include_once "../dao/daoHistoricoNotificacao.php";
	//require_once "../helpers/checarLogin.php"; 
if(basename($_SERVER['PHP_SELF']) != 'frmGerenciamento.php') header("Location: frmGerenciamento.php#historico");

$busca = new DaoHistoricoNotificacao();
$select = $busca->buscaGeralHistorico();

if(!isset($_SESSION['session_pesquisaNotificacao'])) $_SESSION['session_pesquisaNotificacao'] = '';
if(!isset($_SESSION['session_listarNotificacao'])) $_SESSION['session_listarNotificacao'] = 'normal';
?>
<HTML>
<HEAD>
	<meta charset="utf-8">
	<TITLE>Histórico</TITLE>
</HEAD>
<BODY>
	<br>
	<div class="row">
		<div class="col-xs-8">
		</div>
		<div class="col-xs-4">
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search" id="icone_busca" aria-hidden="true"></span></span>
				<input type="text" class="form-control frm-pesquisa " id="Bs_Historico" name="Bs_Historico" style="text-transform:uppercase" maxlength="100" placeholder="PESQUISAR" aria-describedby="basic-addon1">
			</div>
		</div>
	</div>
	<br>
	<br>
	<!-- MODAL DE VISUALIZAÇÃO DE HISTÓRICO -->
	<div id="modalHistoricoVisaulizacao" class="modal fade"  tabindex="-1" role="dialog" ref="formVisualizaHistorico">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Visualizando histórico das notificações</h3>
				</div>
				<form name="formVisualizaHistorico" id="formVisualizaHistorico" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<input type="hidden" name="ID_Notificacao" />
						<input type="hidden" name="ID_Usuario"/>
						<input type="hidden" name="ID_Historico"/>
						<p align="justify" name="txtNotifica" id="txtNotifica"><p/>							
						<div class="row">
							<div class="col-md-12">
								<img src="" alt="#" class="img-responsive" id="Fot_Notifica" name="Fot_Notifica">
							</div>
						</div>
						<p align="justify" name="txtHistorico" id="txtHistorico"><p/>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary btn-fechar-notificacao" name="botao" value="0" data-dismiss="modal">Fechar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- FIM DO MODAL DE VISUALIZAÇÃO -->
		<table id="table_historico" class="table table-striped table-inverse table-bordered">
			<colgroup>
				<col style="width:20%">
				<col style="width:25%">
				<col style="width:15%">
				<col style="width:15%">
				<col style="width:15%">
				<col style="width:10%">
			</colgroup>
			<thead thead-default>
				<tr>
					<th>Bairro</th>
					<th>Rua</th>
					<th>Entrada em</th>
					<th>Ponto Próximo</th>
					<th>Resposta em</th>
					<th class="noborder">Opções</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				if($_SESSION['session_listarNotificacao'] == 'pesquisa') 
				{
					while($historico = $select2->fetch())
					{  
						?>
						<tr>
							<td><?php echo utf8_encode($historico["Nm_Bairro"]) ?></td>
							<td><?php echo $historico["Nm_Rua"] ?></td>
							<td><?php echo date("d/m/Y ", strtotime($historico["Dt_Notificacao"])) ?></td>
							<td><?php echo utf8_decode($historico["Ds_PontoProximo"]) ?></td>
							<td><?php echo date("d/m/Y H:i:s", strtotime($historico["Dt_Historico"])) ?></td>
							<td><a href="#historico" data='<?php echo json_encode(array_map("utf8_encode", $hitorico)) ?>' id="historico_notificacao_<?php echo $historico["ID_Notificacao"]?>" class="btn btn-primary btn_visualizar_historico">Visualizar</a></td>
						</tr>
						<?php 
					}

					$_SESSION['session_listarNotificacao'] = 'normal';
					$_SESSION['session_pesquisaNotificacao'] = '';
				}
				else
				{ 
					while($historico = $select->fetch())
						{ ?>
							<tr>
								<td><?php echo utf8_encode($historico["Nm_Bairro"]) ?></td>
								<td><?php echo $historico["Nm_Rua"] ?></td>
								<td><?php echo date("d/m/Y", strtotime($historico["Dt_Notificacao"])) ?></td>
								<td><?php echo utf8_decode($historico["Ds_PontoProximo"]) ?></td>
								<td><?php echo date("d/m/Y H:i:s", strtotime($historico["Dt_Historico"])) ?></td>
								<td><a href="#historico" data='<?php echo json_encode(array_map("utf8_encode", $historico)) ?>' id="historico_notificacao_<?php echo $historico["ID_Notificacao"]?>" class="btn btn-primary btn_visualizar_historico">Visualizar</a></td>
							</tr>
							<?php 
						}
					} ?>
				</tbody>
			</table>
	</BODY>
</HTML>