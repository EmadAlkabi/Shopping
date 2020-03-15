<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponseTrait;

    public function index() {
        $categories = Category::all();

        if (!$categories)
            return $this->notFoundResponse();

        $categories = self::buildTree($categories, null);

        return $this->apiResponse($categories, 200, false);
    }

    public static function buildTree (Collection $elements, $parentId = null)
    {
        $branch = new Collection();

        foreach ($elements as $element)
        {
            if ($element->parent_id == $parentId)
            {
                $children = self::buildTree($elements, $element->id);
                if (! $children->isEmpty())
                {
                    $element['children'] = $children;
                }
                $branch->push($element);

                $elements->forget($element->id);
            }
        }
        return $branch;
    }
}
