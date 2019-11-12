$(document).ready(function() 
{	
	// Função para mostrar pagination somente quando necessário
	$(document).on('init.dt', function(e, dtSettings) 
	{
		if ( e.namespace !== 'dt' ) 
		{
			return;
		}

		var options = dtSettings.oInit.conditionalPaging || $.fn.dataTable.defaults.conditionalPaging;

		if ($.isPlainObject(options) || options === true) 
		{
			var config = $.isPlainObject(options) ? options : {},
			api = new $.fn.dataTable.Api(dtSettings),
			speed = 'slow',
			conditionalPaging = function(e) 
			{
				var $paging = $(api.table().container()).find('div.dataTables_paginate'),
				pages = api.page.info().pages;

				if (e instanceof $.Event) 
				{
					if (pages <= 1) {
						if (config.style === 'fade') {
							$paging.stop().fadeTo(speed, 0);
						}
						else {
							$paging.css('visibility', 'hidden');
						}
					}
					else {
						if (config.style === 'fade') {
							$paging.stop().fadeTo(speed, 1);
						}
						else {
							$paging.css('visibility', '');
						}
					}
				}
				else if (pages <= 1) 
				{
					if (config.style === 'fade') {
						$paging.css('opacity', 0);
					}
					else {
						$paging.css('visibility', 'hidden');
					}
				}
			};

			if ( config.speed !== undefined ) 
			{
				speed = config.speed;
			}

			conditionalPaging();

			api.on('draw.dt', conditionalPaging);
		}
	});

	// Função para neutralização de acentos
	jQuery.extend( jQuery.fn.dataTableExt.oSort, {
		'locale-compare-asc': function ( a, b ) {
			return a.localeCompare(b, 'cs', { sensitivity: 'case' })
		},
		'locale-compare-desc': function ( a, b ) {
			return b.localeCompare(a, 'cs', { sensitivity: 'case' })
		}
	})

	// Função para neutralização de acentos
	jQuery.fn.dataTable.ext.type.search['locale-compare'] = function (data) {
		return NeutralizeAccent(data);
	}

	// Função para neutralização de acentos
	function NeutralizeAccent(data)
	{
		return !data
		? ''
		: typeof data === 'string'
		? data
		.replace(/\n/g, ' ')
		.replace(/[éÉěĚèêëÈÊË]/g, 'e')
		.replace(/[šŠ]/g, 's')
		.replace(/[čČçÇ]/g, 'c')
		.replace(/[řŘ]/g, 'r')
		.replace(/[žŽ]/g, 'z')
		.replace(/[ýÝ]/g, 'y')
		.replace(/[áÁâàÂÀ]/g, 'a')
		.replace(/[íÍîïÎÏ]/g, 'i')
		.replace(/[ťŤ]/g, 't')
		.replace(/[ďĎ]/g, 'd')
		.replace(/[ňŇ]/g, 'n')
		.replace(/[óÓ]/g, 'o')
		.replace(/[úÚůŮ]/g, 'u')
		: data
	}

	// Padrões para todas as tabelas
	$.extend( $.fn.dataTable.defaults, 
	{
		searching: true,
		ordering: true,
		conditionalPaging: true,

		dom: 	"<'row'<'col-sm-12'ltr>>" +
		"<'row'<'col-sm-12'<'text-center'i>>>" +
		"<'row'<'col-sm-12'<'text-center'p>>>",

		language: {
			"sProcessing":    "Processando...",
			"sLengthMenu":    "_MENU_ &nbsp; registros por página",
			"sZeroRecords":   "Nenhum resultado encontrado",
			"sEmptyTable":    "Nenhum registro existente",
			"sInfo":          "Mostrando de _START_ à _END_ de um total de _TOTAL_ registros",
			"sInfoEmpty":     "Mostrando de 0 à 0 de um total de 0 registros",
			"sInfoFiltered":  "(filtrado de um total de _MAX_ registros)",
			"sInfoPostFix":   "",
			"sSearch":        "Pesquisar:",
			"sUrl":           "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Carregando...",
			"oPaginate": {
				"sFirst":    "Primeira",
				"sLast":    "Última",
				"sNext":    "Próxima",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Ordenar coluna de forma crescente",
				"sSortDescending": ": Ordenar coluna de forma decrescente"
			}
		}
	});
	//-------------------------------------------------------------------
	$('#Bs_Notificacao').on('keyup', function() 
	{
		table_notificacao.search
		(
			jQuery.fn.dataTable.ext.type.search.string(NeutralizeAccent(this.value))
			).draw()
	});

	// Tabela notificacao
	var table_notificacao = $('#table_notificacao').DataTable({
		"columnDefs": [{ "type": 'locale-compare', "targets": [ 0, 1, 2 ] }],
		"order": [[ 0, "asc" ]]
	});
	//--------------------------------------------------------------------
});