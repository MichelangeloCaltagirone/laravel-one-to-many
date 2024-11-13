<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectsRequest;
use App\Http\Requests\UpdateProjectsRequest;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return view("admin.projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("admin.projects.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectsRequest $request)
    {
        $request->validated();

        $projectData = $request->all();

        $newProject = new Project();
        $newProject->name = $projectData["name"];
        $newProject->category_id = $projectData["category_id"];
        $newProject->author = $projectData["author"];
        $newProject->description = $projectData["description"];

        $newProject->save();
        // $project = Project::create(); da usare se compilate le fillable nel Model(da fare)

        return redirect()->route("admin.projects.show", [ "id"=> $newProject->id] );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::findOrFail($id);
        return view("admin.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);
        $categories = Category::all();

        return view("admin.projects.edit", compact("project", "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectsRequest $request, string $id)
    {
        $request->validated();

        $newData = $request->all();

        $project = Project::findOrFail($id);
        $project->name = $newData["name"];
        $project->category_id = $newData["category_id"];
        $project->author = $newData["author"];
        $project->description = $newData["description"];

        $project->save();

        return redirect()->route("admin.projects.show", [ "id"=> $project->id] );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route("admin.projects.index");
    }
}
