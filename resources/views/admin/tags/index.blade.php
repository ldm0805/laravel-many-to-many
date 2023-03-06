@extends('layouts.admin')
@inject('utils', 'App\Utils\Utils')
@section('content')
<div class="container-fluid">
    <div class="text-center text-white mt-4">
        <h1>Benvenuto nei tuoi tags!</h1>
    </div>
    <div>
        <a href="{{route('admin.projects.create')}}" class="btnblue my-5">
            <i class="fa-solid fa-plus-square fa-fw fa-lg mr-2"></i>
            Aggiungi un nuovo progetto.
        </a>
    </div>
    <div>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark text-white">
              <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Slug</th>
                <th>Azioni</th>
              </tr>
            </thead>
        @foreach ($tags as $tag)
            <tbody>
              <tr class="align-middle">
                <td class="text-white">{{$tag->id}}</td>
                <td class="text-white">{{$tag->name}}</td>
                <td class="text-white">{{$tag->slug}}</td>
                <td class="text-white col-sm-3"> 
                    <div class="d-flex justify-content-around">
                        <a class="btn btn-outline-primary m-2 btn-sm btn-square" href="{{route('admin.tags.show', $tag->slug)}}" title="Visualizza tag"><i class="fas fa-eye"></i></a>
                        <a class="btn btn-outline-warning m-2 btn-sm btn-square" href="{{route('admin.tags.edit', $tag->slug)}}" title="Modifica tag"><i class="fas fa-edit"></i></a>
                        <form class="d-inline-block" action="{{route('admin.tags.destroy', $tag->slug)}}" method="POST">
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
@endsection