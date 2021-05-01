<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAssociate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idproject',
        'idassociate',
        'valor',
        'porcentaje',
        'fase1','fase1ok',
        'fase2','fase2ok',
        'fase3','fase3ok',
        'totfases','partfinal_p','partfinal'
    ];
}
