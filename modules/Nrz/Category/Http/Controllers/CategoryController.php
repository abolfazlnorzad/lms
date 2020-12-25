<?php

namespace Nrz\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory as FactoryAlias;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Nrz\Category\Http\Requests\CategoryRequest;
use Nrz\Category\Model\Category;
use Nrz\Category\Repo\CategoryRepo;
use Nrz\Category\Response\AjaxResponse;

class CategoryController extends Controller
{
    public $repo;

    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->repo = $categoryRepo;
    }

    public function index()
    {
        $categories = $this->repo->allCategory();
        return view('Category::index', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CategoryRequest $request)
    {

        $this->repo->storeCategory($request);

        return redirect(route('categories.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Application|FactoryAlias|\Illuminate\Contracts\View\View
     */
    public function edit(Category $category)
    {
        $categories = $this->repo->allCategoryException($category);

        return view('Category::edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return Application|RedirectResponse|Redirector
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->all();
        $this->repo->updateCategory($category, $data);
        return redirect(route('categories.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Application|RedirectResponse|Redirector
     */
    public function destroy(Category $category)
    {
        $this->repo->deleteCategory($category);
        AjaxResponse::success();

    }
}
