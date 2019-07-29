<?php
	include_once "../dao/daoUsuario.php";
	
	$busca = new DaoUsuario();
	$select = $busca->buscaUsuario();
	
	if(!isset($_SESSION['sessionUsuario_Nome'])) $_SESSION['sessionUsuario_Nome'] = '';
	if(!isset($_SESSION['sessionUsuario_Tipo'])) $_SESSION['sessionUsuario_Tipo'] = '';
	if(!isset($_SESSION['sessionUsuario_Senha'])) $_SESSION['sessionUsuario_Senha'] = '';
	if(!isset($_SESSION['sessionUsuario_Confirmar'])) $_SESSION['sessionUsuario_Confirmar'] = '';
	if(!isset($_SESSION['sessionUsuario_Cpf'])) $_SESSION['sessionUsuario_Cpf'] = '';
	if(!isset($_SESSION['sessionUsuario_Nascimento'])) $_SESSION['sessionUsuario_Nascimento'] = '';
	if(!isset($_SESSION['sessionUsuario_Validacao'])) $_SESSION['sessionUsuario_Validacao'] = '';

	if(!isset($_SESSION['session_pesquisaUsuario'])) $_SESSION['session_pesquisaUsuario'] = '';
    if(!isset($_SESSION['session_listarUsuarios'])) $_SESSION['session_listaUsuarios'] = 'normal';
    
    $select2 = $busca->buscaUsuarioESP($_SESSION['session_pesquisaUsuario']);
	header('Content-type: text/html; charset=UTF-8');
?>
<HTML>
    <HEAD>
        <meta charset="utf-8">
        <TITLE>Usuário</TITLE>
    </HEAD>
    <BODY>
        <br>
        <div class="row">
			<div class="col-md-2">
                    <button type="button" class="btn btn-primary btn_adicionar_usuario" href="#" data-toggle="modal" data-target="#modalUsuario">Adicionar Usuário</button>
             </div>
            <form name="formPesquisaUsuario" id="formPesquisaUsuario"method="post" action="../controllers/controllerUsuario.php">
                <div class="col-sm-8">
                    <span class="pull-right">
                    <input type="text" class="form-control frm-pesquisa" id="Ds_Pesquisa" name="Ds_Pesquisa" style="text-transform:uppercase" maxlength="100" value="<?php echo $_SESSION['session_pesquisaUsuario'] ?>" placeholder="USUARIO">
                    </span>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-pesquisar-usuario" name="botao" value="2">Pesquisar</button>
                </div>
            </form>
        </div>
		<!-- MODAL DE USUARIO -->
        <div id="modalUsuario" class="modal fade" tabindex="-1" role="dialog" ref="formUsuario">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Usuário</h3>
                    </div>
					<form name="formUsuario" id="formUsuario" enctype="multipart/form-data" method="post" action="../controllers/controllerUsuario.php">
						<div class="modal-body">
							<input type="hidden" name="acao" value="" />
							<div class="row">
								<div class="col-md-6">
										<label for="Nm_Usuario">Nome</label>
										<input type="text" class="form-control" id="Nm_Usuario" name="Nm_Usuario">
										<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionUsuario_Nome']) . '</div>';?>
								</div>
								<div class="col-md-6">
									<label for="Tp_Usuario">Tipo</label>
									<select id="Tp_Usuario" name="Tp_Usuario" class="form-control">
										<option selected value="">SELECIONE</option>
										<option value="ADMINISTRADOR">ADMINISTRADOR</option>
										<option value="USUARIO">USUARIO</option>
									</select>
									<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionUsuario_Tipo']) . '</div>';?>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
										<label for="Ds_Senha">Senha</label>
										<input type="password" class="form-control" id="Ds_Senha" name="Ds_Senha">
										<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionUsuario_Senha']) . '</div>';?>
										<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionUsuario_Validacao']) . '</div>';?>
								</div>
								<div class="col-md-6">
										<label for="Ds_Confirmar">Confirmar Senha</label>
										<input type="password" class="form-control" id="Ds_Confirmar" name="Ds_Confirmar">
										<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionUsuario_Confirmar']) . '</div>';?>
										<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionUsuario_Validacao']) . '</div>';?>
								</div>
							</div>
							<div class="row">
                                <div class="col-md-12">
                                    <label for="Ft_Usuario">Foto</label>
									<img src="" alt="#" class="img-rounded" id="Ft_Usuario" name="Ft_Usuario">
									<input type="file" id="Ft_Usuario" class="form-control" name="Ft_Usuario"/>
                                </div>
                            </div>
							<div class="row">
								<div class="col-md-6">
										<label for="Nr_Cpf">CPF</label>
										<input type="text" class="form-control cpf" id="Nr_Cpf" name="Nr_Cpf">
										<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionUsuario_Cpf']) . '</div>';?>
								</div>
								<div class="col-md-6">
										<label for="Dt_Nascimento">Nascimento</label>
										<input type="date" class="form-control" id="Dt_Nascimento" name="Dt_Nascimento">
										<?php echo '<div style="Color:red">' . nl2br($_SESSION['sessionUsuario_Nascimento']) . '</div>';?>
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
		<!-- MODAL DE INATIVAÇÃO DE USUARIO -->
        <div id="modalInativarUsuario" class="modal fade" tabindex="-1" role="dialog" ref="inativarUsuario">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Tem certeza que deseja inativar este usuário?</h3>
                    </div>
					<form name="inativarUsuario" id="inativarUsuario" method="post" action="../controllers/controllerUsuario.php">
						<div class="modal-body">
							<input type="hidden" class="form-control" id="ID_Usuario" name="ID_Usuario">
							<div class="row">
									<div class="col-md-4">
										<label>Nome</label>
										<input type="text" class="form-control" id="Nm_Usuario" name="Nm_Usuario" disabled>
									</div>
									<div class="col-md-4">
										<label>CPF</label>
										<input type="text" class="form-control" id="Nr_Cpf" name="Nr_Cpf" disabled>
									</div>
									<div class="col-md-4">
										<label>Nascimento</label>
										<input type="date" class="form-control" id="Dt_Nascimento" name="Dt_Nascimento" disabled>
									</div>
							</div>
							<br>
						</div>
						<div class="modal-footer">
							<button type="submit" name="botao" class="btn btn-danger" value="3">Inativar</button>
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
					<th>Usuário</th>
                    <th>Tipo</th>
                    <th>CPF</th>
					<th>Nascimento</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
				if($_SESSION['session_listarUsuarios'] == 'pesquisa') 
                {
					while($usuario = $select2->fetch()) 
                       {?>
							<tr>
								<td><?php echo $usuario["ID_Usuario"] ?></td>
								<td><?php echo $usuario["Nm_Usuario"] ?></td>
								<td><?php echo utf8_encode($usuario["Tp_Usuario"]) ?></td>
								<td><?php echo $usuario["Nr_Cpf"] ?></td>
								<td><?php echo date("d/m/Y", strtotime($usuario["Dt_Nascimento"])) ?></td>
								<td><?php echo $usuario["St_Usuario"] ?></td>
								<td><a href="#usuario" data='<?php echo json_encode(array_map("utf8_encode",$usuario)) ?>' id="excluir_usuario_<?php echo $usuario["ID_Usuario"]?>" class="btn btn-danger btn_excluir_usuario">Inativar</a></td>
							</tr>
						<?php
						}
				$_SESSION['session_listarUsuarios'] = 'normal';
                $_SESSION['session_pesquisaUsuario'] = '';
                }
                else
                { 
                    while($usuario= $select->fetch())
                    {?>
							<tr>
								<td><?php echo $usuario["ID_Usuario"] ?></td>
								<td><?php echo $usuario["Nm_Usuario"] ?></td>
								<td><?php echo utf8_encode($usuario["Tp_Usuario"]) ?></td>
								<td><?php echo $usuario["Nr_Cpf"] ?></td>
								<td><?php echo date("d/m/Y", strtotime($usuario["Dt_Nascimento"])) ?></td>
								<td><?php echo $usuario["St_Usuario"] ?></td>
								<td><a href="#usuario" data='<?php echo json_encode(array_map("utf8_encode",$usuario)) ?>' id="inativar_usuario_<?php echo $usuario["ID_Usuario"]?>" class="btn btn-danger btn_inativar_usuario">Inativar</a></td>
							</tr>
						<?php 
                    }
                } ?>
            </tbody>
        </table>
		<!-- SCRIPT PARA EXIBIÇÃO DE ERROS DE VALIDAÇÃO/FORMATAÇÃO DE CAMPOS NO MODAL -->
        <?php 
            if(isset($_SESSION['session_modalUsuario']) ? $_SESSION['session_modalUsuario'] : null) { 
            ?>
				<script type="text/javascript">
						if (performance.navigation.type != 1) {
							
						<?php  if($_SESSION['session_acaoUsuario'] == 'adicionar') { ?>
							$(".btn_adicionar_usuario").click();
						<?php } ?>
						}
						else
						{
							<?php
								$_SESSION['sessionUsuario_Nome'] =	null;
								$_SESSION['sessionUsuario_Tipo'] =	null;
								$_SESSION['sessionUsuario_Senha'] = null;
								$_SESSION['sessionUsuario_Confirmar'] = null;
								$_SESSION['sessionUsuario_Cpf'] = null;
								$_SESSION['sessionUsuario_Nascimento'] = null;
								$_SESSION['sessionUsuario_Validacao'] = null;
								$_SESSION['session_modalUsuario'] = null;
								$_SESSION['session_acaoUsuario'] = null;
							?>
						}
        </script>
        <?php } ?>
        <!-- FIM DO SCRIPT -->
    </BODY>
</HTML>