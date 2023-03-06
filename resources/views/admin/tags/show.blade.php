@extends('layouts.admin')
@inject('utils', 'App\Utils\Utils')

@section('content')
    <div class="show">
        <div class="row">
            <div class="col-12">
                <div class="mb-4">
                    <a href="{{route('admin.tags.index')}}" class="btnblue">
                        Torna all'elenco
                    </a>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-around py-3 my-4 border border-light align-items-center">
                <span>
                    <strong>
                       ID:
                    </strong>
                    {{$tag->id}}
                </span>
                <span>
                    <strong>
                        Tipo:
                    </strong>
                    {{$tag->name}}
                </span>
                <span>
                    <strong>
                        Slug:
                    </strong>
                    {{$tag->slug}}
                </span>
            </div>
            <h2 class="text-center">Progetti sviluppati con: {{$tag->name}}</h2>
            <div id="index">
                @forelse ($tag->projects as $item)
                <section class="card">
                    <article class="containerImagenCard">
                        <img src="https://cdn.pixabay.com/photo/2018/02/07/14/27/pension-3137209_640.jpg" alt="">
                    </article>
                    <article class="containerDescriptionCard d-flex flex-column">
                        <div class="mb-auto">
                            <p class="titleCard text-dark" >Progetto:</p>
                            <p class="titleCard text-dark">{{$item->title}}</p>
                            <p class="tecnologiesCard">Data: {{ $utils->changeDate($item->date_project) }}</p>
                            <p class="tecnologiesCard">{{$item->slug}}</p>
                            <p class="tecnologiesCard">Tipo: {{$item->type ? $item->type->name : 'Mancante'}}</p>
                            <p class="descriptionCard">Contenuto: {{$item->content}}</p>
                        </div>
                        <div>
                            <a class="btn btn-sm btn-square btn-primary" href="{{route('admin.projects.show', $item->slug)}}" title="Visualizza project"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-sm btn-square btn-warning" href="{{route('admin.projects.edit', $item->slug)}}" title="Modifica project"><i class="fas fa-edit"></i></a>
                            <form class="d-inline-block" action="{{route('admin.projects.destroy', $item->slug)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-square btn-danger confirm-delete-button" type="submit" title="Cancella">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </article>
                </section>
                @empty
                <div class="container">
                    <div class="row justify-content-center mt-5">
                        <div class="col-lg-8 col-md-10 col-sm-12">
                            <div class="alert alert-primary text-center" role="alert">
                                <h4 class="alert-heading mb-4">Non ci sono progetti sviluppati con: {{$type->name}}.</h4>
                                <p class="lead">Clicca qui per agguerli.</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    @include ('admin.partials.modals')
@endsection