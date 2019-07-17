<?php ?>
<HTML>
    <HEAD>
        <meta charset="UTF-8">
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
                    <form name="formNotificacao" id="formNotificacao" method="post" action="../../controllers/controllerNotificacao.php">
                        <div class="modal-body">
                            <input type="hidden" name="ID_Notificacao" />
                            <input type="hidden" name="acao" value="" />
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Nm_Bairro">Bairro</label>
                                    <input type="text" class="form-control" id="Nm_Bairro" name="Nm_Bairro" maxlength="100">
                                </div>
                            </div>
							<div class="row">
								<div class="col-md-12">
                                    <label for="Nm_Rua">Rua</label>
                                    <input type="text" class="form-control" id="Nm_Rua" name="Nm_Rua" maxlength="100">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="Dt_Notificacao">Data</label>
                                    <input type="date" class="form-control frm-data" id="Dt_Notificacao" name="Dt_Notificacao">
                                </div>
								<div class="col-md-8">
                                    <label for="Ds_PontoProximo">Ponto próximo</label>
                                    <input type="text" class="form-control" id="Ds_PontoProximo" name="Ds_PontoProximo">
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-12">
                                    <label for="Ft_Notificacao">Imagem</label>
									<img src="" alt="#" class="img-rounded" id="Ft_Notificacao" name="Ft_Notificacao">
									<input type="file" id="Ft_Notificacao" class="form-control" name="Ft_Notificacao"/>
                                </div>
                            </div>
							<div class="row">
								<div class="col-md-12">
                                    <label for="Ds_Notificacao">Descrição</label>
                                     <textarea style="resize: none" maxlength = "500" class="form-control" rows="3" id="Ds_Notificacao" name="Ds_Notificacao"></textarea>
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
        <table class="table table-hover">
            <thead thead-default>
                <tr>
                    <th>Tipo</th>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Entrada em</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!--<?php 
                    if($_SESSION['session_listarProdutos'] == 'pesquisa') 
                    {
                        while($produto = $select2->fetch())
                        {  
                    ?>
                            <tr>
                                <td><?php echo utf8_encode($produto["Tp_Produto"]) ?></td>
                                <td><?php echo $produto["Nr_Codigo"] ?></td>
                                <td><?php echo utf8_encode($produto["Nm_Produto"]) ?></td>
                                <td><?php echo $produto["Nr_Quantidade"] ?></td>
                                <td><?php echo date("d/m/Y", strtotime($produto["Dt_Entrada"])); ?></td>
                                <td><a href="#produto" data='<?php echo json_encode(array_map("utf8_encode", $produto)) ?>' id="editar_produto_<?php echo $produto["ID_Produto"]?>" class="btn btn-primary btn_editar_produto">Editar</a></td>
                                <td><a href="#produto" data='<?php echo json_encode(array_map("utf8_encode", $produto)) ?>' id="excluir_produto_<?php echo $produto["ID_Produto"]?>" class="btn btn-danger btn_excluir_retirada">Excluir</a></td>
                            </tr>
                    <?php 
                        }
                    
                        $_SESSION['session_listarProdutos'] = 'normal';
                        $_SESSION['session_pesquisaProduto'] = '';
                    }
                    else
                    { 
                        while($produto = $select->fetch())
                        { ?>
                            <tr>
                            <td><?php echo utf8_encode($produto["Tp_Produto"]) ?></td>
                            <td><?php echo $produto["Nr_Codigo"] ?></td>
                            <td><?php echo utf8_encode($produto["Nm_Produto"]) ?></td>
                            <td><?php echo $produto["Nr_Quantidade"] ?></td>
                            <td><?php echo date("d/m/Y", strtotime($produto["Dt_Entrada"])); ?></td>
                            <td><a href="#produto" data='<?php echo json_encode(array_map("utf8_encode", $produto)) ?>' id="editar_produto_<?php echo $produto["ID_Produto"]?>" class="btn btn-primary btn_editar_produto">Editar</a></td>
                            <td><a href="#produto" data='<?php echo json_encode(array_map("utf8_encode", $produto)) ?>' id="excluir_produto_<?php echo $produto["ID_Produto"]?>" class="btn btn-danger btn_excluir_retirada">Excluir</a></td>
                        </tr>
                    <?php 
                        }
                    } ?>-->
            </tbody>
        </table>