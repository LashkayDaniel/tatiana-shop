<?php

namespace App\Http\Controllers;

use App\Models\Scheme;
use App\Models\SchemeTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            return Scheme::with('schemeTag')->orderBy('id', 'desc')->paginate(10);
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

    public function edit(Request $request, $id)
    {
        try {
            $validateSlider = Validator::make(
                $request->all(),
                [
                    'old_image' => 'min:5',
                    'new_image' => 'image|mimes:jpeg,png,jpg|max:2048',
                    'title' => 'required|min:5',
                    'description' => 'required|min:10',
                    'price' => 'required|min:1',
                ]
            );

            if ($validateSlider->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Помилка валідації даних',
                    'errors' => $validateSlider->errors(),
                ], 422);
            }

            $newImage = $request->file('new_image');
            $oldImageName = $request->input('old_image');

            if ($newImage) {
                $imageName = time() . '.' . $newImage->getClientOriginalName();
                $newImage->storeAs('uploads/products/scheme', $imageName, 'public');
                $oldImagePath = 'uploads/products/scheme/' . $oldImageName;
                if (Storage::disk('public')->exists($oldImagePath)) {
                    Storage::disk('public')->delete($oldImagePath);
                }
            } else {
                $imageName = $oldImageName;
            }

            $product = Scheme::find($id);
            $product->image = $imageName;
            $product->title = $request->input('title');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->save();

            return response()->json([
                'status' => true,
                'message' => 'Товар успішно оновлено!',
                'scheme' => $product,
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
            $schemeModel = Scheme::find($id);
            if ($schemeModel) {
                $deletedImageName = $schemeModel->image;
                $imageName = 'uploads/products/scheme/' . $deletedImageName;
                if (Storage::disk('public')->exists($imageName)) {
                    Storage::disk('public')->delete($imageName);
                }
                $schemeModel->delete();
            }

            return response()->json([
                'status' => true,
                'message' => 'Товар успішно видалено!',
                'biser' => $schemeModel,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
