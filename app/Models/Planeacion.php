<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

class Planeacion extends Model
{
    use HasFactory;
    protected $table = 'planeaciones';
    protected $fillable=[
        'nombre',
        'fecha',
        'observacion',
        'id_asignatura',
        'asignatura',
        'id_grupo',
        'grupo',
        'id_profesor',
        'profesor',
        'equipo',
        'material',
        'estatus',//visto, plenado, pendiente        
    ];
    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }
 
    public function scopeFecha($query){
        // return 
    }
}
