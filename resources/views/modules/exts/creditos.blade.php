@extends('../../layouts/inicio')
@section('contenido')
<div class="container">
    <div class="row mt-4">
        <div class="col-sm-3">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{$items->nombre}} {{$items->paterno}} {{$items->materno}}">
        </div>
        <div class="col-sm-3">
            <label for="nombre">Numero de control</label>
            <input type="text" name="control" id="control" class="form-control" value="{{$items->no_control}}">
        </div>
        <div class="col-sm-3">
            <label for="nombre">Carrera</label>
            <input type="text" name="carrera" id="carrera" class="form-control" value="{{$items->carrera}}">
        </div>
        
        <div class="col-sm-3">
            <div class="d-grid gap-2">
            <button class="btn btn-outline-primary me-md-2" type="button" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#modalRegistroCreditos">Registro Creditos</button>
            </div>
        </div>
    </div>
    <table class="table table-sm table-hover dt-responsive nowrap mt-2" style="width:100%" id="tabla-">
        <thead>
            <tr>
                <th>Credito</th>
                <th>Tipo de credito</th>
                <th>nombre archivo Evidencia</th>
                <th>Mooc</th>
                <th>Horas asignadas</th>
                <th>Ubicacion</th>
                <th>Estado</th>
                <th>Ver</th>
                <th>Actualizar</th>
                <th>Descargar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody id="tablaDeporti">
            @foreach ($items_table as $item)
            <tr>
            <td>{{$item->tipo_evidencia}}</td>
            <td>{{$item->credito}}</td>
            <td>{{$item->nombre_archivo}}</td>
            <td>{{$item->nombre_mooc}}</td>
            <td>{{$item->horas_asignadas}}</td>
            <td>{{$item->carpeta}}</td>
            <td>{{$item->estado}}</td>
            <td><button class="btn btn-light" style="border: none"><i class="fa-solid fa-eye"></i></button></td>
            <td><button class="btn btn-light" style="border: none"><i class="fa-solid fa-pen-to-square" style="color: #e6f425;"></i></button></td>
            <td><button class="btn btn-light" style="border: none"><i class="fa-solid fa-file-arrow-down" style="color: #f02828;"></i></i></button></td>
            <td><button class="btn btn-light" style="border: none"><i class="fa-solid fa-trash"></i></button></td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row justify-content-center" hidden>
        <div class="col-sm-4">
            <br>
            <td><button class="btn btn-light" style="border: none"><i class="fa-solid fa-eye"></i></button></td>
            <td><button class="btn btn-light" style="border: none"><i class="fa-solid fa-file-arrow-down" style="color: #f02828;"></i></i></button></td>
            <td><button class="btn btn-light" style="border: none"><i class="fa-solid fa-floppy-disk" style="color: #2a5aea;"></i></button></td>
            <td><button class="btn btn-light" style="border: none"><i class="fa-solid fa-pen-to-square" style="color: #e6f425;"></i></button></td>
            <td><button class="btn btn-light" style="border: none"><i class="fa-solid fa-trash"></i></button></td>
            <td><button class="btn btn-light" style="border: none"><i class="fa-solid fa-circle-plus" style="color: #43e240;"></i></i></button></td>
            <br>
        </div>
    </div>
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
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="tipo_evidencia">Credito</label>
                            <select name="tipo_evidencia" class="form-control">
                                <option selected disabled>Elige una opcion</option>
                                <option value="deportivo">Deportivo</option>
                                <option value="cultural">Cultural</option>
                                <option value="civico">Civico</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="credito">Tipo de credito</label>
                            <select name="credito" class="form-control" id="credito">
                                <option selected disabled>Elige un tipo</option>
                                <option value="Evento">Constancia</option>
                                <option value="Actividades">Evidencias</option>
                            </select> 
                        </div>
                        <div class="col-sm-3">
                            <label for="nombre_archivo">Evidencia</label>
                            <input type="text" class="form-control" name="nombre_archivo" id="nombre_archivo">
                        </div>
                        <div class="col-sm-3">
                            <br>
                            <input type="file" name="archivo" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-6 justify-content-around">
                        <div class="col-sm-2">
                            <label for="nombre_mooc">Mooc</label>
                            <input type="text" class="form-control" name="nombre_mooc" id="nombre_mooc">
                        </div>
                        <div class="col-sm-4">
                            <br>
                            <input type="file" name="mooc" class="form-control">
                        </div>
                        <div class="col-sm-2">
                            <label for=horas_asignadas">Horas asignadas</label>
                            <input type="number" min="1" step="1" name="horas_asignadas" id="horas_asignadas" class="form-control">
                        </div>
                        <div class="col-sm-3">
                            <label for="estado">Estado</label>
                            <select name="estado" class="form-control">
                                <option selected disabled>Elige una opcion</option>
                                <option value="tramite">Tramite</option>
                                <option value="liberado">Liberado</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 justify-content-center">
                        <div class="col-sm-6">
                            <label for="carpeta">Ubicacion</label> 
                            <textarea type="text" name="carpeta" id="carpeta" class="form-control"></textarea>
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
@endsection