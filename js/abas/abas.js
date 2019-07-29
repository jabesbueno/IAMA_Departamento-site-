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
	
	// Adicionar novo exame para o Guarda
	$('.btn_adicionar_usuario').click(function()
	{
		$('#formUsuario input[name="acao"]').val('adicionar');
	});
	
	$('.btn_inativar_usuario').click(function()
	{
        var dados = $.parseJSON($(this).attr('data'));
        
        $('#inativarUsuario input[name="ID_Usuario"').val(dados.ID_Usuario);
		$('#inativarUsuario input[name="Nm_Usuario"]').val(dados.Nm_Usuario);
		$('#inativarUsuario input[name="Nr_Cpf"]').val(dados.Nr_Cpf);
		$('#inativarUsuario input[name="Dt_Nascimento"]').val(dados.Dt_Nascimento);
		
		$('#modalInativarUsuario').modal();
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