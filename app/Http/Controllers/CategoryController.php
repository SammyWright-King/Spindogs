<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CategoryRepository;
use App\Http\Requests\CategoryRequest;
use Auth;

class CategoryController extends Controller
{
    protected $category_repository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->category_repository = $categoryRepository;
    }

    /**
     * summary of all categories belonging to signed in user
     */
    public function overview()
    {
        $categories = $this->category_repository->getWhere('user_id', Auth::id());

        //check if request has category id contained within
        if(request('category_id')) {
            $category = $this->category_repository->getOne(request('category_id'));

            if($category) {
                return view('category.list', compact('category','categories'));
            }else{
                return back()->with('status', 'Invalid Id');
            }
        }


        return view('category.list', compact('categories'));
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * save or update category
     */
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();

        //check if request has the category id
        if($request->category_id) {
            //update data
            $this->category_repository->edit($request->category_id, $validated);

        }else {
            $validated['user_id'] = Auth::id();

            //save the data to category table
            $this->category_repository->save($validated);
        }

        return redirect()->route('category.list');
    }
}
