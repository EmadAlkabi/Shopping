<?php

namespace App\Http\Controllers\Dashboard\Item;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ItemController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $q = \request()->input('q');
        $vendor = 1;
        switch ($q) {
            case "all":
                $items = Item::where('vendor_id', $vendor)->get();
                break;
            case "categorized":
                $items = Item::where('vendor_id', $vendor)
                    ->whereNotNull('category_id')
                    ->where('deleted', 0)
                    ->get();
                break;
            case "un-categorized":
                $items = Item::where('vendor_id', $vendor)
                    ->whereNull('category_id')
                    ->where('deleted', 0)
                    ->get();
                break;
            case "deleted":
                $items = Item::where('vendor_id', $vendor)
                    ->where('deleted', 1)
                    ->get();
                break;
            default: $items = array();
        }

        return view('dashboard.item.index')->with([
            "q" => $q,
            "items" => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
