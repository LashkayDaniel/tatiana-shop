<?php

namespace App\Http\Controllers;

use App\Models\ClothesTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClothesTagsController extends Controller
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

            $tag = new ClothesTags();
            $tag->name = $request->input('name');
            $tag->save();

            return response()->json([
                'status' => true,
                'message' => 'Тег для Одягу успішно додано!',
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
        return ClothesTags::all();
    }

    public function delete($id)
    {
        $tag = ClothesTags::find($id);
        return $tag->delete() ?? $tag;
    }
}
