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
                    <th>Credito</th>
                    <th>Credito</th>
                    <th>Credito</th>
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
                    <td><a href="{{route('credito', ['deportivo', $item->id])}}">deportivo</a></td>
                    <td><a href="{{route('credito',['civico', $item->id])}}">civico</a></td>
                    <td><a href="{{route('credito',['cultural', $item->id])}}">cultural</a></td>
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