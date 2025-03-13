<?php

namespace App\Http\Controllers;

use App\Models\AttributeValue;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeValueController extends Controller
{

    public function index()
    {
        $attributes = AttributeValue::all();

        return response(['status' => true, 'message' => 'Attribute Values', 'data' => $attributes]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'attribute_id' => 'required|numeric|gt:0',
            'project_id' => 'required|numeric|gt:0',
            'value' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $attributeValue = AttributeValue::create([
                'attribute_id' => $request->attribute_id,
                'project_id' => $request->project_id,
                'value' => $request->value
            ]);

            DB::commit();

            return response(['status' => true, 'message' => 'Attribute Value added successfully', 'data' => $attributeValue]);
        } catch (Exception $e) {
            DB::rollBack();
            return response(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function show($id)
    {
        $attributeValue = AttributeValue::find($id);

        return response(['status' => true, 'message' => 'Attribute Value fetch successfully', 'data' => $attributeValue]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'attribute_id' => 'required|numeric|gt:0',
            'project_id' => 'required|numeric|gt:0',
            'value' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $attributeValue = AttributeValue::findOrFail($id);

            $attributeValue->update([
                'attribute_id' => $request->attribute_id,
                'project_id' => $request->project_id,
                'value' => $request->value
            ]);

            DB::commit();

            return response(['status' => true, 'message' => 'Attribute Value added successfully', 'data' => $attributeValue]);
        } catch (Exception $e) {
            DB::rollBack();
            return response(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function destroy($id)
    {
        try {
            AttributeValue::findOrFail($id)->delete();
            return response(['status' => true, 'message' => 'Attribute Value Deleted Successfully']);
        } catch (Exception $e) {
            return response(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
