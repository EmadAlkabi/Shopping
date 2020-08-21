<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\ItemDeleted;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class CategoryItemController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy("id")->get();
        $items = Item::where(["category_id" => null, "deleted" => ItemDeleted::FALSE])
            ->orderBy("id")
            ->paginate(250);

        return view("dashboard.category-item.index")->with([
            "categories" => $categories,
            "items"      => $items
        ]);
    }
}
