<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use App\Models\SchemeTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchemeController extends Controller
{
    public function get()
    {
        return Scheme::with('schemeTag')->orderBy('id', 'desc')->paginate(10);
    }

    public function getAllWithParam(Request $request)
    {
        $tagName = $request->input('tag_name');

        if ($tagName === 'all') {
            return Scheme::with('schemeTag')->paginate(10);
        }

        $tag = SchemeTags::where('name', $tagName)->first();
        return Scheme::with('schemeTag')->where('scheme_tag_id', $tag->id)->paginate(5);
    }

    public function store(Request $request)
    {
        try {
            $validateSlider = Validator::make(
                $request->all(),
                [
                    'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                    'title' => 'required|min:5',
                    'description' => 'required|min:10',
                    'price' => 'required|min:1',
                    'tag_name' => 'required|min:5',
                ]
            );

            if ($validateSlider->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Помилка валідації даних',
                    'errors' => $validateSlider->errors(),
                ], 422);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalName();
            $image->storeAs('uploads/products/scheme', $imageName, 'public');

            $scheme = new Scheme();
            $scheme->image = $imageName;
            $scheme->title = $request->input('title');
            $scheme->description = $request->input('description');
            $scheme->price = $request->input('price');
            $tag = SchemeTags::where('name', $request->input('tag_name'))->first();
            $scheme->scheme_tag_id = $tag ? $tag->id : 1;
            $scheme->save();

            return response()->json([
                'status' => true,
                'message' => 'Товар успішно додано!',
                'biser' => $scheme,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
