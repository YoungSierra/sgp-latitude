<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'valor',
        'tiempo',
        'status',
        'valorbruto',
        'iva','iva_v',
        'retfuente','retfuente_v',
        'ica','ica_v',
        'retiva','retiva_v',
        'estampillas','estampillas_v',
        'cree','cree_v,',
        'ica_t','ica_tv',
        'retica','retica_v',
        'netopagar','totimpuesto','neto',
        'valorbruto_c', 'impuestos',
        'totpolizas','totcontratistas', 'subtotal',
        'comisionreferido','comisionreferido_v','imprevistos','imprevistos_v','apalancamiento','apalancamiento_v',
        'obligafinancieras','obligafinancieras_v','rse','rse_v','costosexternos',
        'nominafija','nominafija_v','contratistalattitude','contratistalattitude_v',
        'arqejecutivofirma','arqejecutivofirma_v','subtotcostosfijos','subtotcostosfijos_v',
        'marcalattitude','marcalattitude_v','tecnologia','tecnologia_v','serviciospublicos','serviciospublicos_v',
        'subtotcostosplataforma','subtotcostosplataforma_v','recursoshumanos','recursoshumanos_v','pryviaticos','pryviaticos_v',
        'comunicaciones','comunicaciones_v','subtotrelacorporativas','subtotrelacorporativas_v','subtotnetogestora','subtotnetogestora_v',
        'subtotnetoaejecutar','subtotnetoaejecutar_v','subtotoperaejecutar','subtotoperaejecutar_p','total','total_p'
    ];
}
