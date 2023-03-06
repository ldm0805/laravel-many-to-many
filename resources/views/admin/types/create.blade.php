@extends('layouts.admin')
@section('content')
<div class="container create">
    <div class="row">
        <div class="col-12 text-center m-4">
            <h2 class="text-white">Aggiungi nuovo project</h2>
        </div>
        <div class="col-12">
            <form action="{{route('admin.types.store')}}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="control-label mb-2">
                    Nome
                </label>
                <input type="text" class="form-control" placeholder="Nome" id="name" name="name">
                    @error('name')
                    <div class="alert alert-danger mt-2">{{$message}}</div>
                    @enderror
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="btnblue">Salva</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection