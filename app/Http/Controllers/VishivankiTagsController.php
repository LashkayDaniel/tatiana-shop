<?php

namespace App\Http\Controllers;

use App\Models\VishivankiTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VishivankiTagsController extends Controller
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

            $tag = new VishivankiTags();
            $tag->name = $request->input('name');
            $tag->save();

            return response()->json([
                'status' => true,
                'message' => 'Тег для вишиванок успішно додано!',
                'tag' => $tag,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function get(){
        return VishivankiTags::all();
    }
}
