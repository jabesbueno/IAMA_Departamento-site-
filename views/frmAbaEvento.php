<?php 
	include_once "../dao/daoEvento.php";
	if(basename($_SERVER['PHP_SELF']) != 'frmGerenciamento.php') header("Location: frmGerenciamento.php#eventos");
	require_once "../helpers/checarLogin.php"; 
	
	$busca = new DaoEvento();
	$select = $busca->buscaEvento();
	
	if(!isset($_SESSION['sessionEvento_Nm_Evento'])) $_SESSION['sessionEvento_Nm_Evento'] = '';
	if(!isset($_SESSION['sessionEvento_Dt_Evento'])) $_SESSION['sessionEvento_Dt_Evento'] = '';
	if(!isset($_SESSION['sessionEvento_Hr_Evento'])) $_SESSION['sessionEvento_Hr_Evento'] = '';
	if(!isset($_SESSION['sessionEvento_Nm_Local'])) $_SESSION['sessionEvento_Nm_Local'] = '';
	if(!isset($_SESSION['sessionEvento_Ds_Evento'])) $_SESSION['sessionEvento_Ds_Evento'] = '';
	
	if(!isset($_SESSION['session_pesquisaEvento'])) $_SESSION['session_pesquisaEvento'] = '';
    if(!isset($_SESSION['session_listarEventos'])) $_SESSION['session_listarEventos'] = 'normal';
    
    $select2 = $busca->buscaEventoESP($_SESSION['session_pesquisaEvento']);
?>
<!DOCTYPE html>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Evento</TITLE>
    </HEAD>
	<BODY>
		<br>
        <div class="row">
			<div class="col-md-2">
                    <button type="button" class="btn btn-primary btn_adicionar_evento" href="#" data-toggle="modal" data-target="#modalEvento">Adicionar Evento</button>
             </div>
			 <div class="col-xs-6">
			</div>
			<div class="col-xs-4">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search" id="icone_busca" aria-hidden="true"></span></span>
					<input type="text" class="form-control frm-pesquisa " id="Bs_Evento" name="Bs_Evento" style="text-transform:uppercase" maxlength="100" placeholder="PESQUISAR" aria-describedby="basic-addon1">
				</div>
			</div>
		</div>
		<!-- MODAL DE USUARIO -->
        <div id="modalEvento" class="modal fade" tabindex="-1" role="dialog" ref="formEvento">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Evento</h3>
                    </div>
					<form name="formEvento" id="formEvento" enctype="multipart/form-data" method="post" action="../controllers/controllerEvento.php">
						<div class="modal-body">
							<input type="hidden" name="ID_Evento" value="" />
							<input type="hidden" name="ID_Usuario" value="<?PHP $_SESSION['session_ID_Logado'] ?>" />
							<input type="hidden" name="acao" value="" />
							<div class="row">
								<div class="col-md-8">
									<label for="Nm_Evento">Nome</label>
									<input type="text" class="form-control" id="Nm_Evento" name="Nm_Evento">
									<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionEvento_Nm_Evento']) . '</div>';?>
								</div>
								<div class="col-md-4">
									<label for="Dt_Evento">Data</label>
									<input type="date" class="form-control" id="Dt_Evento" name="Dt_Evento">
									<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionEvento_Dt_Evento']) . '</div>';?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<label for="Hr_Evento">Hora</label>
									<input type="text" class="form-control hora" id="Hr_Evento" name="Hr_Evento">
									<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionEvento_Hr_Evento']) . '</div>';?>
								</div>
								<div class="col-md-9">
									<label for="Nm_Local">Local</label>
									<input type="text" class="form-control" id="Nm_Local" name="Nm_Local">
									<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionEvento_Nm_Local']) . '</div>';?>
								</div>
							</div>
							<div class="row">
                                <div class="col-md-12">
                                    <label for="Ds_Evento">Descrição</label>
									<textarea style="resize: none" maxlength = "200" class="form-control" rows="4" id="Ds_Evento" name="Ds_Evento"></textarea>
									<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionEvento_Ds_Evento']) . '</div>';?>
                                </div>
                            </div>
						</div>
						<div class="modal-footer">
							<button type="submit" name="botao" class="btn btn-primary" value="1">Inserir</button>
							<button type="reset" class="btn btn-secondary ">Limpar Campos</button>
							<button type="button" class="btn btn-primary" name="botao" data-dismiss="modal" value="0" >Fechar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Fim do Modal-->
		<!-- MODAL DE EXCLUIR DE EVENTO -->
        <div id="modalExcluirEvento" class="modal fade" tabindex="-1" role="dialog" ref="modalExcluirEvento">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Tem certeza que deseja excluir este evento?</h3>
                    </div>
					<form name="formExcluirEvento" id="formExcluirEvento" method="post" action="../controllers/controllerEvento.php">
						<div class="modal-body">
							<input type="hidden" name="ID_Evento" value="" />
							<input type="hidden" name="ID_Usuario" value="" />
							<input type="hidden" name="acao" value="" />
							<div class="row">
								<div class="col-md-12">
									<label for="Nm_Evento">Nome</label>
									<input type="text" class="form-control" id="Nm_Evento" name="Nm_Evento" disabled>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label for="Dt_Evento">Data</label>
									<input type="date" class="form-control" id="Dt_Evento" name="Dt_Evento" disabled>
								</div>
								<div class="col-md-6">
									<label for="Hr_Evento">Hora</label>
									<input type="text" class="form-control hora" id="Hr_Evento" name="Hr_Evento" disabled>
								</div>
							</div>
							<br>
						</div>
						<div class="modal-footer">
							<button type="submit" name="botao" class="btn btn-danger" value="3">Excluir</button>
							<button type="button" class="btn btn-primary" name="botao" data-dismiss="modal">Fechar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Fim do Modal-->
		<br>
        <table id="table_evento" class="table table-striped table-inverse table-bordered">
            <colgroup>
				<col style="width:5%">
				<col style="width:40%">
				<col style="width:15%">
				<col style="width:10%">
				<col style="width:10%">
				<col style="width:10%">
				<col style="width:10%">
			</colgroup>
			<thead thead-default>
                <tr>
                    <th>#</th>
					<th>Evento</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th>Status</th>
                    <th></th>
					<th></th>
                </tr>
            </thead>
            <tbody>
                <?php
				if($_SESSION['session_listarEventos'] == 'pesquisa') 
                {
					while($evento = $select2->fetch()) 
                       {?>
							<tr>
								<td><?php echo $evento["ID_Evento"] ?></td>
								<td><?php echo utf8_encode($evento["Nm_Evento"]) ?></td>
								<td><?php echo date("d/m/Y", strtotime($evento["Dt_Evento"])) ?></td>
								<td><?php echo $evento["Hr_Evento"] ?></td>
								<td><?php echo utf8_encode($evento["St_Evento"]) ?></td>
								<td><a href="#eventos" data='<?php echo json_encode(array_map("utf8_encode",$evento)) ?>' id="editar_evento_<?php echo $evento["ID_Evento"]?>" class="btn btn-primary btn_editar_evento">Editar</a></td>
								<td><a href="#eventos" data='<?php echo json_encode(array_map("utf8_encode",$evento)) ?>' id="excluir_evento_<?php echo $evento["ID_Evento"]?>" class="btn btn-danger btn_excluir_evento">Excluir</a></td>
							</tr>
						<?php
						}
				$_SESSION['session_listarEventos'] = 'normal';
                $_SESSION['session_pesquisaEvento'] = '';
                }
                else
                { 
                    while($evento= $select->fetch())
                    {?>
							<tr>
								<td><?php echo $evento["ID_Evento"] ?></td>
								<td><?php echo utf8_encode($evento["Nm_Evento"]) ?></td>
								<td><?php echo date("d/m/Y", strtotime($evento["Dt_Evento"])) ?></td>
								<td><?php echo $evento["Hr_Evento"] ?></td>
								<td><?php echo utf8_encode($evento["St_Evento"]) ?></td>
								<td><a href="#eventos" data='<?php echo json_encode(array_map("utf8_encode",$evento)) ?>' id="editar_evento_<?php echo $evento["ID_Evento"]?>" class="btn btn-primary btn_editar_evento">Editar</a></td>
								<td><a href="#eventos" data='<?php echo json_encode(array_map("utf8_encode",$evento)) ?>' id="excluir_evento_<?php echo $evento["ID_Evento"]?>" class="btn btn-danger btn_excluir_evento">Excluir</a></td>
							</tr>
						<?php 
                    }
                } ?>
            </tbody>
        </table>
		<!-- SCRIPT PARA EXIBIÇÃO DE ERROS DE VALIDAÇÃO/FORMATAÇÃO DE CAMPOS NO MODAL -->
        <?php 
            if(isset($_SESSION['session_modalEvento']) ? $_SESSION['session_modalEvento'] : null) { 
            ?>
        <script type="text/javascript">
            $(document).ready(function(){               
                if (performance.navigation.type != 1) {
                <?php if($_SESSION['session_acaoEvento'] == 'editar') { ?> 
                    document.getElementById('editar_produto_<?php echo $_SESSION['session_ID_Evento']?>').click();         
                <?php } else if($_SESSION['session_acaoEvento'] == 'adicionar') { ?>
                    $(".btn_adicionar_evento").click();
                <?php } ?>
                }
                else
                {
                <?php
					$_SESSION['sessionEvento_ID_Evento'] =	null;
					$_SESSION['sessionEvento_Nm_Evento'] =	null;
					$_SESSION['sessionEvento_Dt_Evento'] =	null;
					$_SESSION['sessionEvento_Hr_Evento'] = null;
					$_SESSION['sessionEvento_Nm_Local'] = null;
					$_SESSION['sessionEvento_Ds_Evento'] = null;
					$_SESSION['session_modalEvento'] = null;
					$_SESSION['session_acaoEvento'] = null;
                ?>
                }
            });
        </script>
        <?php } ?>
        <!-- FIM DO SCRIPT -->
	</BODY>
</HTML>