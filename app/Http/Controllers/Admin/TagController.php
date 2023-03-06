<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Controllers\Controller;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.tags.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
         // Ottengo i dati validati dalla richiesta
       $form_data = $request->validated();
    
       // Genero uno slug tramite una funzione (project.php) dal titolo del progetto
       $slug = Tag::generateSlug($request->name, '-');
   
       // Lo slug viene aggiunto ai dati del form
       $form_data['slug'] = $slug;
   
       // Creo un nuovo progetto nel database utilizzando i dati del form
       $newProj = Tag::create($form_data);
   
       // Reindirizzamento all'index con messaggio di conferma crezione
       return redirect()->route('admin.tags.index')->with('message', 'Il nuovo tag è stato creato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTagRequest  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        // Ottengo i dati validati dalla richiesta
        $form_data = $request->validated();
            
        // Genero uno slug tramite una funzione (project.php) dal titolo del progetto
        $slug = Tag::generateSlug($request->name, '-');

        // Lo slug viene aggiunto ai dati del form
        $form_data['slug'] = $slug;

        $tag->update($form_data);
        
        return redirect()->route('admin.tags.index')->with('message', 'La modifica del tag '.$tag->name.' è andata a buon fine.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('message', 'La cancellazione del tag '.$tag->name.' è andata a buon fine.');
    }
}
