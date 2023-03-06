@extends('layouts.admin')
@inject('utils', 'App\Utils\Utils')
@section('content')
<div class="container-fluid">
    <div class="text-center text-white mt-4">
        <h1 class="mb-4">Benvenuto nelle tue categorie!</h1>
    </div>
    <div class="my-3">
        <a href="{{route('admin.types.create')}}" class="btnblue">
            <i class="fa-solid fa-plus-square fa-fw fa-lg mr-2"></i>
            Aggiungi un nuovo tipo
        </a>
            @if(session('message'))
            <div class="alert alert-primary">
                {{session('message')}}
            </div>
            @endif
    </div>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark text-white">
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Slug</th>
            <th>Azioni</th>
          </tr>
        </thead>
    @foreach ($types as $type)
        <tbody>
          <tr class="align-middle">
            <td class="text-white">{{$type->id}}</td>
            <td class="text-white">{{$type->name}}</td>
            <td class="text-white">{{$type->slug}}</td>
            <td class="text-white col-sm-3"> 
                <div class="d-flex justify-content-around">
                    <a class="btn btn-outline-primary m-2 btn-sm btn-square" href="{{route('admin.types.show', $type->slug)}}" title="Visualizza type"><i class="fas fa-eye"></i></a>
                    <a class="btn btn-outline-warning m-2 btn-sm btn-square" href="{{route('admin.types.edit', $type->slug)}}" title="Modifica type"><i class="fas fa-edit"></i></a>
                    <form class="d-inline-block" action="{{route('admin.types.destroy', $type->slug)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger m-2 btn-sm btn-square confirm-delete-button" type="submit" title="Cancella">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
          </tr>
        </tbody>
        @endforeach
    </table>
    @include ('admin.partials.modals')
</div>
    @endsection