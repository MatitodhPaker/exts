@extends('../../layouts/inicio')
@section('contenido')
<div class="row mt-4 justify-content-around">
    <div class="col-sm-10">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-outline-primary me-md-2" type="button" aria-current="page" href="" data-bs-toggle="modal" data-bs-target="#exampleModal">Registro alumnos</button>
          </div>
          <br>
        <table class="table table-sm table-hover dt-responsive nowrap" style="width:100%" id="tabla-alumnos">
            <thead>
                <tr>
                    <th>No Control</th>
                    <th>Nombre</th>
                    <th>Carrera</th>
                    <th>Telefono</th>
                    <th>
                        Escuela de prcedencia
                        (Media Superior)
                    </th>
                    <th>Fecha de nacimiento</th>
                    <th>Fecha de ingreso al tec</th>
                    <th>Creditos</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td class="text-center">{{$item->no_control}}</td>
                    <td class="text-center">{{$item->nombre}} {{$item->paterno}} {{$item->materno}}</td>
                    <td class="text-center">{{$item->carrera}}</td>
                    <td class="text-center">{{$item->telefono}}</td>
                    <td class="text-center">{{$item->media_superior}}</td>
                    <td class="text-center">{{$item->fecha_nacimiento}}</td>
                    <td class="text-center">{{$item->fecha_ingreso_tec}}</td>
                    <td><a href="{{route('creditos', $item->id)}}">Deportivo</a></td>
                    <td><a class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editarModal{{$item->id}}">Editar</a></td>
                    <td><button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal{{$item->id}}">Eliminar</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@push('scripts')
<script>
    $(document).ready(function () {
        $('#tabla-alumnos').DataTable({
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
    })

</script>
@endpush
@endsection
<!-- Modal registro-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            @include('../shared/appbar')
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('store')}}" method="POST" id="agregar">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="nombre">Nombre(s)</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="nombre">Apellido Paterno</label>
                            <input type="text" name="paterno" id="paterno" class="form-control" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="nombre">Apellido Materno</label>
                            <input type="text" name="materno" id="materno" class="form-control" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="nombre">Numero de control</label>
                            <input type="text" name="no_control" id="no_control" class="form-control" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="nombre">Telefono celular</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="nombre">Carrera</label>
                            <input type="text" name="carrera" id="carrera" class="form-control" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="nombre">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="nombre">Escuela de procedencia(media superior)</label>
                            <input type="text" name="media_superior" id="media_superior" class="form-control" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="nombre">Fecha de ingreso al instituto</label>
                            <input type="date" name="fecha_ingreso_tec" id="fecha_ingreso_tec" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2 col-4 mx-auto">
                    <button class="btn btn-outline-success" type="submit">Registro</button>
                    <a class="nav-link mx-auto" data-bs-dismiss="modal">Cancelar</a>

                </div>
            </form>
        </div>
    </div>
</div>
@foreach ($items as $item)
{{-- <!-- Modal deportivo-->
<div class="modal fade" id="modal_deportivo{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            @include('../shared/appbar')
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro Deportivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{$item->nombre}} {{$item->paterno}} {{$item->materno}}">
                    </div>
                    <div class="col-sm-3">
                        <label for="nombre">Numero de control</label>
                        <input type="text" name="control" id="control" class="form-control" value="{{$item->no_control}}">
                    </div>
                    <div class="col-sm-3">
                        <label for="nombre">Carrera</label>
                        <input type="text" name="carrera" id="carrera" class="form-control" value="{{$item->carrera}}">
                    </div>
                    <div class="col-sm-2">
                        <label for="estado">Estado</label>
                        <select name="estado" class="form-control">
                            <option selected disabled>Elige una opcion</option>
                            <option value="sin_asunto">Sin asunto</option>
                            <option value="tramite">Tramite</option>
                            <option value="liberado">Liberado</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <div class="d-grid gap-2">
                            <button class="btn btn-success" type="button">Añadir</button>
                        </div>
                    </div>
                </div>

                <table class="table table-sm table-hover dt-responsive nowrap" style="width:100%" id="tabla-">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Evidencia</th>
                            <th>Ubicacion</th>
                            <th>Horas Asignadas</th>
                            <th>Ver</th>
                            <th>Descargar</th>
                            <th>Guardar</th>
                            <th>Actualizar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="tablaDeporti">
                        <tr>
                            <td class="text-center">{{$item->control}}</td>
                            <td class="text-center">{{$item->nombre}} {{$item->paterno}} {{$item->materno}}</td>
                            <td class="text-center">{{$item->carrera}}</td>
                            <td class="text-center">{{$item->celular}}</td>
                            <td class="text-center">{{$item->procedencia}}</td>
                            <td class="text-center">{{$item->nacimiento}}</td>
                            <td class="text-center">{{$item->ingreso}}</td>
                            <td><a class="nav-link" data-bs-toggle="modal"
                                    data-bs-target="#modal_deportivo{{$item->id}}">Deportivo</a></td>
                            <td><a class="nav-link" data-bs-toggle="modal"
                                    data-bs-target="#modal_civico{{$item->id}}">Civico</a></td>
                            <td><a class="nav-link" data-bs-toggle="modal"
                                    data-bs-target="#modal_cultural{{$item->id}}">Cultural</a></td>
                            <td><a class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editarModal{{$item->id}}">Editar</a></td>
                            <td><button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#eliminarModal{{$item->id}}">Eliminar</button></td>
                        </tr>
                    </tbody>
                </table>

                <form>
                    <input type="hidden" value="{{$id_usuario}}" id="id_usuario" name="id_usuario"/>
                    <input type="hidden" value="{{$item->id}}" id="id_alumno" name="id_alumno">
                    
                    <div class="row">
                        <div class="col-sm-3">
                            <br>
                            <select name="tipo_credito" class="form-control" id="tipo_credito_1">
                                <option selected disabled>Elige un tipo</option>
                                <option value="Mooc">Mooc</option>
                                <option value="Evento">Evento</option>
                                <option value="Actividades">Actividades</option>
                            </select> 
                        </div>
                        <div class="col-sm-4 hidden">
                            @csrf
                            <label for="evidencia_virtual" name="evidencia_virtual" id="evidencia_virtual">Evidencia</label>
                            <input type="file" class="form-control">
                        </div>
                        <div class="col-sm-5 hidden">
                            <label for="evidencia_fisica">Ubicacion</label> 
                            <textarea type="text" name="evidencia_fisica" id="evidencia_fisica" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-3 hidden">
                            <label for="nombre">Horas asignadas</label>
                            <input type="number" min="1" step="1" name="carrera" id="carrera" class="form-control">
                        </div>
                        <div class="col-sm-4 hidden">
                            <br>
                            <button class="btn btn-light" style="border: none"><i class="fa-solid fa-eye"></i></button>
                            <button class="btn btn-light" style="border: none"><i class="fa-solid fa-file-arrow-down" style="color: #f02828;"></i></i></button>
                            <button class="btn btn-light" style="border: none"><i class="fa-solid fa-floppy-disk" style="color: #2a5aea;"></i></button>
                            <button class="btn btn-light" style="border: none"><i class="fa-solid fa-pen-to-square" style="color: #e6f425;"></i></button>
                            <button class="btn btn-light" style="border: none"><i class="fa-solid fa-trash"></i></button>
                            <button class="btn btn-light" style="border: none"><i class="fa-solid fa-circle-plus" style="color: #43e240;"></i></i></button>
                            <br>
                        </div>
                    </div>
                </form>
            </div>
            <div class="d-grid gap-2 col-4 mx-auto">
                <button class="btn btn-primary" type="button">Registro</button>
                <button class="btn btn-success" type="button">Volver</button>
                <br>
            </div>
        </div>
    </div>
</div>
</div> --}}
  <!-- Modal editar-->
  <div class="modal fade" id="editarModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel">  
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        @include('../shared/appbar')
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('update', $item->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{$item->nombre}}">
                    </div>
                    <div class="col-sm-4">
                        <label for="nombre">Apellido Paterno</label>
                        <input type="text" name="paterno" id="paterno" class="form-control" value="{{$item->paterno}}">
                    </div>
                    <div class="col-sm-4">
                        <label for="nombre">Apellido Materno</label>
                        <input type="text" name="materno" id="materno" class="form-control" value="{{$item->materno}}">
                    </div>
                    <div class="col-sm-4">
                        <label for="nombre">Numero de control</label>
                        <input type="text" name="no_control" id="no_control" class="form-control" value="{{$item->no_control}}">
                    </div>
                    <div class="col-sm-4">
                        <label for="nombre">Telefono celular</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="{{$item->telefono}}">
                    </div>
                    <div class="col-sm-4">
                        <label for="nombre">Carrera</label>
                        <input type="text" name="carrera" id="carrera" class="form-control" value="{{$item->carrera}}">
                    </div>
                    <div class="col-sm-4">
                        <label for="nombre">Fecha de nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{$item->fecha_nacimiento}}">
                    </div>
                    <div class="col-sm-4">
                        <label for="nombre">Escuela de procedencia(media superior)</label>
                        <input type="text" name="media_superior" id="media_superior" class="form-control" value="{{$item->media_superior}}">
                    </div>
                    <div class="col-sm-4">
                        <label for="nombre">Fecha de ingreso al instituto</label>
                        <input type="date" name="fecha_ingreso_tec" id="fecha_ingreso_tec" class="form-control" value="{{$item->fecha_ingreso_tec}}">
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 col-4 mx-auto">
                <button class="btn btn-outline-warning" type="submit">Editar</button>
                <a class="nav-link mx-auto" data-bs-dismiss="modal">Cancelar</a>

            </div>
        </form>
      </div>
    </div>
  </div>
  
  <!-- Modal eliminar-->
  <div class="modal fade" id="eliminarModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        @include('../shared/appbar')
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('destroy',$item->id)}}" method="post">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-4">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{$item->nombre}}" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label for="nombre">Apellido Paterno</label>
                        <input type="text" name="paterno" id="paterno" class="form-control" value="{{$item->paterno}}" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label for="nombre">Apellido Materno</label>
                        <input type="text" name="materno" id="materno" class="form-control" value="{{$item->materno}}" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label for="nombre">Numero de control</label>
                        <input type="text" name="no_control" id="no_control" class="form-control" value="{{$item->no_control}}" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label for="nombre">Telefono celular</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="{{$item->telefono}}" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label for="nombre">Carrera</label>
                        <input type="text" name="carrera" id="carrera" class="form-control" value="{{$item->carrera}}" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label for="nombre">Fecha de nacimiento</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{$item->fecha_nacimiento}}" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label for="nombre">Escuela de procedencia(media superior)</label>
                        <input type="text" name="media_superior" id="media_superior" class="form-control" value="{{$item->media_superior}}" disabled>
                    </div>
                    <div class="col-sm-4">
                        <label for="nombre">Fecha de ingreso al instituto</label>
                        <input type="date" name="fecha_ingreso_tec" id="fecha_ingreso_tec" class="form-control" value="{{$item->fecha_ingreso_tec}}" disabled>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 col-4 mx-auto">
                @method('DELETE')
                <button class="btn btn-outline-danger" type="submit">Eliminar</button>
                <a class="nav-link mx-auto" data-bs-dismiss="modal">Cancelar</a>

            </div>
        </form>
      </div>
    </div>
  </div>
@endforeach