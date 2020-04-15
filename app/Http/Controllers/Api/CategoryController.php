<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $category = (integer)request()->input("category", 0);
        $childrenOfCategory = ($category == 0)
            ? Category::where("parent_id", null)->get()
            : Category::where("parent_id", $category)->get();

        return response()->json([
            "data" => $childrenOfCategory,
            "status" => true,
            "error" => false
        ]);
    }

    public function tree() {
        $categories = Category::all();
        $categories = self::buildTree($categories, null);

        return response()->json([
            "data" => $categories,
            "status" => true,
            "error" => false
        ]);
    }

    public static function buildTree (Collection $elements, $parentId = null)
    {
        $branch = new Collection();
        foreach ($elements as $element)
            if ($element->parent_id == $parentId) {
                $children = self::buildTree($elements, $element->id);
                if (!$children->isEmpty())
                    $element['children'] = $children;

                $branch->push($element);
                $elements->forget($element->id);
            }
        return $branch;
    }
}
