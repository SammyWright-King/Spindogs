<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Repositories\CategoryRepository;
use App\Http\Repositories\NoteRepository;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $category_repository;
    protected $note_repository;

    public function __construct(CategoryRepository $categoryRepository,
                                NoteRepository $noteRepository)
    {
        $this->category_repository = $categoryRepository;
        $this->note_repository = $noteRepository;
    }
}
