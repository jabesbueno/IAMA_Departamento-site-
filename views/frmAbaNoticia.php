<?php 
	include_once "../dao/daoNoticia.php";
	require_once "../helpers/checarLogin.php"; 
	if(basename($_SERVER['PHP_SELF']) != 'frmGerenciamento.php') header("Location: frmGerenciamento.php#noticias");
	
	$busca = new DaoNoticia();
	$select = $busca->buscaNoticia();
	
	if(!isset($_SESSION['sessionNoticia_Nm_Noticia'])) $_SESSION['sessionNoticia_Nm_Noticia'] = '';
	if(!isset($_SESSION['sessionNoticia_Dt_Noticia'])) $_SESSION['sessionNoticia_Dt_Noticia'] = '';
	if(!isset($_SESSION['sessionNoticia_Hr_Noticia'])) $_SESSION['sessionNoticia_Hr_Noticia'] = '';
	if(!isset($_SESSION['sessionNoticia_Ds_Noticia'])) $_SESSION['sessionNoticia_Ds_Noticia'] = '';
	
	if(!isset($_SESSION['session_pesquisaNoticia'])) $_SESSION['session_pesquisaNoticia'] = '';
    if(!isset($_SESSION['session_listarNoticias'])) $_SESSION['session_listarNoticias'] = 'normal';
    
    $select2 = $busca->buscaNoticiaESP($_SESSION['session_pesquisaNoticia']);
?>
<!DOCTYPE html>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Notícia</TITLE>
    </HEAD>
	<BODY>
		<br>
        <div class="row">
			<div class="col-md-2">
                    <button type="button" class="btn btn-primary btn_adicionar_noticia" href="#" data-toggle="modal" data-target="#modalNoticia">Adicionar Notícia</button>
             </div>
			 <form name="formPesquisaNoticia" id="formPesquisaNoticia"method="post" action="../controllers/controllerNoticia.php">
                <div class="col-sm-8">
                    <span class="pull-right">
                    <input type="text" class="form-control frm-pesquisa" id="Ds_PesquisaNoticia" name="Ds_PesquisaNoticia" style="text-transform:uppercase" maxlength="100" value="<?php echo $_SESSION['session_pesquisaNoticia'] ?>" placeholder="Notícia">
                    </span>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-pesquisar-noticia" name="botao" value="2">Pesquisar</button>
                </div>
            </form>
		</div>
		<!-- MODAL DE NOTICIA -->
        <div id="modalNoticia" class="modal fade" tabindex="-1" role="dialog" ref="formNoticia">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Notícia</h3>
                    </div>
					<form name="formNoticia" id="formNoticia" enctype="multipart/form-data" method="post" action="../controllers/controllerNoticia.php">
						<div class="modal-body">
							<input type="hidden" name="ID_Noticia" value="" />
							<input type="hidden" name="ID_Usuario" value="1" />
							<input type="hidden" name="acao" value="" />
							<div class="row">
								<div class="col-md-12">
									<label for="Nm_Noticia">Nome</label>
									<input type="text" class="form-control" id="Nm_Noticia" name="Nm_Noticia">
									<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionNoticia_Nm_Noticia']) . '</div>';?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label for="Dt_Noticia">Data</label>
									<input type="date" class="form-control" id="Dt_Noticia" name="Dt_Noticia">
									<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionNoticia_Dt_Noticia']) . '</div>';?>
								</div>
								<div class="col-md-6">
									<label for="Hr_Noticia">Hora</label>
									<input type="text" class="form-control hora" id="Hr_Noticia" name="Hr_Noticia">
									<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionNoticia_Hr_Noticia']) . '</div>';?>
								</div>
							</div>
							<div class="row">
                                <div class="col-md-12">
                                    <label for="Ds_Noticia">Descrição</label>
									<textarea style="resize: none" maxlength = "300" class="form-control" rows="4" id="Ds_Noticia" name="Ds_Noticia"></textarea>
									<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionNoticia_Ds_Noticia']) . '</div>';?>
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
		<!--FIM DO MODAL-->
		<!-- MODAL DE EXCLUIR DE NOTICIA -->
        <div id="modalExcluirNoticia" class="modal fade" tabindex="-1" role="dialog" ref="modalExcluirNoticia">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Tem certeza que deseja excluir esta notícia?</h3>
                    </div>
					<form name="formExcluirNoticia" id="formExcluirNoticia" method="post" action="../controllers/controllerNoticia.php">
						<div class="modal-body">
							<input type="hidden" name="ID_Noticia" value="" />
							<input type="hidden" name="ID_Usuario" value="" />
							<input type="hidden" name="acao" value="" />
							<div class="row">
								<div class="col-md-12">
									<label for="Nm_Noticia">Nome</label>
									<input type="text" class="form-control" id="Nm_Noticia" name="Nm_Noticia" disabled>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label for="Dt_Noticia">Data</label>
									<input type="date" class="form-control" id="Dt_Noticia" name="Dt_Noticia" disabled>
								</div>
								<div class="col-md-6">
									<label for="Hr_Noticia">Hora</label>
									<input type="text" class="form-control hora" id="Hr_Noticia" name="Hr_Noticia" disabled>
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
        <table class="table table-hover">
            <thead thead-default>
                <tr>
                    <th>#</th>
					<th>Notícia</th>
                    <th>Data</th>
                    <th>Hora</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
				if($_SESSION['session_listarNoticias'] == 'pesquisa') 
                {
					while($noticia = $select2->fetch()) 
                       {?>
							<tr>
								<td><?php echo $noticia["ID_Noticia"] ?></td>
								<td><?php echo utf8_encode($noticia["Nm_Noticia"]) ?></td>
								<td><?php echo date("d/m/Y", strtotime($noticia["Dt_Noticia"])) ?></td>
								<td><?php echo $noticia["Hr_Noticia"] ?></td>
								<td><a href="#noticias" data='<?php echo json_encode(array_map("utf8_encode",$noticia)) ?>' id="editar_noticia_<?php echo $evento["ID_Noticia"]?>" class="btn btn-primary btn_editar_noticia">Editar</a></td>
								<td><a href="#noticias" data='<?php echo json_encode(array_map("utf8_encode",$noticia)) ?>' id="excluir_noticia_<?php echo $evento["ID_Noticia"]?>" class="btn btn-danger btn_excluir_noticia">Excluir</a></td>
							</tr>
						<?php
						}
				$_SESSION['session_listarNoticias'] = 'normal';
                $_SESSION['session_pesquisaNoticia'] = '';
                }
                else
                { 
                    while($noticia= $select->fetch())
                    {?>
							<tr>
								<td><?php echo $noticia["ID_Noticia"] ?></td>
								<td><?php echo utf8_encode($noticia["Nm_Noticia"]) ?></td>
								<td><?php echo date("d/m/Y", strtotime($noticia["Dt_Noticia"])) ?></td>
								<td><?php echo $noticia["Hr_Noticia"] ?></td>
								<td><a href="#noticias" data='<?php echo json_encode(array_map("utf8_encode",$noticia)) ?>' id="editar_noticia_<?php echo $evento["ID_Noticia"]?>" class="btn btn-primary btn_editar_noticia">Editar</a></td>
								<td><a href="#noticias" data='<?php echo json_encode(array_map("utf8_encode",$noticia)) ?>' id="excluir_noticia_<?php echo $evento["ID_Noticia"]?>" class="btn btn-danger btn_excluir_noticia">Excluir</a></td>
							</tr>
						<?php 
                    }
                } ?>
            </tbody>
        </table>
		<!-- SCRIPT PARA EXIBIÇÃO DE ERROS DE VALIDAÇÃO/FORMATAÇÃO DE CAMPOS NO MODAL -->
        <?php 
            if(isset($_SESSION['session_modalNoticia']) ? $_SESSION['session_modalNoticia'] : null) { 
            ?>
        <script type="text/javascript">
            $(document).ready(function(){               
                if (performance.navigation.type != 1) {
                <?php if($_SESSION['session_acaoNoticia'] == 'editar') { ?> 
                    document.getElementById('editar_noticia_<?php echo $_SESSION['session_ID_Noticia']?>').click();         
                <?php } else if($_SESSION['session_acaoNoticia'] == 'adicionar') { ?>
                    $(".btn_adicionar_noticia").click();
                <?php } ?>
                }
                else
                {
                <?php
					$_SESSION['sessionNoticia_ID_Noticia'] = null;
					$_SESSION['sessionNoticia_Nm_Noticia'] = null;
					$_SESSION['sessionNoticia_Dt_Noticia'] = null;
					$_SESSION['sessionNoticia_Hr_Noticia'] = null;
					$_SESSION['sessionNoticia_Ds_Noticia'] = null;
					$_SESSION['session_modalNoticia'] = null;
					$_SESSION['session_acaoNoticia'] = null;
                ?>
                }
            });
        </script>
        <?php } ?>
        <!-- FIM DO SCRIPT -->
	</BODY>
</HTML>