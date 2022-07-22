<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category\LoadService;
use App\Service\Auth\LoginService;
use App\Services\Category\CreateCategory;
use App\Services\Category\DeleteService;
use App\Services\Category\ShowService;
use App\Services\Category\UpdateService;

class CategoryController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('show','store','update','destroy');
        $this->middleware('can:delete, category')->only('destroy'); // $this->middleware('can:_ชื่อ function ของ policy_, _ชื่อModel_')->only('_ชื่อ method ในไฟล์นี้_');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $LoadCategory = new LoadService();
        return $LoadCategory->load();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new CreateCategory($request->all());
        return $data->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $showCategory = new ShowService($category);
        return $showCategory->show();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $updateCategory = new UpdateService($request->all(), $category);
        return $updateCategory->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $delData = new DeleteService($category);
        return $delData->delete();
    }
}
