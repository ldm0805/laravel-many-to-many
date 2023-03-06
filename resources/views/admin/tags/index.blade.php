@extends('layouts.admin')
@inject('utils', 'App\Utils\Utils')
@section('content')
<div class="container-fluid">
    <div class="text-center text-white mt-4">
        <h1>Benvenuto nei tuoi tags!</h1>
    </div>
    <div class="my-5">
        <a href="{{route('admin.projects.create')}}" class="btnblue m-5">
            <i class="fa-solid fa-plus-square fa-fw fa-lg mr-2"></i>
            Aggiungi un nuovo progetto.
        </a>
       
    </div>
    <div>
        <table class="table table-striped">
            <thead>
                <th class="text-white">Id</th>
                <th class="text-white">Nome</th>
                <th class="text-white">Slug</th>
                <th class="text-white">Azioni</th>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                <tr>
                    <td class="text-white">{{$tag->id}}</td>
                    <td class="text-white">{{$tag->name}}</td>
                    <td class="text-white">{{$tag->slug}}</td>
                    <td>
                        {{-- Azioni per i tag --}}
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection