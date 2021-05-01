@extends('layouts.app')

@if(Auth::user()->hasRole('superadministrador') || Auth::user()->hasRole('administrador')  )
@section('breadcrumbs', Breadcrumbs::render('projects.index'))

@section('content')
    <div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header px-3 py-2">
					<div class="row">
						<div class="col-lg-9">
							<h2 class="mb-0">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-check" viewBox="0 0 16 16">
								<path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z"/>
					            </svg> Proyectos
							</h2>
						</div>
						<div class="col-lg-2">
							@if (auth()->user()->can('add_project'))
								<a class="btn btn-success btn-block" role="button" href="{{ route('projects.create') }}">
									<i class="fas fa-plus-circle"></i> Nuevo
								</a>
							@endif
						</div>
						
						<div class="col">
							@if ($projects->count() > 0)
							<button style="float:left;" class="btn btn-secondary btn-block" onclick="exportTableToExcel('tblData', 'datosproyectos')"><i class="fas fa-file-excel"></i> Excel</button>
							@endif
						</div>	
						
					</div>
				</div>
				<div class="row">
					<div class="col">
						@if (session('message'))
							<div class="alert alert-success" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<i class="fas fa-times-circle"></i>
								</button>
								{{ session('message') }}
							</div>
						@endif
					</div>
				</div>

				<div class="card-body p-0">
					<table class="table table-striped table-bordered table-condensed table-hover table-sm mb-0" id="tblData">
						<thead>
							<tr class="text-center text-white bg-secondary">
								<th>Nombre</th>
								<th>Valor contrato</th>
								<th>Tiempo</th>
								<th>Estado</th>
								<th>Creado</th>
								<th>Actualizado</th>
								<th width="120px">Acción</th>
							</tr>
						</thead>
						<tbody class="mb-0">
							@foreach ($projects as $project)
								<tr class="text-center">
									<td>{{ $project->name }}</td>
									<td>$ {{$project->valor}}</td>
									<td>{{ $project->tiempo }}</td>
									@if ($project->status == '1')
										<td><span class="badge badge-success">Activo</span></td>
									@else
										<td><span class="badge badge-danger">Inactivo</span></td>
									@endif
									<td><span class="badge badge-primary">{{ $project->created_at }}</span></td>
									<td><span class="badge badge-info">{{ $project->updated_at }}</span></td>
									<td>
										<div class="btn-group btn-group-sm" role="group" aria-label="actions-policies">
											<div class="btn-group btn-group-sm" role="group" aria-label="actions-policies">
												@if (auth()->user()->can('show_project'))
													<a
														rol="button"
														class="btn btn-outline-info rounded-0"
														href="{{ route('projects.show' , $project->id ) }}"
													>
														<i class="fas fa-eye"></i>
													</a>
												@endif
												@if (auth()->user()->can('edit_project'))
													<a
														rol="button"
														class="btn btn-outline-success rounded-0"
														href="{{ route('projects.edit' , $project->id ) }}"
													>
														<i class="fas fa-edit"></i>
													</a>
												@endif
												@if (auth()->user()->can('delete_project'))
													<form id="delete_{{$project->id}}"
														method="post"
														action="{{ route('projects.destroy' , $project->id ) }}"
													>
								                    	@csrf
								                    	@method('DELETE')
								                    	<button
								                    		type="button" onclick="validarDelProject({{$project->id}});"
								                    		class="btn btn-sm btn-outline-danger rounded-0"	>
								                    		<i class="far fa-trash-alt"></i>
								                    	</button>
								                  	</form>
												@endif
											</div>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
@endif

@role('asociado')
@section('breadcrumbs', Breadcrumbs::render('projects.index' )) 

@section('content')
    <div class="row">
		<div class="col">
			<div class="card">

				<div class="card-header px-3 py-2">
					<div class="row">
						<div class="col-lg-11">
							<h2 class="mb-0">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-check" viewBox="0 0 16 16">
								<path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v8A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-8A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1h-3zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5zm1.886 6.914L15 7.151V12.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5V7.15l6.614 1.764a1.5 1.5 0 0 0 .772 0zM1.5 4h13a.5.5 0 0 1 .5.5v1.616L8.129 7.948a.5.5 0 0 1-.258 0L1 6.116V4.5a.5.5 0 0 1 .5-.5z"/>
					            </svg> Proyectos en los que usted participa: {{ Auth::user()->first_name }} {{Auth::user()->last_name }}
							</h2>
						</div>
						<div class="col-lg-1">
							@if ($projects->count() > 0)
							<button style="float:right;" class="btn btn-secondary btn-block" onclick="exportTableToExcel('tblData', 'datos')"><i class="fas fa-file-excel"></i> Excel</button>
							@endif
						</div>						
					</div>
				</div>



				<div class="card-body p-0">
					<table class="table table-striped table-bordered table-condensed table-hover table-sm mb-0" id="tblData">
						<thead>
							<tr class="text-center text-white bg-secondary">
								<th>Proyecto</th>
								<th>Neto Operacional</th>
								<th>PART %</th>
								<th>PART $</th>
								<th>Fase 1 %</th>
								<th>Fase 2 %</th>
								<th>Fase 3 %</th>
								<th title="Total fases %">Tot Fases %</th>
								<th title="Participación final %">P Final %</th>
								<th title="Participación final $">P Final $</th>
								<th title="Saldo $">Saldo $</th>
							</tr>
						</thead>
						<tbody class="mb-0">
							<?php
								$totpart = 0; 
								$sum = 0; 
								$saldo = 0;
								$sumsaldo = 0;
							?>
							
							@foreach ($projects as $project)
								<tr class="text-center">
									<td class="text-left">{{ $project->name }}</td>
									<td class="text-right">$ {{$project->costosexternos}}</td>
									<td>{{ $project->porcentaje }} %</td>
									<td class="text-right">$ {{ $project->valor }}</td>
									@if ($project->fase1ok == '1')
										<td><span class="badge badge-success" style="font-size: 14px;"> {{ $project->fase1 }}% </span></td>
									@else
										<td><span class="">{{ $project->fase1 }}%</span></td>
									@endif
									@if ($project->fase2ok == '1')
										<td><span class="badge badge-success" style="font-size: 14px;"> {{ $project->fase2 }}% </span></td>
									@else
										<td><span class=" ">{{ $project->fase2 }}%</span></td>
									@endif
									@if ($project->fase3ok == '1')
										<td><span class="badge badge-success" style="font-size: 14px;"> {{ $project->fase3 }}% </span></td>
									@else
										<td><span class=" ">{{ $project->fase3 }}%</span></td>
									@endif
									@if ($project->fase1ok == '1' || $project->fase2ok == '1' || $project->fase3ok == '1' )
										<td><span class="badge badge-success" style="font-size: 14px;"> {{ $project->totfases }} </span></td>
									@else
										<td><span class=" ">{{ $project->totfases }}</span></td>
									@endif
									<td><span class=""><b>{{ $project->partfinal_p }}</b></span></td>
									<td class="text-right"><span ><b>$ {{ $project->partfinal }}</b></span></td>
									<?php
										if ($project->fase1ok == '1' && $project->fase2ok == '1' && $project->fase3ok == '1' ){
											$saldo = 0;
										}else{
											$saldo = floatval(str_replace('.','',$project->valor))  - 
													 floatval(str_replace('.','',$project->partfinal)) ;

										}
									?>

									<td class="text-right"><span ><b>$ {{number_format($saldo,0,",",".")}}</b></span></td>
									
								</tr>
								<?php $totpart = $totpart + floatval(str_replace('.','',$project->valor)) ?>
								<?php $sum = $sum + floatval(str_replace('.','',$project->partfinal)) ?>
								<?php $sumsaldo = $sumsaldo + $saldo ?>
							@endforeach
							<tr class="text-white bg-secondary">
								<td colspan="" class="text-left"><span ><b>TOTALES</b></span></td>
								<td colspan="3" class="text-right"><span ><b>$ {{number_format($totpart,0,",",".")}}</b></span></td>
								<td colspan="6" class="text-right"><span ><b>$ {{number_format($sum,0,",",".")}}</b></span></td>
								<td colspan="" class="text-right"><span ><b>$ {{ number_format($sumsaldo,0,",",".")}}</b></span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
@endrole