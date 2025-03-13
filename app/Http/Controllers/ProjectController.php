<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\UserProject;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{

    public function index(Request $request)
    {

        $projects = $request->user()->projects;

        return response(['status' => true, 'message' => 'User projects data', 'data' => $projects]);
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'status' => 'required|in:pending,in process,completed'
        ]);

        $user = $request->user();

        try {
            DB::beginTransaction();

            $project = Project::create([
                'name' => $request->name,
                'status' => $request->status
            ]);

            $user->projects()->attach($project->id);

            DB::commit();

            return response(['status' => true, 'message' => 'Project added successfully', 'data' => $project]);
        } catch (Exception $e) {
            DB::rollBack();
            return response(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function show($id)
    {

        $project = Project::find($id);

        return response(['status' => true, 'message' => 'Project fetch', 'data' => $project]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'status' => 'required|in:pending,in process,completed'
        ]);

        try {


            $project = Project::find($id);

            DB::beginTransaction();
            $project->update([
                'name' => $request->name,
                'status' => $request->status
            ]);
            Db::commit();
            return response(['status' => true, 'message' => 'Project Updated Successfully', 'data' => $project]);
        } catch (Exception $e) {

            DB::rollBack();
            return response(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        try {
            Project::findOrFail($id)->delete();
            return response(['status' => true, 'message' => 'Project Deleted Successfully']);
        } catch (Exception $e) {
            return response(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
