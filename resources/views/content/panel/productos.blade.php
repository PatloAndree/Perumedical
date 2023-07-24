@extends('layouts/contentLayoutMaster')
@section('title', 'Productos')

@section('page-style')
	<link rel="stylesheet" type="text/css" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/multiselect/multi-select.css') }}">
	<style>
		.ms-container{
			width: 100%;
		}
	</style>
@endsection

@section('content')
	<div class="card">
		<div class="card-body">
			<!-- list and filter start -->
			<div class="card">
				<div class="card-body border-bottom text-right">
					<button class="btn btn-info" tabindex="0" type="button" data-bs-toggle="modal" id="nuevoProducto"><span>Nuevo producto</span></button>
				</div>
				<div class="card-datatable table-responsive pt-0">
					<table class="user-list-table table" id="table-productos">
						<thead class="table-light">
						<tr>
							<th>Nombre</th>
							<th>Unidad</th>
							<th>Stock</th>
							<th>Actions</th>
						</tr>
						</thead>
					</table>
				</div>
				<!-- Modal to add new asignacion starts-->
				
				<!-- Modal to add new sede Ends-->
			</div>
		</div>
	</div>
	<div class="modal fade" id="modals-producto" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-transparent">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body pb-5 px-sm-5 pt-50">
					<div class="text-center mb-2">
						<h1 class="mb-1" id="title-modal">Nuevo producto</h1>
					</div>
					<form id="productoForm" name="productoForm" class="row gy-1 pt-75">

						

						<div class="col-12 col-md-12">
							<label class="form-label" for="producto_nombre">Nombre</label>
							<input type="text" id="producto_nombre" name="producto_nombre" class="form-control" required/>
						</div>
						<!-- <div class="col-12 col-md-12 mb-1">
							<label class="form-label" for="producto_codigobarra">Codigo de barra</label>
							<input type="text" id="producto_codigobarra" name="producto_codigobarra" class="form-control" />
						</div> -->
						<div class="col-12 col-md-4">
							<label class="form-label" for="producto_id">Código.</label>
							<input type="text" id="producto_id" name="producto_id" class="form-control" required/>
						</div>
						<div class="col-12 col-md-8 mb-1">
							<label class="form-label" for="producto_unidad">Unidad</label>
							<select id="producto_unidad" name="producto_unidad" class="form-select" required>
								<option value="">Seleccionar</option>
								@foreach ($unidades as $unidad)
									<option value="{{$unidad->id}}">{{$unidad->nombre.' ['.$unidad->abreviatura.']'}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-12 col-md-6 mb-1">
								<button type="button" id="btn-stock" class="btn btn-info me-1">+ Stock</button>
						</div>
						<div class="col-12 mb-1">
							<div class="card card-body" id="body-products-insert">
								
							</div>
						</div>
						<div class="row d-none" id="showStock">

							<div class="col-12 col-md-7 mb-1">
								<label class="form-label" for="producto_nuevo_stock">Nuevo stock</label>
								<input type="text" id="producto_nuevo_stock" name="producto_nuevo_stock" class="form-control" />
							</div>
							
							<div class="col-12 col-md-5 mb-1">
								<label class="form-label" for="producto_fecha_caducidad">Fecha caducidad</label>
								<input type="date" id="producto_fecha_caducidad" name="producto_fecha_caducidad" class="form-control" />
							</div>
						</div>
						
						<!-- <div class="">
							<label class="form-label" for="producto_categorias">Categorías</label>
							<select id='producto_categorias' name="producto_categorias[]" multiple='multiple'>
								@foreach ($categorias as $categoria)
									<option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
								@endforeach
							</select>
						</div>
						-->
							<label class="form-label" for="topico">Aspectos Generales</label>
							<div class="col-12 col-md-6 mb-1">
								<input type="checkbox" id="producto_topico" name="topico" class="form-check-input" checked />
								<label class="form-label" for="producto_topico">Topico</label>
								<input type="text" id="id_topico" class="d-none" />

							</div> 

							<div class="col-12 col-md-6 mb-1">
								<input type="checkbox" id="producto_ambulancia" name="ambulancia" class="form-check-input" />
								<label class="form-label" for="producto_ambulancia">Ambulancia</label>
								<input type="text" id="id_ambulancia" class="d-none"/>
							</div>

						<input type="text" class="d-none" name="tipo_submit" id="tipo_submit" value="0" required>
						<div class="col-12 text-right mt-2 pt-50 form-botones">
							<button type="button" id="btn-save" class="btn btn-info me-1">Guardar</button>
							<button type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('page-script')
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset('js/scripts/multiselect/jquery.multi-select.js') }}"></script>
<script src="{{ asset('js/scripts/multiselect/jquery.quicksearch.min.js') }}"></script>
<script src="{{ asset('js/scripts/numeric/numeric.js') }}"></script>
<script>
	var countFilaAdd=1;
	function validateNumber(){
		$(".number-decimal").numeric({
			decimal: ".",
			negative: false,
			scale: 2
		});
		$(".number-integer").numeric({
			decimal: false,
			negative: false
		});
	}
	$('#producto_categorias').multiSelect({
		selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='buscar'>",
  		selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='buscar'>",
		afterInit: function(ms){
			var that = this,
				$selectableSearch = that.$selectableUl.prev(),
				$selectionSearch = that.$selectionUl.prev(),
				selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
				selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

			that.qs1 = $selectableSearch.quicksearch(selectableSearchString).on('keydown', function(e){
				if (e.which === 40){
					that.$selectableUl.focus();
					return false;
				}
			});

			that.qs2 = $selectionSearch.quicksearch(selectionSearchString).on('keydown', function(e){
				if (e.which == 40){
					that.$selectionUl.focus();
					return false;
				}
			});
		},
		afterSelect: function(){
			this.qs1.cache();
			this.qs2.cache();
		},
		afterDeselect: function(){
			this.qs1.cache();
			this.qs2.cache();
		}
	});

	$("#nuevoProducto").click(function(){
		$(this).prop('disabled',true);
		$("#title-modal").html('Nuevo producto');
		$("#tipo_submit").val(0);
		$("#modals-producto").modal('show');
		$('#m_m').text('+');

	});
	$('#modals-producto').on('hidden.bs.modal', function (e) {
		$('.form-botones').removeClass('d-none');
		$("#nuevoProducto").prop('disabled',false);
		$("#productoForm").trigger("reset");
		$("#btn-stock").removeClass('d-none');
		
		$(".remove_product_insert").removeClass('d-none');
		$("#body-products-insert").html("");
		countFilaAdd=1;
	});
	dt_ajax = $("#table-productos").dataTable({
		processing: true,
		dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
		ajax: "{{route('productos.list')}}",
		language: {
			paginate: {
				previous: '&nbsp;',
				next: '&nbsp;'
			}
		},
		columns: [
				{ data: 'nombre' },
				{ data: 'unidad' },
				{ data: 'stock' },
				{ data: 'actions', className: "text-right" }
			],
		drawCallback: function( settings ) {
			feather.replace();
		}
	});

	$("#btn-save").click(function(){
		$("#btn-save").prop('disabled',true);
		isValid = $("#productoForm").valid();
		productos = getProductsInsert();
		if(isValid && productos.length>0){
			tipo_submit=$("#tipo_submit").val();
			name=$("#producto_nombre").val();
			code=$("#producto_id").val();
			
			unidad=$("#producto_unidad").val();
			sw_topico = ($("#producto_topico").is(":checked") ? "1" : "0");
			sw_ambulancia = ($("#producto_ambulancia").is(":checked") ? "1" : "0");
			v_token = "{{ csrf_token() }}";
			method = 'POST';
			$.ajax({
				url: "{{route('producto.submit')}}",
				type: "POST",
				data: {_token:v_token,method:method,name:name,code:code,unidad:unidad,sw_topico:sw_topico,sw_ambulancia:sw_ambulancia,productos:productos,tipo_submit:tipo_submit},
				dataType: 'json',
				success: function(obj){
					if(typeof obj.message === 'object' && obj.message !== null){
						mensaje='';
						Object.values(obj.message).forEach(element => {
							mensaje+=element+'<br>';
						});
					}else{
						mensaje=obj.message;
					}
					if(obj.sw_error==1){
						Swal.fire({
							position: "bottom-end",
							icon: "warning",
							title: "Atención",
							text: mensaje,
							showConfirmButton: false,
							timer: 2500
						});
					}else{
						Swal.fire({
							position: "bottom-end",
							icon: "success",
							title: "Éxito",
							text: mensaje,
							showConfirmButton: false,
							timer: 2500
						});
						dt_ajax.api().ajax.reload();
						
						$("#modals-producto").modal('hide');
					}
					$("#btn-save").prop('disabled',false);
				}
			});
		}else{
			$("#btn-save").prop('disabled',false);
		}
	});

	
	$("#btn-stock").click(function(){
		htmlStockInput=`<div class="row fila-body-products-add">
							<div class="col-12 col-md-5 mb-1">
								<label class="form-label" for="producto_nuevo_stock-${countFilaAdd}">Stock</label>
								<input type="text" id="producto_nuevo_stock-${countFilaAdd}" class="form-control number-integer product_stock_insert" required>
							</div>
							<div class="col-12 col-md-5 mb-1">
								<label class="form-label" for="producto_fecha_caducidad-${countFilaAdd}">Fecha caducidad</label>
								<input type="date" id="producto_fecha_caducidad-${countFilaAdd}" class="form-control product_date_insert" required>
							</div>
							<div class="col-12 col-md-2 mx-auto my-auto">
								<i data-feather="trash-2" color="red" style="cursor: pointer;" class="remove_product_insert"></i>
							</div>
						</div>`;
		if($(".fila-body-products-add").length==0){
			$("#body-products-insert").append(htmlStockInput);
			validateNumber();
			countFilaAdd++;
		}else{
			sw_error=0;
			$(".fila-body-products-add").each(function(){
				fila=$(this);
				stock=fila.find('.product_stock_insert').val();
				fecha=fila.find('.product_date_insert').val();
				if((stock=="" || stock <= 0) || (fecha=="")){
					sw_error=1;
				}
			});

			if(sw_error==1){
				Swal.fire({
					position: "bottom-end",
					icon: "warning",
					title: "Atención",
					text: "Antes de agregar una fila adicional, rellene todas las filas.",
					showConfirmButton: false,
					timer: 3000
				});
			}else{
				$("#body-products-insert").append(htmlStockInput);
				validateNumber();
				countFilaAdd++;
			}

		}
		feather.replace();
		

		
	});

	function getProductsInsert(){
		arrProductJsons=[];
		$(".fila-body-products-add").each(function(){
			fila=$(this);
			stock=fila.find('.product_stock_insert').val();
			fecha=fila.find('.product_date_insert').val();
			arrProductJsons.push({"stock": stock,"fecha": fecha});
		});

		return arrProductJsons;
	}
	
	$("#table-productos").on('click','.producto-show',function(){
		productoID=$(this).data('productoid');
		$('#m_m').text('+');
		$("#title-modal").html('Datos del producto');
		$("#tipo_submit").val(productoID);
		v_token = "{{ csrf_token() }}";
		method = 'POST';
		$.ajax({
			url: "{{ route('producto.data') }}/"+productoID,
			type: "GET",
			data: {_token:v_token,_method:method},
			data: {_token:v_token},
			dataType: 'json',
			success: function(obj){
				if(obj.sw_error==1){
					Swal.fire({
						position: "bottom-end",
						icon: "warning",
						title: "Atención",
						text: obj.message,
						showConfirmButton: false,
						timer: 2500
					});
				}else{
					categoria=obj.data;
					setDataModal(categoria);
					$("#productoForm").find('input,select,textarea').prop('disabled',true);
					$('.form-botones').addClass('d-none');
					$('#showStock').addClass('d-none');
					$("#btn-stock").addClass('d-none');
					$(".remove_product_insert").addClass('d-none');
					$("#modals-producto").modal('show');
				}
			}
		});
	});

	$("#table-productos").on('click','.producto-edit', function(){
		productoID=$(this).data('productoid');
		$('#m_m').text('+');
		$("#title-modal").html('Editar el producto');
		$("#tipo_submit").val(productoID);
		v_token = "{{ csrf_token() }}";
		method = 'GET';
		$.ajax({
			url: "{{ route('producto.data') }}/"+productoID,
			type: "GET",
			data: {_token:v_token,_method:method},
			dataType: 'json',
			success: function(obj){
				if(obj.sw_error==1){
					Swal.fire({
						position: "bottom-end",
						icon: "warning",
						title: "Atención",
						text: obj.message,
						showConfirmButton: false,
						timer: 2500
					});
				}else{
					producto=obj.data;
					setDataModal(producto);
					$("#productoForm").find('input,select,textarea').prop('disabled',false);
					$("#modals-producto").modal('show');
				}
			}
		});
	});

	$("#table-productos").on('click','.producto-delete', function(){
		productoID=$(this).data('productoid');
		Swal.fire({
			title: "Estas seguro de eliminar este producto?",
			icon: "question",
			showCancelButton: true,
			confirmButtonText: "Si, eliminar!",
			customClass: {
				confirmButton: "btn btn-info",
				cancelButton: "btn btn-outline-danger ms-1"
			},
			buttonsStyling: false
		}).then((function(t) {
			if(t.isConfirmed==true){
				v_token = "{{ csrf_token() }}";
				method = 'PUT';

				$.ajax({
					url: "{{ route('producto.delete') }}/"+productoID,
					type: "POST",
					data: {_token:v_token,_method:method},
					dataType: 'json',
					success: function(obj){
						if(obj.sw_error==1){
							Swal.fire({
								position: "bottom-end",
								icon: "warning",
								title: "Atención",
								text: obj.message,
								showConfirmButton: false,
								timer: 2500
							});
						}else{
							Swal.fire({
								position: "bottom-end",
								icon: "success",
								title: "Éxito",
								text: obj.message,
								showConfirmButton: false,
								timer: 2500
							});
							dt_ajax.api().ajax.reload();
						}
					}
				});
			}
		}))
	});

	if( $('#producto_topico').prop('checked') ){
			$('#producto_topico').val(1);

		}else{
			$('#producto_topico').val(0);
		}

		if( $('#producto_ambulancia').prop('checked') ){
			$('#producto_ambulancia').val(1);
		}else{
			$('#producto_ambulancia').val(0);

		}


	function setDataModal(obj){
		$("#producto_id").val(obj.id);
		$("#producto_nombre").val(obj.nombre);
		$("#producto_unidad").val(obj.unidad_id);
		$("#producto_stock").val(obj.stock);
		$("#producto_nuevo_stock").val(obj.nuevo_stock);
		$("#producto_fecha_caducidad").val(obj.fecha_caducidad);
		
		if(obj.topico == 0){
			$("#producto_topico").prop("checked", false);
			

		}else{
			$("#producto_topico").prop("checked", true);

		}

		if(obj.ambulancia == 0){
			$("#producto_ambulancia").prop("checked", false);


		}else{
			$("#producto_ambulancia").prop("checked", true);


		}

		detalles=obj.detalles;
		htmlDetalles='';
		detalles.forEach(element => {
			htmlDetalles+=`<div class="row fila-body-products-add">
							<div class="col-12 col-md-5 mb-1">
								<label class="form-label" for="producto_nuevo_stock-${countFilaAdd}">Stock</label>
								<input type="text" id="producto_nuevo_stock-${countFilaAdd}" class="form-control number-integer product_stock_insert" value="${element.cantidad}" required>
							</div>
							<div class="col-12 col-md-5 mb-1">
								<label class="form-label" for="producto_fecha_caducidad-${countFilaAdd}">Fecha caducidad</label>
								<input type="date" id="producto_fecha_caducidad-${countFilaAdd}" class="form-control product_date_insert" value="${element.fecha_vencimiento}" required>
							</div>
							<div class="col-12 col-md-2 mx-auto my-auto">
								<i data-feather="trash-2" color="red" style="cursor: pointer;" class="remove_product_insert"></i>
							</div>
						</div>`;
						countFilaAdd++;
		});
		$("#body-products-insert").html(htmlDetalles);
		validateNumber();
		feather.replace();


	}
</script>
@endsection