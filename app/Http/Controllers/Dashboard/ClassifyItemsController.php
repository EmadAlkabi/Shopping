<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\ItemDeleted;
use App\Enum\Language;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ClassifyItemsController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::orderBy("id")->get();
        $items = Item::where(["category_id" => null, "deleted" => ItemDeleted::FALSE])
            ->orderBy("id")
            ->paginate(250);

        return view("dashboard.classify-items.index")->with([
            "categories" => $categories,
            "items"      => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            "items"    => ["required"],
            "category" => ["required", Rule::in(Category::all()->pluck("id")->toArray())]
        ];
        $messages = (app()->getLocale() == Language::ENGLISH)
            ? ["items.required"    => "Please add some items.",
                "category.required" => "Select category required.",
                "category.in"       => "Category invalid."]
            : ["items.required"    => "يرجى اضافة بعض المواد",
                "category.required" => "يرجى اختيار الصنف.",
                "category.in"       => "الصنف غير مقبول."];

        $validation = Validator::make($request->all(), $rules, $messages);

        if (!$validation->passes())
            return $this->responseWithMessage(false, $validation->errors());

        $category = $request->input("category");
        $items = Item::where("vendor_id", 1)
            ->whereIn("id", $request->input("items"))
            ->get();

        $exception = DB::transaction(function () use ($items, $category) {
            $items->map(function ($item) use ($category) {
                $item->category_id = $category;
                $item->save();
            });
        });

        if ($exception)
            return $this->responseWithMessage(true, [
                "title" => __("dashboard/classify-items.store.failed"),
                "type"  => "error"
            ]);

        return $this->responseWithMessage(true, [
            "title" => __("dashboard/classify-items.store.success"),
            "type"  => "success"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     */
    public function edit($id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        abort(404);
    }
}
