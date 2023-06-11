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
                <button id="btnCreditos" class="btn btn-outline-primary me-md-2" type="button" aria-current="page" href=""
                    data-bs-toggle="modal" data-bs-target="#modalRegistroCreditos">Registro Creditos</button>
                <button id="btnHoja" class="btn btn-outline-secondary me-md-2 d-none" type="button" aria-current="page" href=""
                data-bs-toggle="modal" data-bs-target="#hojadeliberacion">Hoja liberado</button>
            </div>
        </div>
    </div>

    <form action="{{(isset($credito)) ? route('update_horas', $credito->id) : route('store_horas')}}" method="POST">
    <div class="row mt-4">
            @csrf
            @if (isset($credito))
                @method('PUT')
                <input type="hidden" name="id_credito" id="id_credito" value="{{$credito->id}}">
                <input type="hidden" name="estado_credito" id="estado_credito" value="{{$credito->estado}}"> 
            @else
                @method('POST')
            @endif
            <input type="hidden" name="tipo_credito" id="tipo_credito" value="{{$titulo}}">
            <input type="hidden" name="id_alumno" value="{{$items->id}}">
            <input type="hidden" name="horas_totales" value="{{$horas}}">
            <div class="col-sm-3">
                <label for="nombre">Horas</label>
                <input type="text" name="horas" id="horas" class="form-control" value="{{$horas}}" disabled>
            </div>
            <div class="col-sm-3">
                <label for="nombre">Mooc</label>
                <input type="text" name="credito" id="credito" class="form-control" value="{{$conteo_mooc}}" disabled>
            </div>
            <div class="col-3">
                <br>
                <select name="estado" class="form-control" id="estado">
                    @if (isset($credito))
                        @if ($credito->estado == "tramite") 
                            <option selected value="tramite">Tramite</option>
                            <option value="liberado">Liberado</option>
                        @elseif ($credito->estado == "liberado") 
                            <option value="tramite">Tramite</option>
                            <option selected value="liberado">Liberado</option>
                            
                        @endif
                    @else
                        <option selected disabled>Estado</option>
                        <option value="tramite">Tramite</option>
                        <option value="liberado">Liberado</option>
                    @endif
                </select>
            </div>
            <div class="col-3">
                <br>
                <button type="submit" class="btn btn-outline-success" id="btnGuardarCredito">Guardar</button>
                <button type="submit" class="btn btn-outline-success d-none" id="btnActualizarCredito">Actualizar</button>
                <a href="{{route('liberar',[$items->id, $titulo])}}" class="btn btn-outline-secondary d-none" id="btnImprimirCredito">Imprimir</a>
            </div>
        </div>
    </form>
        <div class="row">
            <div class="col">
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
                            <td class="text-center">
                                <button class="btn btn-light" style="border: none" data-bs-toggle="modal" data-bs-target="#ver_descargar{{$item->id}}">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <button id="btnUpdate" class="btn btn-light" style="border: none"  data-bs-toggle="modal" data-bs-target="#actualizarc{{$item->id}}">
                                    <i class="fa-solid fa-pen-to-square" style="color: #e6f425;"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <form action="{{route('destroy_credito',$item->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button id="btnDelete" type="submit" class="btn btn-light" style="border: none">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </from>
</div>

<!-- Modal Registro creditos -->
<div class="modal fade" id="modalRegistroCreditos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            @include('../shared/appbar')
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro Credito</h5>
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
                        <div class="col-sm-3">
                            <label for="tipo_evidencia">Tipo de credito</label>
                            <select name="tipo_evidencia" class="form-control" id="tipo_evidencia">
                                <option selected disabled>Elige un tipo</option>
                                <option value="constancia">Constancia</option>
                                <option value="evento">Evidencias</option>
                                <option value="mooc">Mooc</option>
                                <option value="evento">Evento</option>
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
                        <div class="col-sm-6"></div>
                            <label for="carpeta">Ubicacion</label>
                            <textarea type="text" name="carpeta" id="carpeta" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="d-grid gap-2 col-4 mx-auto">
                        <button class="btn btn-outline-secondary" type="submit">Guardar</button>
                        <a class="nav-link mx-auto" data-bs-dismiss="modal">Cancelar</a>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal actualizar-->
@foreach($items_table as $item)
<div class="modal fade"id="actualizarc{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('update_credito', $item->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_alumno" value="{{$items->id}}">
                <input type="hidden" name="id_user" value="{{$id_usuario}}">
                <input type="hidden" name="credito" value="{{$titulo}}">
                <input type="hidden" name="id_alumno" value="{{$items->id}}">
                <input type="hidden" name="id_user" value="{{$id_usuario}}">
                <input type="hidden" name="credito" value="{{$titulo}}">
                <div class="row">
                    <div class="col-sm-3">
                        <label for="tipo_evidencia">Tipo de credito</label>
                        <select name="tipo_evidencia" class="form-control" id="tipo_evidencia_update">
                            @if (isset($item->tipo_evidencia))
                                @if ($item->tipo_evidencia == "constancia") 
                                    <option selected value="constancia">Constancia</option>
                                    <option value="evento">Evidencias</option>
                                    <option value="mooc">Mooc</option>
                                    <option value="evento">Evento</option>
                                @elseif ($item->tipo_evidencia == "evento") 
                                    <option value="constancia">Constancia</option>
                                    <option selected value="evento">Evidencias</option>
                                    <option value="mooc">Mooc</option>
                                    <option value="evento">Evento</option>
                                @elseif ($item->tipo_evidencia == "mooc") 
                                    <option value="constancia">Constancia</option>
                                    <option value="evento">Evidencias</option>
                                    <option selected value="mooc">Mooc</option>
                                    <option value="evento">Evento</option>
                                @elseif ($item->tipo_evidencia == "mooc") 
                                    <option value="constancia">Constancia</option>
                                    <option value="evento">Evidencias</option>
                                    <option value="mooc">Mooc</option>
                                    <option value="evento">Evento</option>
                                @endif
                            @else
                                <option selected disabled>Elige un tipo</option>
                                <option value="constancia">Constancia</option>
                                <option value="evento">Evidencias</option>
                                <option value="mooc">Mooc</option>
                                <option value="evento">Evento</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label for="nombre_archivo">Evidencia</label>
                        <input type="text" class="form-control" name="nombre_archivo" id="nombre_archivo" value="{{$item->nombre_archivo}}">
                    </div>
                    <div class="col-sm-4">
                    <br>
                        <input type="file" name="archivo" class="form-control">
                    </div>
                    <div class="col-sm-2 {{($item->tipo_evidencia == 'mooc')? 'd-none' : ''}}" id="horas_asignadas_div_update">
                        <label for="horas_asignadas">Horas asignadas</label>
                        <input type="number" min="1" step="1" max="20" name="horas_asignadas" id="horas_asignadas" class="form-control" value="{{$item->horas_asignadas}}">
                    </div>
                </div>
                <div class="row mt-6 justify-content-around">
                    <div class="col-sm-6">
                        <label for="carpeta">Ubicacion</label>
                        <textarea type="text" name="carpeta" id="carpeta" class="form-control">{{$item->ubicacion_carpeta}}</textarea>
                    </div>
                </div>
                <div class="d-grid gap-2 col-4 mx-auto">
                    <br>
                    <button class="btn btn-outline-warning" type="submit">Editar</button>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PDF</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <iframe width="450" height="500" type="application/pdf" 
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
  
  <!-- Modal liberacion-->
  <div class="modal fade" id="hojadeliberacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hoja de liberacion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container">
            <form action="{{route('store_credito')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_alumno" value="{{$items->id}}">
                <input type="hidden" name="id_user" value="{{$id_usuario}}">
                <input type="hidden" name="credito" value="{{$titulo}}">
                <input type="hidden" name="tipo_evidencia" value="liberado">
                <input type="hidden" name="nombre_archivo" value="{{'credito_liberado_'.$titulo}}">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col">
                        <label>Inserte aqui la hoja sellada y firmada</label>
                        <input type="file" name="archivo" class="form-control"><br>
                    </div>
                </div>
                    <div class="row mt-4">
                        <div class="col">
                            <label>Ubicacion en oficina</label>
                            <br>
                            <textarea type="text" class="form-control" name="carpeta"></textarea>
                        </div>
                    <div class="col mt-4"><button class="btn btn-outline-info" type="submit">Guardar</button></div>
                </div>
            </form>
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

        // Select dinamico
        const selectType = document.querySelector('#tipo_evidencia');
        const divInputTime = document.querySelector('#horas_asignadas_div');
        const selectTypeUpdate = document.querySelector('#tipo_evidencia_update');
        const divInputTimeUpdate = document.querySelector('#horas_asignadas_div_update');

        // Botones dinamico
        const inputIdCredito = document.querySelector('#id_credito');
        const inputTotalHrs = document.querySelector('#horas');
        const inputEstado = document.querySelector('#estado_credito');
        const btnGuardarCredito = document.querySelector('#btnGuardarCredito');
        const btnActualizarCredito = document.querySelector('#btnActualizarCredito');
        const btnImprimirCredito = document.querySelector('#btnImprimirCredito');

        const btnUpdate = document.querySelectorAll('#btnUpdate');
        const btnDelete = document.querySelectorAll('#btnDelete');

        const btnCreditos = document.querySelector('#btnCreditos');
        const btnHoja = document.querySelector('#btnHoja');

        const btnDisable = (btn, boolean) => {
            for (let i = 0; i < btn.length; i++) {
                btn[i].disabled = boolean
            }
        }

        const compararInput = () => {
            if(parseInt(inputIdCredito?.value) >= 1 ){
                btnActualizarCredito?.classList.remove('d-none');
                btnGuardarCredito?.classList.add('d-none');
                btnDisable(btnDelete, false);
                btnDisable(btnUpdate, false);
                btnCreditos?.classList.remove('d-none');
                btnHoja?.classList.add('d-none');
            }
        };

        const compararHrs = () => {
            if((parseInt(inputTotalHrs?.value) >= 20) && (inputEstado?.value === 'liberado')){
                btnImprimirCredito?.classList.remove('d-none');
                btnActualizarCredito?.classList.add('d-none');
                btnGuardarCredito?.classList.add('d-none');
                btnDisable(btnDelete, true);
                btnDisable(btnUpdate, true);
                btnCreditos?.classList.add('d-none');
                btnHoja?.classList.remove('d-none');
            }else{
                compararInput();
            }
        };

        const eventoChange = (select, div) => {
            select?.addEventListener('change', () => {
                if(select.value === 'mooc'){
                    div?.classList.add('d-none');
                }else{
                    div?.classList.remove('d-none');
                }
            });
        };

        compararHrs();

        eventoChange(selectType, divInputTime);
        eventoChange(selectTypeUpdate, divInputTimeUpdate);
    })()
    
</script>
@endpush
@endsection