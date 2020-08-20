<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateCategoryRequest;
use App\Http\Requests\Dashboard\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        switch ($request->input("f")) {
            case "all":
                $categories = Category::orderBy("id")->get();
                break;
            case "main":
                $categories = Category::whereNull("parent_id")
                    ->orderBy("id")
                    ->get();
                break;
            case "sub":
                $categories = Category::whereNotNull("parent_id")
                    ->orderBy("id")
                    ->get();
                break;
            default:
                $categories = Category::orderBy("id")->get();
        }

        return view("dashboard.category.index")->with([
            "categories" => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view("dashboard.category.create")->with([
            "categories" => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = Category::create([
            "name"      => $request->input("name"),
            "image"     => ($request->file("image"))
                ? Storage::put("public/category", $request->file("image"))
                : null,
            "parent_id" => $request->input("parent", null)
        ]);

        if (!$category)
            return redirect()
                ->back()
                ->exceptInput()
                ->with([
                    "message" => __("dashboard/category.store.failed"),
                    "type"    => "warning"
                ]);

        return redirect()
            ->back()
            ->with([
                "message" => __("dashboard/category.store.success"),
                "type"    => "success"
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     */
    public function show(Category $category)
    {
       return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|Factory|View
     */
    public function edit(Category $category)
    {
        return view("dashboard.category.edit")->with([
            "category"   => $category,
            "categories" => Category::where("id", "!=", $category->id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        switch ($request->input("update")) {
            case "info":
                $data = [
                    "name"      => $request->input("name"),
                    "parent_id" => $request->input("parent")
                ];
                break;
            case "image":
                $image = $category->image;
                if($request->input("deleted") || $request->file("image")) {
                    Storage::delete($image);
                    $image  = null;
                }
                $data = [
                    "image" => is_null($request->file("image"))
                        ? $image
                        : Storage::put("public/category", $request->file("image"))
                ];
                break;
            default: $data = array();
        }
        Category::where("id", $category->id)->update($data);

        if (!$category)
            return redirect()
                ->back()
                ->with([
                    "message" => __("dashboard/category.update.failed"),
                    "type"    => "warning"
                ]);

        return redirect()
            ->back()
            ->with([
                "message" => __("dashboard/category.update.success"),
                "type"    => "success"
            ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     */
    public function destroy(Category $category)
    {
        return abort(404);
    }
}
