<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Categorias;
use App\Models\Productos;
use App\Models\ProductosDetalle;
use App\Models\Productosdetalles;
use App\Models\Unidades;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProductosController extends Controller
{
	public function __construct()
	{
		$this->middleware('role:1');
	}

	public function index()
	{
		$data['unidades'] = Unidades::where('status', 1)->get();
		$data['categorias'] = Categorias::where('status', 1)->get();
		return view('/content/panel/productos', $data);
	}

	public function home()
	{
		$data['unidades'] = Unidades::where('status', 1)->get();
		$data['categorias'] = Categorias::where('status', 1)->get();
		return view('/content/panel/productosDetalles', $data);
	}

	public function list()
	{
		$productos = Productos::where('status', 1)->orderBy('nombre', 'asc')->get();
		$dataProductos = [];
		foreach ($productos as $producto) {
			$ver = '<div class="d-inline-flex">
								<a href="javascript:;" class="producto-show" data-productoid="' . $producto->id . '"><i data-feather="eye"></i></a>
							  </div> 		
							  ';
			$editar = '<div class="d-inline-flex">
								<a href="javascript:;" class="producto-edit" data-productoid="' . $producto->id . '"><i data-feather="edit"></i></a>
							  </div>
							  ';
			$eliminar = '<div class="d-inline-flex">
								<a href="javascript:;" class="producto-delete" data-productoid="' . $producto->id . '"><i data-feather="trash-2" color="red"></i></a>
							  </div>
							  ';
			$arrayProductos = array(
				"id" => $producto->id,
				"nombre" => $producto->nombre,
				"unidad" => $producto->unidad->nombre,
				"stock" => $producto->stock,
				"actions" => $ver . $editar . $eliminar
			);
			array_push($dataProductos, (object)$arrayProductos);
		}
		$dataReturn['data'] = $dataProductos;
		return json_encode($dataReturn);
	}

	public function submit(Request $request)
	{

		
		$validator = Validator::make($request->all(), [
			'tipo_submit' => 'required|integer',
			'name' => 'required|string',
			'code' => 'nullable|string',
			'unidad' => 'required|integer',
			'sw_topico' => 'required|integer',
			'sw_ambulancia' => 'required|integer',
			'productos' => 'required|array'
		]);
		if ($validator->fails()) {
			echo json_encode(array("sw_error" => 1, "titulo" => "Error", "type" => "error", "message" => $validator->errors()));
			exit;
		}

		if ($request->tipo_submit == 0) { // INSERTAMOS
			
			//'stock' => trim($request->producto_stock),
			$producto = Productos::create([
				'unidad_id' => trim($request->unidad),
				'nombre' => trim($request->name),
				'codbarra' => trim($request->code),
				'topico' => trim($request->sw_topico),
				'ambulancia' => trim($request->sw_ambulancia)
			]);

			//DETALLE DE PRODUCTOS
			Productosdetalles::where('producto_id',$producto->id)->delete();
			$countStock=0;
			foreach ($request->productos as $product) {
				Productosdetalles::create([
					"producto_id"=>$producto->id,
					"cantidad"=>$product['stock'],
					"fecha_vencimiento"=>$product['fecha']
				]);
				$countStock=$countStock+$product['stock'];
				
			}
			
			$producto->update(['stock'=>$countStock]);
			echo json_encode(array("sw_error" => 0, "titulo" => "Éxito", "type" => "success", "message" => "Se registro el producto."));
		} elseif ($request->tipo_submit > 0) { // ACTUALIZAMOS
			$producto = Productos::where('id', $request->tipo_submit)->first();
			if ($producto) {
				try {
					$producto->update([
						'unidad_id' => trim($request->unidad),
						'nombre' => trim($request->name),
						'codbarra' => trim($request->code),
						'topico' => trim($request->sw_topico),
						'ambulancia' => trim($request->sw_ambulancia)
					]);

					//DETALLE DE PRODUCTOS
					Productosdetalles::where('producto_id',$producto->id)->delete();
					$countStock=0;
					foreach ($request->productos as $product) {
						Productosdetalles::create([
							"producto_id"=>$producto->id,
							"cantidad"=>$product['stock'],
							"fecha_vencimiento"=>$product['fecha']
						]);
						$countStock=$countStock+$product['stock'];
					}
					$producto->update(['stock'=>$countStock]);

					echo json_encode(array("sw_error" => 0, "titulo" => "Éxito", "type" => "success", "message" => "Se actualizo el producto."));
				} catch (\Illuminate\Database\QueryException $exception) {
					$errorInfo = $exception->errorInfo;
					echo json_encode(array("sw_error" => 1, "titulo" => "Error", "type" => "error", "message" => $errorInfo));
				}
			} else {
				echo json_encode(array("sw_error" => 1, "titulo" => "Error", "type" => "error", "message" => 'Ocurrio un problema, no encontramos el producto que quiere modificar.'));
			}
		} else {
			echo json_encode(array("sw_error" => 1, "titulo" => "Error", "type" => "error", "message" => 'Ocurrio un problema, no encontramos el producto que quiere modificar.'));
		}
	}

	public function data(Request $request, $producto)
	{
		$producto=Productos::with('detalles')->where('id',$producto)->where('status',1)->first();
		
		if ($producto) {
			echo json_encode(array("sw_error" => 0, "data" => $producto));
		} else {
			echo json_encode(array("sw_error" => 1, "data" => []));
		}
	}

	public function delete(Request $request, Productos $producto)
	{
		if ($producto) {
			$productoData = [];
			$productoData['status'] = '0';
			$producto->update($productoData);
			echo json_encode(array("sw_error" => 0, "message" => "Se elimino la categoria."));
		} else {
			echo json_encode(array("sw_error" => 1, "message" => "Ocurrio un problema, intentelo nuevamente."));
		}
	}

	public function search(Request $request)
	{
		$productos = Productos::where('nombre', 'LIKE', '%' . $request->search . '%')->orWhere('codbarra', 'LIKE', '%' . $request->search . '%')->where('status', 1)->get();
		$arrayProductos = array();
		foreach ($productos as $producto) {
			array_push($arrayProductos, array("id" => $producto->id, "text" => $producto->nombre));
		}
		echo json_encode(array('results' => $arrayProductos));
	}


}
