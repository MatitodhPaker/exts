@extends('../../layouts/inicio')
@section('contenido')
<div class="container">
    <div class="row mt-4">
        <div class="col-sm-3">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control"
                value="{{$items->nombre}} {{$items->paterno}} {{$items->materno}}" disabled>
        </div>
        <div class="col-sm-3">
            <label for="nombre">Numero de control</label>
            <input type="text" name="control" id="control" class="form-control" value="{{$items->no_control}}" disabled>
        </div>
        <div class="col-sm-3">
            <label for="nombre">Carrera</label>
            <input type="text" name="carrera" id="carrera" class="form-control" value="{{$items->carrera}}" disabled>
        </div>

        <div class="col-sm-3">
            <div class="d-grid gap-2">
                <button class="btn btn-outline-primary me-md-2" type="button" aria-current="page" href=""
                    data-bs-toggle="modal" data-bs-target="#modalRegistroCreditos">Registro Creditos</button>
            </div>
        </div>
    </div>
    <table class="table table-sm table-hover dt-responsive nowrap mt-2" style="width:100%" id="tabla-">
        <thead>
            <tr>
                <th>Tipo de evidencia</th>
                <th>Tipo de credito</th>
                <th>Nombre Evidencia</th>
                <th>Ubicacion Fisica</th>
                <th>Horas asignadas</th>
                <th>Ver</th>
                <th>Actualizar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody id="tablaDeporti">
            @foreach ($items_table as $item)
            <tr>
                <td class="text-center">{{$item->tipo_evidencia}}</td>
                <td class="text-center">{{$item->credito}}</td>
                <td class="text-center">{{$item->nombre_archivo}}</td>
                <td class="text-center">{{$item->ubicacion_carpeta}}</td>
                <td class="text-center">{{$item->horas_asignadas}}</td>
                
                <td class="text-center"><button class="btn btn-light" style="border: none" data-bs-toggle="modal"
                        data-bs-target="#ver_descargar{{$item->id}}"><i class="fa-solid fa-eye"></i></button></td>
                <td class="text-center"><a class="btn btn-light" style="border: none"  data-bs-toggle="modal" data-bs-target="#actualizarc{{$item->id}}">
                        <i class="fa-solid fa-pen-to-square" style="color: #e6f425;">
                        </i></a></td>
                    <td class="text-center">
                        <form action="{{route('destroy_credito',$item->id)}}" method="post">
                            @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-light" style="border: none">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Registro creditos -->
<div class="modal fade" id="modalRegistroCreditos" tabindex="-1" aria-labelledby="exampleModalLabel" aria="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            @include('../shared/appbar')
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('store_credito')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_alumno" value="{{$items->id}}">
                <input type="hidden" name="id_user" value="{{$id_usuario}}">
                <input type="hidden" name="credito" value="{{$titulo}}">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="row">
                        {{-- <div class="col-sm-3">
                            <label for="tipo_evidencia">Creditos</label>
                                <select name="tipo_evidencia" class="form-control">
                                    <option selected disable>Elige una opcion</option>
                                    <option value="deportivo">Deportivo</option>
                                    <option value="cultural">Cultural</option>
                                    <option value="civico">Civico</option> 
                                </select>
                            </select>
                        </div> --}}
                        <div class="col-sm-3">
                            <label for="tipo_evidencia">Tipo de credito</label>
                            <select name="tipo_evidencia" class="form-control" id="tipo_evidencia">
                                <option selected disabled>Elige un tipo</option>
                                <option value="constancia">Constancia</option>
                                <option value="evento">Evidencias</option>
                                <option value="mooc">Mooc</option>
                                <option value="Evento">Evento</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="nombre_archivo">Evidencia</label>
                            <input type="text" class="form-control" name="nombre_archivo" id="nombre_archivo">
                        </div>
                        <div class="col-sm-4">
                            <br>
                            <input type="file" name="archivo" class="form-control">
                        </div>
                        <div class="col-sm-2 d-none" id="horas_asignadas_div">
                            <label for="horas_asignadas">Horas asignadas</label>
                            <input type="number" min="1" step="1" max="20" name="horas_asignadas" id="horas_asignadas"
                            class="form-control">
                        </div>
                    </div>
                    <div class="row mt-6 justify-content-around">
                        <div class="col-sm-6">
                            <label for="carpeta">Ubicacion</label>
                            <textarea type="text" name="carpeta" id="carpeta" class="form-control"></textarea>
                        </div>
                        {{-- <div class="col-sm-2">
                            <label for="nombre_mooc">Mooc</label>
                            <input type="text" class="form-control" name="nombre_mooc" id="nombre_mooc">
                        </div>
                        <div class="col-sm-4">
                            <br>
                            <input type="file" name="mooc" class="form-control">
                        </div> --}}
                        {{-- <div class="col-sm-3">
                            <label for="estado">Estado</label>
                            <select name="estado" class="form-control">
                                <option selected disabled>Elige una opcion</option>
                                <option value="tramite">Tramite</option>
                                <option value="liberado">Liberado</option>
                            </select>
                        </div> --}}
                    </div>
                </div>
                <div class="d-grid gap-2 col-4 mx-auto">
                    <button class="btn btn-outline-secondary" type="submit">Guardar</button>
                    <a class="nav-link mx-auto" data-bs-dismiss="modal">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal actualizar-->
@foreach($items_table as $item)
<div class="modal fade" id="actualizarc{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  action="{{route('update_credito', $item->id)}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_alumno" value="{{$items->id}}">
                    <input type="hidden" name="id_user" value="{{$id_usuario}}">
                    <input type="hidden" name="credito" value="{{$titulo}}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="tipo_evidencia">Creditos</label>
                                <select name="tipo_evidencia" class="form-control">
                                    @if($item->tipo_evidencia == 'deportivo')
                                        <option selected value="deportivo">Deportivo</option>
                                        <option value="cultural">Cultural</option>
                                        <option value="civico">Civico</option>
                                    @endif
                                    @if ($item->tipo_evidencia == 'deportivo')
                                    <option select value="deportivo">Deportivo</option>
                                    @endif
                                    @if ($item->tipo_evidencia == '')
                                    <option value="deportivo">Deportivo</option> 
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="credito">Evidencia</label>
                                <select name="credito" class="form-control">
                                    @if ($item->credito == 'constancia')
                                    <option selected value="constancia">Constancia</option>
                                    <option value="evento">Evento</option> 
                                    @endif
                                    @if($item->credito == 'evento')
                                    <option value="constancia">Constancia</option>
                                    <option selected value="evento">Evento</option>
                                    @endif
                                    @if($item->credito == '')
                                    <option selected disable>Elige una opcion</option>
                                    <option value="constancia">Constancia</option>
                                    <option value="evento">Evento</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="nombre_archivo">Evidencia</label>
                                <input type="text" class="form-control" name="nombre_archivo" id="nombre_archivo" value="{{$item->nombre_archivo}}">
                            </div>
                            <div class="col-sm-3">
                                <br>
                                <input type="file" name="archivo" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-6 justify-content-around">
                            <div class="col-sm-2">
                                <label for="nombre_mooc">Mooc</label>
                                <input type="text" class="form-control" name="nombre_mooc" id="nombre_mooc" value="{{$item->nombre_mooc}}">
                            </div>
                            <div class="col-sm-4">
                                <br>
                                <input type="file" name="mooc" class="form-control">
                            </div>
                            <div class="col-sm-2">
                                <label for="horas_asignadas">Horas asignadas</label>
                                <input type="number" min="{{$item->horas_asignadas}}" step="1" max="20" name="horas_asignadas" id="horas_asignadas" class="form-control" value="{{$item->horas_asignadas}}">
                            </div>
                            <div class="col-sm-3">
                                <label for="estado">Estado</label>
                                <select name="estado" class="form-control">
                                    @if ($item->estado == 'liberado')
                                    <option selected value="liberado">Liberado</option>
                                    <option value="tramite">Tramite</option>
                                    @endif
                                    @if ($item->estado == 'tramite')
                                    <option value="liberado">Liberado</option>
                                    <option selected value="tramite">Tramite</option>
                                    @endif
                                    @if ($item->estado == '')
                                    <option selected disable>Elige una opcion</option>
                                    <option value="liberado">Liberado</option>
                                    <option value="tramite">Tramite</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3 justify-content-center">
                            <div class="col-sm-6">
                                <label for="carpeta">Ubicacion</label>
                                <textarea type="text" name="carpeta" id="carpeta" class="form-control">{{$item->carpeta}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid gap-2 col-4 mx-auto">
                        <button class="btn btn-outline-secondary" type="submit">Guardar</button>
                        <a class="nav-link mx-auto" data-bs-dismiss="modal">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Modal ver y descargar-->
@foreach ($items_table as $item)
<div class="modal fade" id="ver_descargar{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PDF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <iframe width="300" height="500" type="application/pdf" 
                            src="/storage/{{$item->ubicacion_archivo}}"
                            frameborder="0">
                        </iframe> 
                    </div>
                </div>
                            
            </div>  
        </div>
    </div>
</div>
</div>
@endforeach
@push('scripts')
<script>
    (()=>{
        const selectType = document.querySelector('#tipo_evidencia');
        const divInputTime = document.querySelector('#horas_asignadas_div');

        
        selectType?.addEventListener('change', (e) => {
            if(selectType.value === 'mooc'){
                divInputTime?.classList.add('d-none');
            }else{
                divInputTime?.classList.remove('d-none');
            }
        });
    })()
    
</script>
@endpush
@endsection