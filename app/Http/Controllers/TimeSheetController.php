<?php

namespace App\Http\Controllers;

use App\Models\TimeSheet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimeSheetController extends Controller
{

    public function index(Request $request)
    {

        $timeSheets = $request->user()->timesheets;

        return response(['status' => true, 'message' => 'User Time Sheets data', 'data' => $timeSheets]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|min:3',
            'due_date_time' => 'required|date_format:Y-m-d H:i',
            'project_id' => 'required|numeric|gt:0'
        ]);

        $user = $request->user();

        try {
            DB::beginTransaction();

            $timeSheet = TimeSheet::create([
                'task_name' => $request->task_name,
                'due_date_time' => $request->due_date_time,
                'project_id' => $request->project_id,
                'user_id' => $user->id
            ]);

            DB::commit();

            return response(['status' => true, 'message' => 'Time Sheet added successfully', 'data' => $timeSheet]);
        } catch (Exception $e) {
            DB::rollBack();
            return response(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function show($id)
    {
        $timeSheet = TimeSheet::find($id);

        return response(['status' => true, 'message' => 'Time Sheet fetch successfully', 'data' => $timeSheet]);
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'task_name' => 'required|min:3',
            'due_date_time' => 'required|date_format:Y-m-d H:i'
        ]);


        try {
            DB::beginTransaction();

            $timeSheet = TimeSheet::findOrFail($id);

            $timeSheet->update([
                'task_name' => $request->task_name,
                'due_date_time' => $request->due_date_time
            ]);

            DB::commit();

            return response(['status' => true, 'message' => 'Time Sheet updated successfully', 'data' => $timeSheet]);
        } catch (Exception $e) {
            DB::rollBack();
            return response(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        try {
            TimeSheet::findOrFail($id)->delete();
            return response(['status' => true, 'message' => 'Time Sheet Deleted Successfully']);
        } catch (Exception $e) {
            return response(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
