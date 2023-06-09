@extends('../../layouts/login')
@section('contenido')
    <div class="row mt-4 justify-content-around">
        <div class="col-sm-4 ">
            <div class="card" style="border: -0">
                <div class="card-body login">
                    <div class="row">
                        <div class="col offset-2">
                            <img src="{{asset('img/login.png')}}" class="img-fluid logimg" alt="...">
                        </div>
                    </div>
                    <form action="{{route('logear')}}" method="post">
                        @csrf
                        @method('post')
                        <label for="name">Usuario</label>
                        <input type="text" class="form-control" name="name" id="name">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password">
                        <div class="row my-5">
                            <div class="d-grid gap-2">
                                <button class="btn btn-tec">Ingresar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection