<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{

    public function index()
    {
        $attributes = Attribute::all();

        return response(['status' => true, 'message' => 'Attributes', 'data' => $attributes]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'type' => 'required|in:text,date,number,select'
        ]);

        try {
            DB::beginTransaction();

            $attribute = Attribute::create([
                'name' => $request->name,
                'type' => $request->type
            ]);

            DB::commit();

            return response(['status' => true, 'message' => 'Attribute added successfully', 'data' => $attribute]);
        } catch (Exception $e) {
            DB::rollBack();
            return response(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function show($id)
    {
        $attribute = Attribute::find($id);

        return response(['status' => true, 'message' => 'Attribute fetch successfully', 'data' => $attribute]);
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'type' => 'required|in:text,date,number,select'
        ]);


        try {
            DB::beginTransaction();

            $attribute = Attribute::findOrFail($id);

            $attribute->update([
                'name' => $request->name,
                'type' => $request->type
            ]);

            DB::commit();

            return response(['status' => true, 'message' => 'Attribute updated successfully', 'data' => $attribute]);
        } catch (Exception $e) {
            DB::rollBack();
            return response(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        try {
            Attribute::findOrFail($id)->delete();
            return response(['status' => true, 'message' => 'Attribute Deleted Successfully']);
        } catch (Exception $e) {
            return response(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
