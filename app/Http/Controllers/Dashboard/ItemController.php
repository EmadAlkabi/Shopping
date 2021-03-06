<?php

namespace App\Http\Controllers\Dashboard;

use App\Enum\ItemDeleted;
use App\Enum\MediaItemType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateItemRequest;
use App\Http\Requests\Dashboard\UpdateItemRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\MediaItem;
use App\Models\Unit;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware("dashboard.auth");
        $this->middleware("dashboard.role:Item");
        $this->middleware("filter:item-f")->only(["index"]);
        $this->middleware("filter:item-c")->only(["index"]);

        $this->middleware("getCurrentVendor");
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $vendor = $request->vendor->id;
        $filter = $request->input("f", "all");
        $category = $request->input("c");
        switch ($filter) {
            case "all":
                $items = ($category)
                    ? Item::select(["id", "name", "deleted"])
                        ->where([
                            "vendor_id"   => $vendor,
                            "category_id" => $category
                        ])
                        ->latest("id")
                        ->get()
                    : Item::select(["id", "name", "deleted"])
                        ->where("vendor_id", $vendor)
                        ->latest("id")
                        ->get();;
                break;
            case "deleted":
                $items = ($category)
                    ? Item::select(["id", "name", "deleted"])
                        ->where([
                            "vendor_id"   => $vendor,
                            "category_id" => $category,
                            "deleted"     => ItemDeleted::TRUE
                        ])
                        ->latest()
                        ->get()
                    : Item::select(["id", "name", "deleted"])
                        ->where([
                            "vendor_id"   => $vendor,
                            "deleted"     => ItemDeleted::TRUE
                        ])
                        ->latest()
                        ->get();
                break;
        }

        return view("dashboard.item.index")->with([
            "f"          => $filter,
            "c"          => $category,
            "items"      => $items ?? [],
            "categories" => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view("dashboard.item.create")->with([
            "categories" => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateItemRequest $request
     * @return RedirectResponse
     */
    public function store(CreateItemRequest $request)
    {
        $exception = DB::transaction(function () use ($request) {
            // Item
            $item = Item::create([
                "vendor_id"   => session()->get("dashboard.admin.vendor"),
                "offline_id"  => null,
                "name"        => $request->input("name"),
                "public_name" => $request->input("publicName"),
                "company"     => $request->input("company"),
                "tags"        => $request->input("tags"),
                "details"     => $request->input("details"),
                "barcode"     => $request->input("barcode"),
                "code"        => $request->input("code"),
                "currency"    => $request->input("currency"),
                "category_id" => $request->input("category"),
                "deleted"     => ItemDeleted::FALSE
            ]);

            // Units
            for ($i=3; $i >= 1; $i--) {
                if ($request->input("unit-$i"))
                    $unit = Unit::create([
                        "item_id"    => $item->id,
                        "offline_id" => null,
                        "quantity"   => $request->input("quantity-$i"),
                        "name"       => $request->input("name-$i"),
                        "price"      => $request->input("price-$i"),
                        "content"    => $request->input("content-$i"),
                        "child_id"   => $unit->id ?? null,
                        "main"       => ($request->input("mainUnit") == $request->input("unit-$i"))
                    ]);
            }

            // Main Image
            MediaItem::create([
                "item_id"    => $item->id,
                "type"       => MediaItemType::IMAGE,
                "url"        => Storage::put("public/item", $request->file("mainImage")),
                "main"       => 0
            ]);

            // Other Images
            if ($request->file("otherImages")) {
                foreach ($request->file("otherImages") as $file)
                    MediaItem::create([
                        "item_id"    => $item->id,
                        "type"       => MediaItemType::IMAGE,
                        "url"        => Storage::put("public/item", $file),
                        "main"       => 0
                    ]);
            }

            // Video
            if ($request->input("video"))
                MediaItem::create([
                        "item_id"    => $item->id,
                        "type"       => MediaItemType::VIDEO,
                        "url"        => $request->input("video"),
                        "main"       => 0
                    ]);
        });

        if ($exception)
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    "message" => __("dashboard/item.store.failed"),
                    "type"    => "success"
                ]);

        return redirect()
            ->back()
            ->with([
                "message" => __("dashboard/item.store.success"),
                "type"    => "success"
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return Response
     */
    public function show(Item $item)
    {
        return "OK";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Item $item
     * @return Application|Factory|View
     */
    public function edit(Item $item)
    {
        return "OK";

        return view("dashboard.item.edit")->with([
            "categories" => Category::all(),
            "item" => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateItemRequest $request
     * @param Item $item
     * @return RedirectResponse
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $state = $item = Item::where("id", $item->id)->update([
            "name"        => $request->input("name"),
            "company"     => $request->input("company"),
            "tags"        => $request->input("tags"),
            "details"     => $request->input("details"),
            "barcode"     => $request->input("barcode"),
            "code"        => $request->input("code"),
            "currency"    => $request->input("currency"),
            "price"       => $request->input("price"),
            "unit"        => $request->input("unit"),
            "quantity"    => $request->input("quantity"),
            "category_id" => $request->input("category")
        ]);

        return redirect()
            ->back()
            ->with([
                "message" => __("dashboard/item.update.$state"),
                "type"    => ($state)? "success" : "warning"
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @return void
     */
    public function destroy(Item $item)
    {
        abort(404);
    }

    /**
     * Change deleted for the specified resource in storage.
     *
     * @return RedirectResponse
     */
    public function changeDeleted() {
        $item = Item::findorFail(request()->input("id"));
        self::checkView($item);
        $item->deleted = ((integer)request()->input("deleted") == ItemDeleted::TRUE)
            ? ItemDeleted::TRUE
            : ItemDeleted::FALSE;
        $success = $item->save();

        if (!$success)
            return redirect()
                ->back()
                ->with([
                    "message" => __("dashboard/item.change-deleted.failed-$item->deleted"),
                    "type"    => "warning"
                ]);

        return redirect()
            ->back()
            ->with([
                "message" => __("dashboard/item.change-deleted.success-$item->deleted"),
                "type"    => "success"
            ]);
    }

    /**
     * Check permission to view the specified resource.
     *
     * @param Item $item
     */
    public static function checkView(Item $item) {
        if ($item->vendor_id != 1)
            abort(404);
    }
}
