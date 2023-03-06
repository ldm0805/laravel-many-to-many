<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type as Type;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Project;
use App\Models\Category as Category;


class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();

        //Rimando alla view
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.types.create', compact('types'));
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTypeRequest $request)
    {
       // Ottengo i dati validati dalla richiesta
       $form_data = $request->validated();
    
       // Genero uno slug tramite una funzione (project.php) dal titolo del progetto
       $slug = Type::generateSlug($request->name, '-');
   
       // Lo slug viene aggiunto ai dati del form
       $form_data['slug'] = $slug;
   
       // Creo un nuovo progetto nel database utilizzando i dati del form
       $newProj = Type::create($form_data);
   
       // Reindirizzamento all'index con messaggio di conferma crezione
       return redirect()->route('admin.types.index')->with('message', 'Il type è stato creato correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTypeRequest  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        
       // Ottengo i dati validati dalla richiesta
       $form_data = $request->validated();
    
       // Genero uno slug tramite una funzione (project.php) dal titolo del progetto
       $slug = Type::generateSlug($request->name, '-');
   
       // Lo slug viene aggiunto ai dati del form
       $form_data['slug'] = $slug;
   
       $type->update($form_data);
       
       return redirect()->route('admin.types.index')->with('message', 'La modifica del project '.$type->name.' è andata a buon fine.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index')->with('message', 'La cancellazione del project '.$type->title.' è andata a buon fine.');
    }
}
