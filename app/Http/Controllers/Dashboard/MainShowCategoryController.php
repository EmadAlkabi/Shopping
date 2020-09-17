<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\Language;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MainShowCategoryController extends Controller
{
    use ResponseTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::all();
        $mainShowCategories = $categories->filter(function ($category) {
            return ($category->main_show == 1);
        });

        return view("dashboard.main-show-category.index")->with([
            "categories"         => $categories,
            "mainShowCategories" => $mainShowCategories
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
        $categories = Category::all();
        $count = $categories->filter(function ($category) {
            return ($category->main_show == 1);
        })->count();

        if ($count == 4)
            return $this->responseWithMessage(false, ["counter" => __("dashboard/main-show-category.store.counter")]);

        $rules = [
            "category" => ["required", Rule::in($categories->pluck("id")->toArray())]
        ];

        $messages = (app()->getLocale() == Language::ENGLISH)
            ? ["category.required" => "Select category required.",
                "category.in"      => "Category invalid."]
            : ["category.required" => "يرجى اختيار الصنف.",
                "category.in"      => "الصنف غير مقبول."];

        $validation = Validator::make($request->all(), $rules, $messages);

        if (!$validation->passes())
            return $this->responseWithMessage(false, $validation->errors());

        $category = $categories->filter(function ($category) use ($request) {
            return ($category->id == $request->input("category"));
        })->first();

        if ($category->main_show == 1)
            return $this->responseWithMessage(true, [
                "toast" => [
                    "title" => __("dashboard/main-show-category.store.old-add"),
                    "type"  => "info"
                ]
            ]);

        $category->main_show = 1;
        $success = $category->save();

        if (!$success)
            return $this->responseWithMessage(false, [
                "toast" => [
                    "title" => __("dashboard/main-show-category.store.failed"),
                    "type"  => "error"
                ]
            ]);

        return $this->responseWithMessage(true, [
            "toast" => [
                "title" => __("dashboard/main-show-category.store.success"),
                "type"  => "success"
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
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
     * @param $id
     */
    public function update(Request $request, $id)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $category = Category::where([
            "id"        => $id,
            "main_show" => 1
        ])->first();

        if (!$category)
            return $this->responseWithMessage(false, [
                "toast" => [
                    "title" => __("dashboard/main-show-category.delete.not-found"),
                    "type"  => "error"
                ]
            ]);

        $category->main_show = 0;
        $success = $category->save();

        if (!$success)
            return $this->responseWithMessage(false, [
                "toast" => [
                    "title" => __("dashboard/main-show-category.delete.failed"),
                    "type"  => "error"
                ]
            ]);

        return $this->responseWithMessage(true, [
           "toast" => [
               "title" => __("dashboard/main-show-category.delete.success"),
               "type"  => "success"
           ]
        ]);
    }
}
