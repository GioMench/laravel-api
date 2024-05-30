<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;






class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.projects.index', ['projects' => Project::orderByDesc('id')->paginate(8)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
         //dd($request->all());
        //validate
        $validated = $request->validated();
        $slug = Str::slug($request->project_name, '-');
        $validated['slug'] = $slug;

        //create
        if ($request->has('preview_image')) {
            $image_path = Storage::put('uploads', $validated['preview_image']);
            //dd($image_path);
            $validated['preview_image'] = $image_path;
        };

        $project = Project::create($validated);

        if($request->has('technologies')){
            $project->technologies()->attach($validated['technologies']);
        };
        //redirect
        return to_route('admin.projects.index')->with('message', 'Project created successfully');


    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //dd($request->all());

        //validate
        $validated = $request->validated();
        /*$slug = Str::slug($request->project_name, '-');
        $validated['slug'] = $slug;*/

        if($request->has('preview_image')){
            if($project->preview_image){
                //delete the old image
                Storage::delete($project->preview_image);
            }
            $image_path = Storage::put('uploads', $validated['preview_image']);
            
            $validated['preview_image'] = $image_path;
        }
        //update
        $project->update($validated);

        if($request->has('technologies')){
            $project->technologies()->sync($validated['technologies']);
        } else {
            $project->technologies()->sync([]);
        };

        //redirect
        return to_route('admin.projects.index')->with('message', "Project  $project->project_name update successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
       
        if($project->preview_image){
            //delete the old image
            Storage::delete($project->preview_image);
        }
        $project->delete();
        return to_route('admin.projects.index')->with('message', "Project  $project->project_name delete successfully");
    }
}
