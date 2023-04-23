<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\CategoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryInterface
{
    /**
     * @param array $data
     * @return Category
     * save category to table
     */
    public function save(array $data)
    {
        Category::firstOrCreate($data);
    }

    /**
     * @param array $data
     * @return Category
     * edit record in category table
     */
    public function edit($id, array $data)
    {
        Category::where('id', $id)
                        ->update($data);
    }

    /**
     * @param $id
     * @return mixed
     * get one category at a time
     */
    public function getOne($id)
    {
        return Category::find($id);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     * return all categories where key and value match
     */
    public function getWhere($key, $value)
    {
        return Category::where($key, $value)->latest()->get();
    }
}
