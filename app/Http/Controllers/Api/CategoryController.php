<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoriesCollection;
use App\Http\Resources\Category\CategoriesCollectionTree;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ResponseTrait;

    public function index(Request $request)
    {
        $category = $request->input("category", null);
        $categories = Category::where("parent_id", $category)->get();

        return $this->simpleResponse(CategoriesCollection::collection($categories));
    }

    public function tree()
    {
        $categories = Category::all();
        $categories = self::buildTree($categories, null);

        return $this->simpleResponse(CategoriesCollectionTree::collection($categories));
    }

    public static function buildTree (Collection $elements, $parentId = null)
    {
        $branch = new Collection();
        foreach ($elements as $element)
            if ($element->parent_id == $parentId) {
                $children = self::buildTree($elements, $element->id);
                if (!$children->isEmpty())
                    $element["children"] = $children;
                $branch->push($element);
                $elements->forget($element->id);
            }
        return $branch;
    }
}
