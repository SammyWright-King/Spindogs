<?php

namespace App\Http\Interfaces;

interface CategoryInterface
{
    /**
     * @return mixed
     * save to category table
     */
    public function save(array $data);

    /**
     * @param array $data
     * @return Category
     * edit record in the category table
     */
    public function edit($id, array $data);

    /**
     * @param $id
     * @return mixed
     */
    public function getOne($id);

    /**
     * @param $key
     * @param $value
     * @return mixed
     * return categories where key and value match
     */
    public function getWhere($key, $value);
}
