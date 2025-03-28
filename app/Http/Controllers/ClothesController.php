<?php

namespace App\Http\Controllers;

use App\Models\Clothes;
use App\Models\ClothesTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ClothesController extends Controller
{
    public function get()
    {
        return Clothes::with('clothesTag')->orderBy('id', 'desc')->paginate(10);
    }

    public function getAllWithParam(Request $request)
    {
        $tagName = $request->input('tag_name');

        if ($tagName === 'all') {
            return Clothes::with('clothesTag')->orderBy('id', 'desc')->paginate(10);
        }

        $tag = ClothesTags::where('name', $tagName)->first();
        return Clothes::with('clothesTag')->where('clothes_tag_id', $tag->id)->paginate(5);
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
            $image->storeAs('uploads/products/clothes', $imageName, 'public');

            $clothes = new Clothes();
            $clothes->image = $imageName;
            $clothes->title = $request->input('title');
            $clothes->description = $request->input('description');
            $clothes->price = $request->input('price');
            $tag = ClothesTags::where('name', $request->input('tag_name'))->first();//find('));
            $clothes->clothes_tag_id = $tag ? $tag->id : 1;
            $clothes->save();

            return response()->json([
                'status' => true,
                'message' => 'Товар успішно додано!',
                'biser' => $clothes,
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
                $newImage->storeAs('uploads/products/clothes', $imageName, 'public');
                $oldImagePath = 'uploads/products/clothes/' . $oldImageName;
                if (Storage::disk('public')->exists($oldImagePath)) {
                    Storage::disk('public')->delete($oldImagePath);
                }
            } else {
                $imageName = $oldImageName;
            }

            $product = Clothes::find($id);
            $product->image = $imageName;
            $product->title = $request->input('title');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->save();

            return response()->json([
                'status' => true,
                'message' => 'Товар успішно оновлено!',
                'clothes' => $product,
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
            $clothesModel = Clothes::find($id);
            if ($clothesModel) {
                $deletedImageName = $clothesModel->image;
                $imageName = 'uploads/products/clothes/' . $deletedImageName;
                if (Storage::disk('public')->exists($imageName)) {
                    Storage::disk('public')->delete($imageName);
                }
                $clothesModel->delete();
            }

            return response()->json([
                'status' => true,
                'message' => 'Товар успішно видалено!',
                'biser' => $clothesModel,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
