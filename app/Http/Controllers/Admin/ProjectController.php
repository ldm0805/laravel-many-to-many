<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; //NECESSARIO  
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Tag;

use App\Models\Type;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Recupero tutti i dati dal database
        $projects = Project::all();

        //Rimando alla view
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $tags = Tag::all();

        return view('admin.projects.create', compact('types','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        
        // Ottengo i dati validati dalla richiesta
        $form_data = $request->validated();
    
        // Genero uno slug tramite una funzione (project.php) dal titolo del progetto
        $slug = Project::generateSlug($request->title, '-');
    
        // Lo slug viene aggiunto ai dati del form
        $form_data['slug'] = $slug;
    
        // Creo un nuovo progetto nel database utilizzando i dati del form
        $newProj = Project::create($form_data);
        
        if($request->has('tags')){
            $newProj->tags()->attach($request->tags);
        }
        
        // Reindirizzamento all'index con messaggio di conferma crezione
        return redirect()->route('admin.projects.index')->with('message', 'Il project è stato creato correttamente');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //prende in automatico i dati del project
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $tags = Tag::all();
        return view('admin.projects.edit', compact('project', 'types', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
       // Ottengo i dati validati dalla richiesta
       $form_data = $request->validated();
    
       // Genero uno slug tramite una funzione (project.php) dal titolo del progetto
       $slug = Project::generateSlug($request->title);
   
       // Lo slug viene aggiunto ai dati del form
       $form_data['slug'] = $slug;
   
       $project->update($form_data);

       if($request->has('tags')){
            $project->tags()->sync($request->tags);
       }
       
       return redirect()->route('admin.projects.index')->with('message', 'La modifica del project '.$project->title.' è andata a buon fine.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //1 cancellare i record nella tabella ponte (se non abbiamo il cascadeOnDelete)
        // $project->tags()->sync([]);

        //Elimino il project dal database;
        $project->delete();
        // Reindirizzamento all'index con messaggio di conferma eliminazione
        return redirect()->route('admin.projects.index')->with('message', 'La cancellazione del project '.$project->title.' è andata a buon fine.');
    }
}
?>