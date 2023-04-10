<?php

namespace App\Http\Controllers;

use App\Models\Biser;
use App\Models\BiserTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BiserController extends Controller
{
    public function get()
    {
        return Biser::with('biserTag')->orderBy('id', 'desc')->paginate(10);
//        $vis = VishivankiTags::find(1);
//        return $vis->vishivanki;
    }

    public function getAllWithParam(Request $request)
    {
        $tagName = $request->input('tag_name');

        if ($tagName === 'all') {
            return Biser::with('biserTag')->paginate(10);
        }

        $tag = BiserTags::where('name', $tagName)->first();
        return Biser::with('biserTag')->where('biser_tag_id', $tag->id)->paginate(5);
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
            $image->storeAs('uploads/products/biser', $imageName, 'public');

            $biser = new Biser();
            $biser->image = $imageName;
            $biser->title = $request->input('title');
            $biser->description = $request->input('description');
            $biser->price = $request->input('price');
            $tag = BiserTags::where('name', $request->input('tag_name'))->first();//find('));
            $biser->biser_tag_id = $tag ? $tag->id : 1;
            $biser->save();

            return response()->json([
                'status' => true,
                'message' => 'Товар успішно додано!',
                'biser' => $biser,
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
            $biserModel = Biser::find($id);
            if ($biserModel) {
                $deletedImageName = $biserModel->image;
                $imageName = 'uploads/products/biser/' . $deletedImageName;
                if (Storage::disk('public')->exists($imageName)) {
                    Storage::disk('public')->delete($imageName);
                }
                $biserModel->delete();
            }

            return response()->json([
                'status' => true,
                'message' => 'Товар успішно видалено!',
                'biser' => $biserModel,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
