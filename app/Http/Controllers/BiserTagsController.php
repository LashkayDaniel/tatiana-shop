<?php

namespace App\Http\Controllers;

use App\Models\BiserTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BiserTagsController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validateSlider = Validator::make(
                $request->all(),
                [
                    'name' => 'required|min:3',
                ]
            );

            if ($validateSlider->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Помилка валідації даних',
                    'errors' => $validateSlider->errors(),
                ], 422);
            }

            $tag = new BiserTags();
            $tag->name = $request->input('name');
            $tag->save();

            return response()->json([
                'status' => true,
                'message' => 'Тег для бісеру успішно додано!',
                'tag' => $tag,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function get()
    {
        return BiserTags::all();
    }

    public function delete($id)
    {
        $tag = BiserTags::find($id);
        return $tag->delete() ?? $tag;
    }
}
