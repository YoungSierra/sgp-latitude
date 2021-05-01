<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Associate;
use App\Models\Contractor;
use App\Models\Policy;
use App\Models\Tax;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\ProjectEditRequest;
use App\Models\ProjectPolicie;
use App\Models\ProjectContractor;
use App\Models\ProjectAssociate;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @param  int  $id
     */
    public function index()
    {        
        $aso_id = Auth::user()->associate_id;
        if ($aso_id == null){
            return view('projects.index')->with('projects', Project::Paginate(10));
        }else{
            $asoc = DB::table('project_associates') 
            ->where('idassociate','=', $aso_id)
            ->join('projects', 'projects.id', '=', 'project_associates.idproject')
            ->select('projects.name','projects.costosexternos',
                     'project_associates.porcentaje','project_associates.valor',
                     'project_associates.fase1','project_associates.fase2','project_associates.fase3',
                     'project_associates.fase1ok','project_associates.fase2ok','project_associates.fase3ok',
                     'project_associates.totfases','project_associates.partfinal_p','project_associates.partfinal')
            ->get();
    
            return view('projects.index') ->with('projects', $asoc);
    
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create')
        ->with('states', $this->get_states())
        ->with('polizas',  Policy::Paginate(0))
        ->with('contratistas',  Contractor::Paginate(0))
        ->with('asociados',  Associate::Paginate(0));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProjectRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {

        $project = new Project;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->valor = $request->valor;
        $project->tiempo = $request->tiempo;
        $project->status = $request->status;
        $project->valorbruto = $request->valorbruto;
        $project->iva = $request->iva;
        $project->iva_v = $request->iva_v;
        $project->retfuente = $request->retfuente;
        $project->retfuente_v = $request->retfuente_v;
        $project->ica = $request->ica;
        $project->ica_v = $request->ica_v;
        $project->retiva = $request->retiva;
        $project->retiva_v = $request->retiva_v;
        $project->estampillas = $request->estampillas;
        $project->estampillas_v = $request->estampillas_v;
        $project->cree = $request->cree;
        $project->cree_v = $request->cree_v;
        $project->ica_t = $request->ica_t;
        $project->ica_tv = $request->ica_tv;
        $project->retica = $request->retica;
        $project->retica_v = $request->retica_v;
        $project->netopagar = $request->netopagar;
        $project->totimpuesto = $request->totimpuesto;
        $project->neto = $request->neto;
        $project->valorbruto_c = $request->valorbruto_c;
        $project->impuestos = $request->impuestos ;
        $project->totpolizas = $request->totpolizas ;
        $project->totcontratistas = $request->totcontratistas ;
        $project->subtotal = $request->subtotal ;
        $project->comisionreferido = $request->comisionreferido ;
        $project->comisionreferido_v = $request->comisionreferido_v ;
        $project->imprevistos = $request->imprevistos ;
        $project->imprevistos_v = $request->imprevistos_v ;
        $project->apalancamiento = $request->apalancamiento ;
        $project->apalancamiento_v = $request->apalancamiento_v ;
        $project->obligafinancieras = $request->obligafinancieras ;
        $project->obligafinancieras_v = $request->obligafinancieras_v ;
        $project->rse = $request->rse ;
        $project->rse_v = $request->rse_v ;
        $project->costosexternos = $request->costosexternos ;
        $project->nominafija = $request->nominafija ;
        $project->nominafija_v = $request->nominafija_v ;
        $project->contratistalattitude = $request->contratistalattitude ;
        $project->contratistalattitude_v = $request->contratistalattitude_v ;
        $project->arqejecutivofirma = $request->arqejecutivofirma ;
        $project->arqejecutivofirma_v = $request->arqejecutivofirma_v ;
        $project->subtotcostosfijos = $request->subtotcostosfijos ;
        $project->subtotcostosfijos_v = $request->subtotcostosfijos_v ;
        $project->marcalattitude = 0 ; //$request->marcalattitude ;
        $project->marcalattitude_v = 0 ; //$request->marcalattitude_v ;
        $project->tecnologia = $request->tecnologia ;
        $project->tecnologia_v = $request->tecnologia_v ;
        $project->serviciospublicos = $request->serviciospublicos ;
        $project->serviciospublicos_v = $request->serviciospublicos_v ;
        $project->subtotcostosplataforma = $request->subtotcostosplataforma ;
        $project->subtotcostosplataforma_v = $request->subtotcostosplataforma_v ;
        $project->recursoshumanos = $request->recursoshumanos ;
        $project->recursoshumanos_v = $request->recursoshumanos_v ;
        $project->pryviaticos = $request->pryviaticos ;
        $project->pryviaticos_v = $request->pryviaticos_v ;
        $project->comunicaciones = $request->comunicaciones ;
        $project->comunicaciones_v = $request->comunicaciones_v ;
        $project->subtotrelacorporativas = $request->subtotrelacorporativas ;
        $project->subtotrelacorporativas_v = $request->subtotrelacorporativas_v ;
        $project->subtotnetogestora = $request->subtotnetogestora ;
        $project->subtotnetogestora_v = $request->subtotnetogestora_v ;
        $project->subtotnetoaejecutar = $request->subtotnetoaejecutar ;
        $project->subtotnetoaejecutar_v = $request->subtotnetoaejecutar_v ;
        $project->subtotoperaejecutar = $request->subtotoperaejecutar ;
        $project->subtotoperaejecutar_p = $request->subtotoperaejecutar_p ;
        $project->total = $request->total ;
        $project->total_p = $request->total_p ;


        $project->save();

        $maxid = DB::table('projects')->max('id');

        for ($i = 0; $i <= 19; $i++) {
            //seccion polizas
            $pol_s = "sel_poliza_".$i;
            $pol_v = "poliza_v_".$i;
            if(isset($request->$pol_s) && $request->$pol_v > 0){
                $projectpolicie = new ProjectPolicie;
                $projectpolicie->idproject = $maxid;
                $projectpolicie->idpolicie = $request->$pol_s;
                $projectpolicie->valor = $request->$pol_v;
                $projectpolicie->save();
            }

            //seccion  contratistas
            $cont_s = "sel_contratista_".$i;
            $cont_v = "contratista_v_".$i;
            if(isset($request->$cont_s) && $request->$cont_v > 0){
                $projectcontractor = new ProjectContractor;
                $projectcontractor->idproject = $maxid;
                $projectcontractor->idcontractor = $request->$cont_s;
                $projectcontractor->valor = $request->$cont_v;
                $projectcontractor->save();
            }

            //seccion  asociados
            $idassociate = "sel_asociado_".$i;
            $valor = "asociado_v_".$i;
            $porcentaje = "asociado_".$i;
            $fase1 = "fase1_".$i;
            $fase2 = "fase2_".$i;
            $fase3 = "fase3_".$i;
            if(isset($request->$idassociate) && $request->$porcentaje > 0){
                $projectassociate = new ProjectAssociate;
                $projectassociate->idproject = $maxid;
                $projectassociate->idassociate = $request->$idassociate;
                $projectassociate->valor = $request->$valor;
                $projectassociate->porcentaje = $request->$porcentaje;
                $projectassociate->fase1 = $request->$fase1;
                $projectassociate->fase2 = $request->$fase2;
                $projectassociate->fase3 = $request->$fase3;
                $projectassociate->save();
            }           
        }
        //seccion  bolsa remanente
        if(isset($request->bolsaremanente)){
            $bolsaremanente_p = str_replace ("%","", $request->bolsaremanente_p);
            $bolsaremanente_p = str_replace (",",".", $bolsaremanente_p);
            $projectassociate = new ProjectAssociate;
            $projectassociate->idproject = $maxid;
            $projectassociate->idassociate = 999;
            $projectassociate->valor = $request->bolsaremanente;
            $projectassociate->porcentaje = $bolsaremanente_p;
            $projectassociate->fase1 = 0;
            $projectassociate->fase2 = 0;
            $projectassociate->fase3 = 0;
            $projectassociate->save();
        }
        


        return redirect('projects/create')->with('message', 'Proyecto creado satisfactoriamente !');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
   
        $p = Project::findOrFail($id);
        $dataPoints1 = array( 
            array("label"=>"NOMINA FIJA", "y"=> $p->nominafija),
            array("label"=>"CONTRATISTAS LATTITUDE", "y"=> $p->contratistalattitude),
            array("label"=>"MARCA - ARRIENDO ", "y"=>$p->arqejecutivofirma),
            array("label"=>"TECNOLOGIA", "y"=>$p->tecnologia),
            array("label"=>"SERVICIOS PUBLICOS", "y"=>$p->serviciospublicos),
            array("label"=>"RECURSOS HUMANOS", "y"=>$p->recursoshumanos),
            array("label"=>"PR Y VIATICOS", "y"=>$p->pryviaticos),
            array("label"=>"COMUNICACIONES", "y"=>$p->comunicaciones)
        );
        
        $marcalattitude_v = str_replace(".",'',$p->marcalattitude_v);
        $tecnologia_v = str_replace(".",'',$p->tecnologia_v);
        $serviciospublicos_v = str_replace(".",'',$p->serviciospublicos_v);
        $subtotcostosfijos_v = str_replace(".",'',$p->subtotcostosfijos_v);
        $dataPoints2 = array( 
            array("label"=>"TECNOLOGIA", "y"=>$tecnologia_v),
            array("label"=>"SERVICIOS PUBLICOS", "y"=>$serviciospublicos_v),
            array("label"=>"SUBTOTAL COSTOS PLATAFORMA", "y"=>$subtotcostosfijos_v)
        );

        $asoc = DB::table('project_associates') 
                ->where('idproject','=',$id)
                ->leftjoin('associates', 'associates.id', '=', 'project_associates.idassociate')
                ->select('associates.first_name','associates.last_name','project_associates.valor',
                         'project_associates.porcentaje','fase1','fase2','fase3','fase1ok','fase2ok','fase3ok',
                         'project_associates.totfases','project_associates.partfinal_p','project_associates.partfinal')                         
                ->get();
        
        $dataPoints3 = array();
        foreach ($asoc as $a){
            //$valor = str_replace(".",'',$a->valor);
            if ($a->first_name == null){ $nomasociado = 'BOLSA REMANENTE';}
            if ($a->first_name != null){ $nomasociado = $a->first_name .' '. $a->last_name;}
            
            array_push($dataPoints3, array("label"=>$nomasociado, "y"=> $a->porcentaje));
        }

       // array_push($dataPoints3, array("label"=>"CLAUDIA", "y"=> $p->nominafija));
       // array_push($dataPoints3, array("label"=>"NOMINA", "y"=> $p->nominafija));

        

        
        $recursoshumanos_v = str_replace(".",'',$p->recursoshumanos_v);
        $pryviaticos_v = str_replace(".",'',$p->pryviaticos_v);
        $comunicaciones_v = str_replace(".",'',$p->comunicaciones_v);
        $subtotrelacorporativas_v = str_replace(".",'',$p->subtotrelacorporativas_v);
        $dataPoints4 = array( 
            array("label"=>"RECURSOS HUMANOS", "y"=>$recursoshumanos_v),
            array("label"=>"PR Y VIATICOS", "y"=>$pryviaticos_v),
            array("label"=>"COMUNICACIONES", "y"=>$comunicaciones_v),
            array("label"=>"SUBTOTAL RELACIONES CORP", "y"=>$subtotrelacorporativas_v)
        );


        return view('projects.show')
        ->with('project', Project::findOrFail($id))
        ->with('projectpolizas', DB::table('project_policies')
                                 ->where('idproject','=',$id)
                                 ->join('policies', 'policies.id', '=', 'project_policies.idpolicie')
                                 ->select('policies.name', 'project_policies.valor')
                                 ->get())
        ->with('projectcontratistas', DB::table('project_contractors') 
                                 ->where('idproject','=',$id)
                                 ->join('contractors', 'contractors.id', '=', 'project_contractors.idcontractor')
                                 ->select('contractors.name', 'project_contractors.valor')
                                 ->get())
        ->with('projectasociados', DB::table('project_associates') 
                                 ->where('idproject','=',$id)
                                 ->leftJoin('associates', 'associates.id', '=', 'project_associates.idassociate')
                                 ->select('associates.first_name','associates.last_name', 
                                 'project_associates.valor','project_associates.porcentaje',
                                 'fase1','fase2','fase3','fase1ok','fase2ok','fase3ok','totfases','partfinal_p','partfinal')
                                ->get())
        ->with('dataPoints1',$dataPoints1)  
        ->with('dataPoints2',$dataPoints2)   
        ->with('dataPoints3',$dataPoints3)   
        ->with('dataPoints4',$dataPoints4);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('projects.edit')
        ->with('project', Project::findOrFail($id))
        ->with('states', $this->get_states())
        ->with('polizas',  Policy::Paginate(0))
        ->with('contratistas',  Contractor::Paginate(0))
        ->with('asociados',  Associate::Paginate(0))
        ->with('projectpolizas', DB::table('project_policies')
                                 ->where('idproject','=',$id)
                                 ->join('policies', 'policies.id', '=', 'project_policies.idpolicie')
                                 ->select('project_policies.idpolicie','policies.name', 'project_policies.valor')
                                 ->get())
        ->with('projectcontratistas', DB::table('project_contractors') 
                                 ->where('idproject','=',$id)
                                 ->join('contractors', 'contractors.id', '=', 'project_contractors.idcontractor')
                                 ->select('project_contractors.idcontractor','contractors.name', 'project_contractors.valor')
                                 ->get())
        ->with('projectasociados', DB::table('project_associates') 
                                 ->where('idproject','=',$id)
                                 ->leftJoin('associates', 'associates.id', '=', 'project_associates.idassociate')
                                 ->select('project_associates.idassociate','associates.first_name','associates.last_name', 
                                 'project_associates.valor','project_associates.porcentaje','project_associates.fase1','project_associates.fase2','project_associates.fase3',
                                 'project_associates.fase1ok','project_associates.fase2ok','project_associates.fase3ok',
                                 'project_associates.totfases','project_associates.partfinal_p','project_associates.partfinal')
                                ->get());


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProjectEditRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectEditRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());

        DB::table('project_policies')->where('idproject', '=', $id)->delete();
        DB::table('project_contractors')->where('idproject', '=', $id)->delete();
        DB::table('project_associates')->where('idproject', '=', $id)->delete();


        for ($i = 0; $i <= 19; $i++) {
            //seccion polizas
            $pol_s = "sel_poliza_".$i;
            $pol_v = "poliza_v_".$i;
            if(isset($request->$pol_s) && $request->$pol_v > 0){
                $projectpolicie = new ProjectPolicie;
                $projectpolicie->idproject = $id;
                $projectpolicie->idpolicie = $request->$pol_s;
                $projectpolicie->valor = $request->$pol_v;
                $projectpolicie->save();
            }

            //seccion  contratistas
            $cont_s = "sel_contratista_".$i;
            $cont_v = "contratista_v_".$i;
            if(isset($request->$cont_s) && $request->$cont_v > 0){
                $projectcontractor = new ProjectContractor;
                $projectcontractor->idproject = $id;
                $projectcontractor->idcontractor = $request->$cont_s;
                $projectcontractor->valor = $request->$cont_v;
                $projectcontractor->save();
            }

            //seccion  asociados
            $idassociate = "sel_asociado_".$i;
            $valor = "asociado_v_".$i;
            $porcentaje = "asociado_".$i;
            $fase1 = "fase1_".$i;
            $fase1ok = "fase1ok_".$i;
            $fase2 = "fase2_".$i;
            $fase2ok = "fase2ok_".$i;
            $fase3 = "fase3_".$i;
            $fase3ok = "fase3ok_".$i;
            $totfases = "totfases_".$i;
            $partfinal_p = "partfinal_p_".$i;
            $partfinal = "partfinal_".$i;
            if(isset($request->$idassociate) && $request->$porcentaje > 0){
                $projectassociate = new ProjectAssociate;
                $projectassociate->idproject = $id;
                $projectassociate->idassociate = $request->$idassociate;
                $projectassociate->valor = $request->$valor;
                $projectassociate->porcentaje = $request->$porcentaje;
                $projectassociate->fase1 = $request->$fase1;
                $projectassociate->fase1ok = $request->$fase1ok;
                $projectassociate->fase2 = $request->$fase2;
                $projectassociate->fase2ok = $request->$fase2ok;
                $projectassociate->fase3 = $request->$fase3;
                $projectassociate->fase3ok = $request->$fase3ok;
                $projectassociate->totfases = $request->$totfases;
                $projectassociate->partfinal_p = $request->$partfinal_p;
                $projectassociate->partfinal = $request->$partfinal;
                $projectassociate->save();
            }           
        }
        //seccion  bolsa remanente
        if(isset($request->bolsaremanente)){
            $bolsaremanente_p = str_replace ("%","", $request->bolsaremanente_p);
            $bolsaremanente_p = str_replace (",",".", $bolsaremanente_p);
            $projectassociate = new ProjectAssociate;
            $projectassociate->idproject = $id;
            $projectassociate->idassociate = 999;
            $projectassociate->valor = $request->bolsaremanente;
            $projectassociate->porcentaje = $bolsaremanente_p;
            $projectassociate->fase1 = 0;
            $projectassociate->fase1ok = 0;
            $projectassociate->fase2 = 0;
            $projectassociate->fase2ok = 0;
            $projectassociate->fase3 = 0;
            $projectassociate->fase3ok = 0;
            $projectassociate->totfases = 0;
            $projectassociate->partfinal_p = $request->partfinal_p_999;
            $projectassociate->partfinal = $request->partfinal_999;

            $projectassociate->save();
        }


        return redirect()->route('projects.edit' , $project)
                ->with('message', 'Proyecto actualizado satisfactoriamente !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        DB::table('project_policies')->where('idproject', '=', $id)->delete();
        DB::table('project_contractors')->where('idproject', '=', $id)->delete();
        DB::table('project_associates')->where('idproject', '=', $id)->delete();

        return redirect()->route('projects.index' ) ->with('message', 'Proyecto eliminado satisfactoriamente !');

    }


}
