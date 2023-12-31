<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuraciones extends Model
{
	use HasFactory;
	protected $table = 'configuraciones';
	protected $fillable = [
		'nombre',
		'configuracion1',
		'configuracion2',
		'configuracion3',
		'status'
	];
}
