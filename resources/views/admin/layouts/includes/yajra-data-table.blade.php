<link rel="stylesheet" href="{{ asset('public/dist/plugins/Responsive-2.2.5/css/responsive.dataTables.css') }}">
  <!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('public/dist/plugins/bootstrap-daterangepicker/daterangepicker.css') }}">

<div class="table-responsive pt-2">
    {!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive', 'width' => '100%', 'cellspacing' => '0']) !!}
</div>

<script src="{{ asset('public/dist/plugins/DataTables-1.10.21/js/jquery.dataTablesCus.min.js') }}"></script>
<script src="{{ asset('public/dist/plugins/Responsive-2.2.5/js/dataTables.responsive.min.js') }}"></script>
{!! $dataTable->scripts() !!}
<script type="text/javascript">
	'use strict';
	$('#dataTableBuilder_length').addClass('p-0');
	$('#dataTableBuilder').removeAttr('style');

	$(".filterbtn").click(function(){
		$(this).toggleClass('btn-primary btn-outline-primary');
	});

	$('.filter').on('change', function(){
    var urlQuery = '?';
    $('.filter').each(function(){
        urlQuery += $(this).attr('name') + '=' + $(this).val() + '&';
    });
    
    $(`#dataTableBuilder`).DataTable().ajax.url(urlQuery).load();
  });
</script>
