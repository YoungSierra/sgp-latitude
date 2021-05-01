@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('projects.show'))

@section('content')
    <div class="row justify-content-center">

        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header p-3">
                    <i class="fas fa-edit"></i> Información detallada del proyecto
                </div>
                <div class="row">
                    <div class="col-5" id="chartContainer1" style="height: 300px; width: 50%;"></div>
                    <div class="col-6" id="chartContainer2" style="height: 300px; width: 50%;"></div>
                </div> 
                <hr>
                <div class="card-body">
                	<table class="table table-condensed table-sm mb-0 shadow-sm">
						<tbody class="mb-0">
							<tr class="col border-bottom">
                                <td colspan='2'>
                                    <div class="small text-muted d-none d-md-block">Nombre</div>
                                    <div class="h5 text-left">{{ $project->name }}</div>
                                </td>
                                <td>
                                    <div class="small text-muted d-none d-md-block">Tiempo</div>
                                    <div class="h5 text-left">{{ $project->tiempo }}</div>
                                </td>
                                <td>
                                    <div class="small text-muted d-none d-md-block">Estado</div>
                                    <div class="h5 text-left">
                                    	@if ($project->status == 1)
											<span class="badge badge-success">Activo</span>
										@else
											<span class="badge badge-danger">Inactivo</span>
										@endif
                                    </div>
                                </td>
                                <td>
                                    <div class="small text-muted d-none d-md-block">Creado</div>
                                    <div class="h6 text-left">
                                    	<span class="badge badge-secondary">{{ $project->created_at }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="small text-muted d-none d-md-block">Actualizado</div>
                                    <div class="h6 text-left">
                                    	<span class="badge badge-info">{{ $project->updated_at }}</span>
                                    </div>
                                </td>
                                <td></td>

                            </tr>
                            <tr class="col border-bottom">
                                <td colspan='4'>
                                    <div class="small text-muted d-none d-md-block">Descripción</div>
                                    <div class="h5 text-left">{{ $project->description }}</div>
                                </td>
                                <td>
                                    <div class="small text-muted d-none d-md-block">Valor contrato $</div>
                                    <div class="h5 text-left">{{$project->valor}}</div>
                                </td>          
                                <td >
                                    <div class="small text-muted d-none d-md-block">VALOR BRUTO $</div>
                                    <div class="h5 text-left">{{number_format($project->valorbruto,0)}}</div>
                                </td>
                                <td></td>

                            </tr>

                            <tr class="col border-bottom">
                                <td >
                                    <div class="small text-muted d-none d-md-block">IVA %</div>
                                    <div class="h5 text-left">{{ $project->iva }} %</div>
                                </td>
                                <td >
                                    <div class="small text-muted d-none d-md-block">IVA $</div>
                                    <div class="h5 text-left">{{ $project->iva_v }}</div>
                                </td>
                                <td >
                                    <div class="small text-muted d-none d-md-block">RTEFUENTE %</div>
                                    <div class="h5 text-left">{{ $project->retfuente }} %</div>
                                </td>
                                <td >
                                    <div class="small text-muted d-none d-md-block">RTEFUENTE $</div>
                                    <div class="h5 text-left">{{$project->retfuente_v}}</div>
                                </td>
                                <td >
                                    <div class="small text-muted d-none d-md-block">ICA % </div>
                                    <div class="h5 text-left">{{ $project->ica }} %</div>
                                </td>
                                <td >
                                    <div class="small text-muted d-none d-md-block">ICA $</div>
                                    <div class="h5 text-left">{{ $project->ica_v }}</div>
                                </td>
                                <td></td>
                            </tr>

                            <tr class="col border-bottom">
                                <td>
                                    <div class="small text-muted d-none d-md-block">RTE IVA % </div>
                                    <div class="h5 text-left">{{ $project->retiva }} %</div>
                                </td>
                                <td>
                                    <div class="small text-muted d-none d-md-block">RTE IVA $</div>
                                    <div class="h5 text-left">{{ $project->retiva_v }}</div>
                                </td>
                                <td>
                                    <div class="small text-muted d-none d-md-block">ESTAMPILLAS %</div>
                                    <div class="h5 text-left">{{$project->estampillas}} %</div>
                                </td>
                                <td>
                                    <div class="small text-muted d-none d-md-block">ESTAMPILLAS $</div>
                                    <div class="h5 text-left">{{$project->estampillas_v}}</div>
                                </td>
                                <td>
                                    <div class="small text-muted d-none d-md-block">CREE % </div>
                                    <div class="h5 text-left">{{ $project->cree }} %</div>
                                </td>
                                <td>
                                    <div class="small text-muted d-none d-md-block">CREE $ </div>
                                    <div class="h5 text-left">{{ $project->cree_v }}</div>
                                </td>
                                <td></td>
                            </tr>

                            <tr class="col border-bottom">
                                <td>
                                    <div class="small text-muted d-none d-md-block">ICA</div>
                                    <div class="h5 text-left">{{ $project->ica_t }} %</div>
                                </td>
                                <td>
                                    <div class="small text-muted d-none d-md-block">ICA $</div>
                                    <div class="h5 text-left">{{$project->ica_tv}}</div>
                                </td>
                                <td>
                                    <div class="small text-muted d-none d-md-block">RET ICA %</div>
                                    <div class="h5 text-left">{{$project->retica}}</div>
                                </td>
                                <td>
                                    <div class="small text-muted d-none d-md-block">RET ICA $ </div>
                                    <div class="h5 text-left">{{ $project->retica_v }}</div>
                                </td>
                                <td>
                                    <div class="small text-muted d-none d-md-block">NETO A PAGAR $ </div>
                                    <div class="h5 text-left">{{ $project->netopagar }}</div>
                                </td>
                                <td>
                                    <div class="small text-muted d-none d-md-block">TOTAL IMPUESTOS $</div>
                                    <div class="h5 text-left">{{ $project->totimpuesto }}</div>
                                </td>
                                <td></td>
                            </tr>

                            <tr class="col border-bottom">
                                <td>
                                    <div class="small text-muted d-none d-md-block">NETO $</div>
                                    <div class="h5 text-left">{{$project->neto}}</div>
                                </td>
                                <td>
                                    <div class="small text-muted d-none d-md-block">VALOR BRUTO DEL CONTRATO $</div>
                                    <div class="h5 text-left">{{$project->valorbruto_c}}</div>
                                </td>
                                <td>
                                    <div class="small text-muted d-none d-md-block">IMPUESTOS $ </div>
                                    <div class="h5 text-left">{{ $project->impuestos }}</div>
                                </td>
                                <td colspan="4">
                                </td>
                            </tr>

                            <tr class="">
                                <td colspan='7'>
                                    <div class="small text-muted d-none d-md-block">PÓLIZAS $</div>
                                    <div class="h5 text-left">{{$project->totpolizas}}</div>
                                </td>
                            </tr>

                            @foreach ($projectpolizas as $key => $value)
                                <tr>
                                    <td>* {{$value->name}}</td>
                                    <td>{{number_format($value->valor,0) }}</td>
                                    <td colspan="5"></td>
                                </tr>
                                           
                             @endforeach

                             <tr class="">
                                <td colspan='7'>
                                    <div class="small text-muted d-none d-md-block">CONTRATISTAS $</div>
                                    <div class="h5 text-left">{{$project->totcontratistas}}</div>
                                </td>
                            </tr>

                            @foreach ($projectcontratistas as $key => $value)
                                <tr>
                                    <td>* {{$value->name}}</td>
                                    <td>{{number_format($value->valor,0) }}</td>
                                    <td colspan="5"></td>
                                </tr>                  
                             @endforeach

                             <tr class="col border-bottom">
                                <td >
                                    <div class="small text-muted d-none d-md-block">SUBTOTAL $</div>
                                    <div class="h5 text-left">{{$project->subtotal}}</div>
                                </td>
                                <td >
                                    <div class="small text-muted d-none d-md-block">COMISION COMERCIAL REFERIDO $</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->comisionreferido}} %</span>  
                                    {{$project->comisionreferido_v}}</div>
                                </td>
                                <td >
                                    <div class="small text-muted d-none d-md-block">MARCA $</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->imprevistos}} %</span>  
                                    {{$project->imprevistos_v}}</div>
                                </td>
                                <td >
                                    <div class="small text-muted d-none d-md-block">APALANCAMIENTO $</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->apalancamiento}} %</span>  
                                    {{$project->apalancamiento_v}}</div>
                                </td>
                                <td >
                                    <div class="small text-muted d-none d-md-block">OBLIGACIONES FINANCIERAS $</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->obligafinancieras}} %</span>  
                                    {{$project->obligafinancieras_v}}</div>
                                </td>
                                <td >
                                    <div class="small text-muted d-none d-md-block">RSE $</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->rse}} %</span>  
                                    {{$project->rse_v}}</div>
                                </td>
                                <td colspan="1"></td>
                            </tr>     

                            <tr class="col border-bottom">
                                <td colspan=''>
                                    <div class="small text-muted d-none d-md-block">NETO OPERACIONAL $</div>
                                    <div class="h5 text-left">{{$project->costosexternos}}</div>
                                </td>
                                <td colspan=''>
                                    <div class="small text-muted d-none d-md-block">REINVERSION - IMPREVISTO $</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->arqejecutivofirma}} %</span>  
                                    {{$project->arqejecutivofirma_v}}</div>
                                </td>                               
                                <td colspan=''>
                                    <div class="small text-muted d-none d-md-block">NOMINA FIJA $</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->nominafija}} %</span>  
                                    {{$project->nominafija_v}}</div>
                                </td>
                                <td colspan=''>
                                    <div class="small text-muted d-none d-md-block">CONTRATISTA LATTITUDE $</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->contratistalattitude}} %</span>  
                                    {{$project->contratistalattitude_v}}</div>
                                </td>
                                <td colspan='3'>
                                    <div class="small text-muted d-none d-md-block">SUBTOTAL COSTOS FIJOS $</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->subtotcostosfijos}}</span>  
                                    {{$project->subtotcostosfijos_v}}</div>
                                </td>
                                <td colspan="1"></td>
                            </tr>                             
                            <tr class="col border-bottom">
                                <td colspan=''>
                                    <div class="small text-muted d-none d-md-block">COSTOS FIJOS PLATAFORMA 401</div>
                                </td>
                                <!--
                                <td colspan=''>
                                    <div class="small text-muted d-none d-md-block">MARCA LATTITUDE $</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->marcalattitude}} %</span>  
                                    {{$project->marcalattitude_v}}</div>
                                </td>
                                -->
                                <td colspan=''>
                                    <div class="small text-muted d-none d-md-block">EQUIPOS, REDES, TECNOLOGIA $</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->tecnologia}} %</span>  
                                    {{$project->tecnologia_v}}</div>
                                </td>
                                <td colspan=''>
                                    <div class="small text-muted d-none d-md-block">SERVICIOS PUBLICOS Y ADMINISTRACION $</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->serviciospublicos}} %</span>  
                                    {{$project->serviciospublicos_v}}</div>
                                </td>
                                <td colspan='2'>
                                    <div class="small text-muted d-none d-md-block">SUBTOTAL COSTOS PLATAFORMA 401 $</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->subtotcostosplataforma}}</span>  
                                    {{$project->subtotcostosplataforma_v}}</div>
                                </td>
                                <td colspan="1"></td>
                            </tr>                             
                            <tr class="col border-bottom">
                                <td colspan=''>
                                    <div class="small text-muted d-none d-md-block">RELACIONES CORPORATIVAS</div>
                                </td>
                                <td colspan=''>
                                    <div class="small text-muted d-none d-md-block">RECURSOS HUMANOS $</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->recursoshumanos}} %</span>  
                                    {{$project->recursoshumanos_v}}</div>
                                </td>
                                <td colspan=''>
                                    <div class="small text-muted d-none d-md-block">PR Y VIATICOS $</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->pryviaticos}} %</span>  
                                    {{$project->pryviaticos_v}}</div>
                                </td>
                                <td colspan=''>
                                    <div class="small text-muted d-none d-md-block">COMUNICACIONES $</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->comunicaciones}} %</span>  
                                    {{$project->comunicaciones_v}}</div>
                                </td>
                                <td colspan='2'>
                                    <div class="small text-muted d-none d-md-block">SUBTOTAL RELACIONES CORPORATIVAS $</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->subtotrelacorporativas}}</span>  
                                    {{$project->subtotrelacorporativas_v}}</div>
                                </td>
                                <td colspan="1"></td>
                            </tr> 

                            <tr class="col border-bottom">
                                <td colspan='7'>
                                    <div class="small text-muted d-none d-md-block">SUBTOTAL NETO GESTORA</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->subtotnetogestora}}</span>  
                                    {{$project->subtotnetogestora_v}}</div>
                              </td>
                            </tr>  

                            <tr class="col border-bottom">
                                <td colspan=''>
                                    <div class="small text-muted d-none d-md-block">NETO OPERACIONAL A EJECUTAR</div>
                               </td>
                               <td colspan=''>
                                    <div class="small text-muted d-none d-md-block">SUBTOTAL NETO A EJECUTAR</div>
                                    <div class="h5 text-right"><span class="badge badge-secondary">{{$project->subtotnetoaejecutar}}</span>  
                                    {{$project->subtotnetoaejecutar_v}}</div>
                               </td>
                               <td colspan="5"></td>
                            </tr> 
                            <tr>
                                <td width='15%'><div class="medium text-muted d-none d-md-block text-center">Asociado</div></td>
                                <td width='15%'><div class="medium text-muted d-none d-md-block text-center">Participación</div></td>
                                <td width='15%'><div class="medium text-muted d-none d-md-block text-center" >Fase 1</div></td>
                                <td width='15%'><div class="medium text-muted d-none d-md-block text-center" >Fase 2</div></td>
                                <td width='15%'><div class="medium text-muted d-none d-md-block text-center" >Fase 3</div></td>
                                <td width='10%'><div class="medium text-muted d-none d-md-block text-center" >Tot Fases %</div></td>
                                <td width='15%'><div class="medium text-muted d-none d-md-block text-center" >P Final</div></td>
                            </tr>                  
    
                            @foreach ($projectasociados as $key => $value)
                                @if($value->first_name != "")
                                <tr>
                                    <td><div class="h6 text-left">{{$value->first_name}} {{$value->last_name}}</div></td>
                                    <td><div class="h6 text-right">
                                        <span class="badge badge-secondary" style="font-size: 12px;">{{$value->porcentaje}}%</span> ${{$value->valor}}</div></td>
                                    <td><div class="h6 text-center">
                                        @if($value->fase1ok==1) 
                                        <span class="badge badge-success" style="font-size: 14px;">{{$value->fase1}}%</span>
                                        @else
                                        <span >{{$value->fase1}}%</span>
                                        @endif
                                    </div></td>
                                    <td><div class="h6 text-center">
                                        @if($value->fase2ok==1) 
                                        <span class="badge badge-success" style="font-size: 14px;">{{$value->fase2}}%</span>
                                        @else
                                        <span >{{$value->fase2}}%</span>
                                        @endif
                                    </div></td>
                                    <td><div class="h6 text-center">
                                        @if($value->fase3ok==1) 
                                        <span class="badge badge-success" style="font-size: 14px;">{{$value->fase3}}%</span>
                                        @else
                                        <span >{{$value->fase3}}%</span>
                                        @endif
                                    </div></td>
                                    <td><div class="h6 text-center">
                                        @if($value->fase1ok==1 || $value->fase2ok==1 || $value->fase3ok==1 ) 
                                        <span class="badge badge-success" style="font-size: 14px;">{{$value->totfases}}</span>
                                        @else
                                        <span >{{$value->totfases}}</span>
                                        @endif
                                    </div></td>

                                    <td><div class="h6 text-right">
                                        @if($value->fase1ok==1 || $value->fase2ok==1 || $value->fase3ok==1 )
                                        <span class="badge badge-success" style="font-size: 12px;">{{$value->partfinal_p}}</span>
                                        ${{$value->partfinal}}
                                        @else
                                        <span class="badge badge-secondary" style="font-size: 12px;">{{$value->partfinal_p}}</span> 
                                        ${{$value->partfinal}}
                                        @endif
                                    </div></td>

                                </tr>     
                                @endif          
                                @if($value->first_name == "")
                                <tr>
                                    <td><div class="h6 text-left">BOLSA REMANENTE</div></td>
                                    <td><div class="h6 text-right"><span class="badge badge-secondary" style="font-size: 12px;">{{$value->porcentaje}}%</span> ${{$value->valor}}</div></td>
                                    <td><div class="h6 text-center"></div></td>
                                    <td><div class="h6 text-center"></div></td>
                                    <td><div class="h6 text-center"></div></td>
                                    <td><div class="h6 text-center"></div></td>
                                    <td><div class="h6 text-right"><span class="badge badge-success"style="font-size: 12px;">{{$value->partfinal_p}}</span> ${{$value->partfinal}}</div></td>
                                </tr>     
                                @endif          
                             @endforeach                                                    
                             <tr class="col border-bottom">
                                <td colspan='1'></td>
                                <td>
                                    <div class="small text-muted d-none d-md-block text-left">SUBTOTAL OPERACIONAL A EJECUTAR</div>
                                    <div class="h5 text-right"><span class="badge badge-secondary">{{$project->subtotoperaejecutar_p}}</span>  
                                    {{$project->subtotoperaejecutar}}</div>
                               </td><td></td>
                               <td colspan=''>
                                    <div class="small text-muted d-none d-md-block">TOTAL</div>
                                    <div class="h5 text-left"><span class="badge badge-secondary">{{$project->total_p}}</span>  
                                    {{$project->total}}</div>
                               </td>
                               <td colspan="3"></td>
                            </tr> 
                            
						</tbody>
					</table>
                </div>
                <hr>

                <div class="row">
                    <div class="col-5" id="chartContainer3" style="height: 300px; width: 50%;"></div>
                    <div class="col-6" id="chartContainer4" style="height: 300px; width: 50%;"></div>
                </div> 

            </div>

            <div class="row">
                    <div class="col-2">
                        <a role="button"
                            class="btn btn-secondary btn-block"
                            href="{{ route('projects.index') }}">
                            <i class="fas fa-undo-alt"></i> Regresar
                        </a>
                    </div>
            </div>

        </div>
    </div>
@endsection