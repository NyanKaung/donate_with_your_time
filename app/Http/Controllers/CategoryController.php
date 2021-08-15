<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     *  GET api/categories
     *  to get all categories
     */
    public function index()
    {
        try {
            $categories = Category::all();
            return response()->json([
                'success' => true,
                'data' => $categories,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }


    /**
     *  POST api/categories
     *  to create a new category
     */
    public function store(CategoryStoreRequest $request)
    {
        try {
            $image = $this->uploadBase64($request->image);

            $category = new Category();
            $category->category_name = $request->name;
            $category->save();
            return response()->json([
                'success' => true,
                'data' => $category,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  GET api/categories/{song}
     *  to show a category
     */
    public function show(Category $category)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => $category,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  PUT/PATCH api/categories/{song}
     *  to update a category
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        try {
            $image = $this->uploadBase64($request->image);

            $category->category_name = $request->name;
            $category->update();
            return response()->json([
                'success' => true,
                'data' => $category,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * DELETE api/categories/{song}
     * to delete a category
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response()->json([
                'success' => true,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
