<?php


namespace Nrz\Category\Repo;


use Nrz\Category\Model\Category;

class CategoryRepo
{

    public function allCategory()
    {
        return Category::all();
    }

    public function storeCategory($request)
    {
        return Category::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
        ]);
    }


    public function allCategoryException($category)
    {
        return Category::query()->where('id', '!=', $category->id)->get();
    }

    public function updateCategory($category, $data)
    {
        return $category->update($data);
    }

    public function deleteCategory($category)
    {
        return $category->delete();
    }

    public function findById($id)
    {
        return Category::query()->whereId($id)->first();
    }

}
