<?php

namespace App\Http\Controllers;

use App\Models\Vishivanki;
use App\Models\VishivankiTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VishivankiController extends Controller
{
    public function get()
    {
        return Vishivanki::with('vishivankiTag')->orderBy('id', 'desc')->paginate(10);
//        $vis = VishivankiTags::find(1);
//        return $vis->vishivanki;
    }

    public function getAllWithParam(Request $request)
    {
        $tagName = $request->input('tag_name');

        if ($tagName === 'all') {
            return Vishivanki::with('vishivankiTag')->paginate(10);
        }

        $tag = VishivankiTags::where('name', $tagName)->first();
        return Vishivanki::with('vishivankiTag')->where('vishivanki_tag_id', $tag->id)->paginate(5);
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
            $image->storeAs('uploads/products/vishivanki', $imageName, 'public');

            $vishivanka = new Vishivanki();
            $vishivanka->image = $imageName;
            $vishivanka->title = $request->input('title');
            $vishivanka->description = $request->input('description');
            $vishivanka->price = $request->input('price');
            $tag = VishivankiTags::where('name', $request->input('tag_name'))->first();
            $vishivanka->vishivanki_tag_id = $tag ? $tag->id : $request->input('tag_id');
            $vishivanka->save();

            return response()->json([
                'status' => true,
                'message' => 'Товар успішно додано!',
                'vishivanka' => $vishivanka,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $vishivankaModel = Vishivanki::find($id);
            if ($vishivankaModel) {
                $deletedImageName = $vishivankaModel->image;
                $imageName = 'uploads/products/vishivanki/' . $deletedImageName;
                if (Storage::disk('public')->exists($imageName)) {
                    Storage::disk('public')->delete($imageName);
                }
                $vishivankaModel->delete();
            }

            return response()->json([
                'status' => true,
                'message' => 'Товар успішно видалено!',
                'biser' => $vishivankaModel,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
