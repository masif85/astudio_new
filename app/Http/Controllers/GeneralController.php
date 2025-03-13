<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function search(Request $request)
    {
        $request->validate([
            'name' => 'nullable',
            'status' => 'nullable|in:pending, in process, completed'
        ]);

        $filter = [];
        $filter['name'] = $request->name;
        $filter['status'] = $request->status;

        $result = Project::filter($filter);

        return response(['status' => true, 'message' => 'Data fetch successfully', 'data' => $result]);
    }
}
