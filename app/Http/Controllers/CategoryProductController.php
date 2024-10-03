<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestStoreCategoryProduct;
use App\Http\Requests\RequestUpdateCategoryProduct;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    public function getCategoryProducts()
    {
        try {
            $categories = CategoryProduct::with('product')->get();
            return $this->buildResponse(200, "Success", compact('categories'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }

    public function storeCategoryProduct(RequestStoreCategoryProduct $req)
    {
        try {
            $category = CategoryProduct::create($req->all());
            return $this->buildResponse(200, "Success", compact('category'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }

    public function updateCategoryProduct(RequestUpdateCategoryProduct $req)
    {
        try {
            $category = CategoryProduct::where('id', $req->input('id'))->firstOrFail();
            $category->update([
                'name' => $req->input('name', $category->name),
                'description' => $req->input('description', $category->description),
            ]);
            return $this->buildResponse(200, "Success", compact('category'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }

    public function deleteCategoryProduct(Request $req)
    {
        try {
            $category = CategoryProduct::where('id', $req->input('id'))->firstOrFail();
            $category->delete();
            return $this->buildResponse(200, "Success", null);
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }
}
