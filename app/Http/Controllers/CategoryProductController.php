<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    public function getCategoryProducts()
    {
        try {
            return $this->buildResponse(200, "Success", compact('categories'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }

    public function storeCategoryProduct()
    {
        try {
            return $this->buildResponse(200, "Success", compact('category'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }

    public function updateCategoryProduct()
    {
        try {
            return $this->buildResponse(200, "Success", compact('category'));
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }

    public function deleteCategoryProduct()
    {
        try {
            return $this->buildResponse(200, "Success", null);
        } catch (\Exception $e) {
            return $this->buildResponse(500, "Internal Server Error", ['error' => $e->getMessage()]);
        }
    }
}
