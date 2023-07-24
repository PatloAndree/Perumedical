<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CategoriasController extends Controller
{
	public function __construct()
	{
		$this->middleware('role:1');
	}

	public function index()
	{
		return view('/content/panel/categorias');
	}

	public function list()
	{
		$categorias = Categorias::where('status', 1)->orderBy('nombre', 'asc')->get();
		$dataCategorias = [];
		foreach ($categorias as $categoria) {
			$ver = '<div class="d-inline-flex">
								<a href="javascript:;" class="categoria-show" data-categoriaid="' . $categoria->id . '"><i data-feather="eye"></i></a>
							  </div>
							  ';
			$editar = '<div class="d-inline-flex">
								<a href="javascript:;" class="categoria-edit" data-categoriaid="' . $categoria->id . '"><i data-feather="edit"></i></a>
							  </div>
							  ';
			$eliminar = '<div class="d-inline-flex">
								<a href="javascript:;" class="categoria-delete" data-categoriaid="' . $categoria->id . '"><i data-feather="trash-2" color="red"></i></a>
							  </div>
							  ';
			$arrayCategoria = array(
				"nombre" => $categoria->nombre,
				"slug" => $categoria->slug,
				"actions" => $ver . $editar . $eliminar
			);
			array_push($dataCategorias, (object)$arrayCategoria);
		}
		$dataReturn['data'] = $dataCategorias;
		return json_encode($dataReturn);
	}

	public function submit(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'tipo_submit' => 'required|integer',
			'categoria_nombre' => 'required|string|max:255'
		]);

		if ($validator->fails()) {
			echo json_encode(array("sw_error" => 1, "titulo" => "Error", "type" => "error", "message" => $validator->errors()));
			exit;
		}

		if ($request->tipo_submit == 0) { // INSERTAMOS
			try {
				Categorias::create([
					'nombre' => trim($request->categoria_nombre),
					'slug' => Str::slug(trim($request->categoria_nombre)),
					'status' => 1
				]);
				echo json_encode(array("sw_error" => 0, "titulo" => "Éxito", "type" => "success", "message" => "Se registro la categoria."));
			} catch (\Illuminate\Database\QueryException $exception) {
				$errorInfo = $exception->errorInfo;
				echo json_encode(array("sw_error" => 1, "titulo" => "Error", "type" => "error", "message" => $errorInfo));
			}
		} elseif ($request->tipo_submit > 0) { // ACTUALIZAMOS
			$categoria = Categorias::where('id', $request->tipo_submit)->first();
			if ($categoria) {
				try {
					$categoria->update([
						'nombre' => trim($request->categoria_nombre),
						'slug' => Str::slug(trim($request->categoria_nombre)),
						'status' => 1
					]);
					echo json_encode(array("sw_error" => 0, "titulo" => "Éxito", "type" => "success", "message" => "Se actualizo la categoria."));
				} catch (\Illuminate\Database\QueryException $exception) {
					$errorInfo = $exception->errorInfo;
					echo json_encode(array("sw_error" => 1, "titulo" => "Error", "type" => "error", "message" => $errorInfo));
				}
			} else {
				echo json_encode(array("sw_error" => 1, "titulo" => "Error", "type" => "error", "message" => 'Ocurrio un problema, no encontramos la categoria que quiere modificar.'));
			}
		} else {
			echo json_encode(array("sw_error" => 1, "titulo" => "Error", "type" => "error", "message" => 'Ocurrio un problema, no encontramos la categoria que quiere modificar.'));
		}
	}

	public function data(Request $request, Categorias $categoria)
	{
		if ($categoria) {
			echo json_encode(array("sw_error" => 0, "data" => $categoria));
		} else {
			echo json_encode(array("sw_error" => 1, "data" => []));
		}
	}

	public function delete(Request $request, Categorias $categoria)
	{
		if ($categoria) {
			$categoriaData = [];
			$categoriaData['status'] = '0';
			$categoria->update($categoriaData);
			echo json_encode(array("sw_error" => 0, "message" => "Se elimino la categoria."));
		} else {
			echo json_encode(array("sw_error" => 1, "message" => "Ocurrio un problema, intentelo nuevamente."));
		}
	}
}
