$(document).ready(function()
{		
    // Limpar o form quando o usuário fechar o modal
    $('.modal').on('hidden.bs.modal', function()
	{
       $('#' + $(this).attr('ref')).trigger('reset');
       $('#' + $(this).attr('ref') + ' input[name="ID_Pessoa"]').val('');
       $('#' + $(this).attr('ref') + ' input[name="acao"]').val('');

       location.reload();
	});
	
	// Fechar o alerta automaticamente
	$(".alert").fadeTo(2000, 500).fadeOut(750, function()
	{
        $(".alert").alert('close');
    });
	
	// Adicionar novo usuário
	$('.btn_adicionar_usuario').click(function()
	{
		$('#formUsuario input[name="acao"]').val('adicionar');
	});
	
	// Adicionar novo evento
	$('.btn_adicionar_evento').click(function()
	{
		$('#formEvento input[name="acao"]').val('adicionar');
	});
	
	// Adicionar nova noticia
	$('.btn_adicionar_noticia').click(function()
	{
		$('#formNoticia input[name="acao"]').val('adicionar');
	});
	
	// Adicionar nova notificacao
	$('.btn_adicionar_notificacao').click(function()
	{
		$('#formNotificacao input[name="acao"]').val('adicionar');
	});
	
	//Editando evento
	$('.btn_editar_evento').click(function()
	{
        var dados = $.parseJSON($(this).attr('data'));
        
        $('#formEvento input[name="ID_Evento"').val(dados.ID_Evento);
		$('#formEvento input[name="ID_Usuario"]').val(dados.ID_Usuario);
		$('#formEvento input[name="Nm_Evento"').val(dados.Nm_Evento);
		$('#formEvento input[name="Dt_Evento"]').val(dados.Dt_Evento);
		$('#formEvento input[name="Hr_Evento"]').val(dados.Hr_Evento);
		$('#formEvento input[name="Nm_Local"]').val(dados.Nm_Local);
		$('#formEvento textarea[name="Ds_Evento"]').val(dados.Ds_Evento);
		
		$('#formEvento input[name="acao"]').val('editar');
		
		$('#modalEvento').modal();
	});
	
	//Editando noticia
	$('.btn_editar_noticia').click(function()
	{
        var dados = $.parseJSON($(this).attr('data'));
        
        $('#formNoticia input[name="ID_Noticia"').val(dados.ID_Noticia);
		$('#formNoticia input[name="ID_Usuario"]').val(dados.ID_Usuario);
		$('#formNoticia input[name="Nm_Noticia"').val(dados.Nm_Noticia);
		$('#formNoticia input[name="Dt_Noticia"]').val(dados.Dt_Noticia);
		$('#formNoticia input[name="Hr_Noticia"]').val(dados.Hr_Noticia);
		$('#formNoticia textarea[name="Ds_Noticia"]').val(dados.Ds_Noticia);
		
		$('#formNoticia input[name="acao"]').val('editar');
		
		$('#modalNoticia').modal();
	});
	
	//Inativando um usuário
	$('.btn_inativar_usuario').click(function()
	{
        var dados = $.parseJSON($(this).attr('data'));
        
        $('#inativarUsuario input[name="ID_Usuario"').val(dados.ID_Usuario);
		$('#inativarUsuario input[name="Nm_Usuario"]').val(dados.Nm_Usuario);
		$('#inativarUsuario input[name="Nr_Cpf"]').val(dados.Nr_Cpf);
		$('#inativarUsuario input[name="Dt_Nascimento"]').val(dados.Dt_Nascimento);
		
		$('#modalInativarUsuario').modal();
	});
	
	//Excluir evento
	$('.btn_excluir_evento').click(function()
	{
        var dados = $.parseJSON($(this).attr('data'));
        
        $('#formExcluirEvento input[name="ID_Evento"').val(dados.ID_Evento);
		$('#formExcluirEvento input[name="ID_Usuario"]').val(dados.ID_Usuario);
		$('#formExcluirEvento input[name="Nm_Evento"').val(dados.Nm_Evento);
		$('#formExcluirEvento input[name="Dt_Evento"]').val(dados.Dt_Evento);
		$('#formExcluirEvento input[name="Hr_Evento"]').val(dados.Hr_Evento);
		
		$('#formExcluirEvento input[name="acao"]').val('editar');
		
		$('#modalExcluirEvento').modal();
	});
	
	//Excluir noticia
	$('.btn_excluir_noticia').click(function()
	{
        var dados = $.parseJSON($(this).attr('data'));
        
        $('#formExcluirNoticia input[name="ID_Noticia"').val(dados.ID_Noticia);
		$('#formExcluirNoticia input[name="ID_Usuario"]').val(dados.ID_Usuario);
		$('#formExcluirNoticia input[name="Nm_Noticia"').val(dados.Nm_Noticia);
		$('#formExcluirNoticia input[name="Dt_Noticia"]').val(dados.Dt_Noticia);
		$('#formExcluirNoticia input[name="Hr_Noticia"]').val(dados.Hr_Noticia);
		
		$('#formNoticia input[name="acao"]').val('editar');
		
		$('#modalExcluirNoticia').modal();
	});
	
	//Visualizando notificacao
	$('.btn_visualizar_notificacao').click(function()
	{
        var dados = $.parseJSON($(this).attr('data'));
		$('#formVisualizaNotificacao input[name="ID_Notificacao"').val(dados.ID_Notificacao);
		$('#formVisualizaNotificacao input[name="ID_Usuario"]').val(dados.ID_Usuario);
		$('#formVisualizaNotificacao input[name="ID_Historico"').val(dados.ID_Historico);
		$('#formVisualizaNotificacao textarea[name="Ds_Observacao"').val(dados.Ds_Observacao).disabled;
        document.getElementById("txtNotificacao").innerHTML = " O cidadão <b>"+ dados.Nm_Usuario +
		"</b> de CPF <b>" + dados.Nr_Cpf + "</b> apresentou uma notificação no dia <b>" + dados.Dt_Notificacao +
		"</b> encontrada na rua <b>"+ dados.Nm_Rua +"</b> pertencente ao bairro <b>" + dados.Nm_Bairro +
		"</b> ponto de referência <b>"+ dados.Ds_PontoProximo + "</b>. <br> Relatando a seguinte descrição: <b>"+
		dados.Ds_Notificacao + "</b> conforme a imagem apresenta abaixo: ";
		document.getElementById("Fot_Notificacao").src = dados.Ft_Notificacao;
		
		$('#modalNotificacaoVisaulizacao').modal();
	});
	
	// Barrar acesso a tab caso a mesma esteja disabled
	$('a[data-toggle="tab"]').on('click', function() {				
		if ($(this).parent('li').hasClass('disabled')) {
			return false;
		};
	});
	
	// Armazenar aba/tab seleciona/aberta
	$("ul.nav-tabs > li > a").on("shown.bs.tab", function(e) 
	{			
		var id = $(e.target).attr("href").substr(1);
		window.location.hash = id;
	});

	// Restaurar aba aberta após recarregar a página
	var hash = window.location.hash;
	$('#tabs_navegacao_gerenciamento a[href="' + hash + '"]').tab('show');
});