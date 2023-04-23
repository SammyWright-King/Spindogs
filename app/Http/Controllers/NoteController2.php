<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CategoryRepository;
use App\Http\Requests\NoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController2 extends Controller
{
    protected $category_repository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->category_repository = $categoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * fetch all notes
     */
    public function overview()
    {
        $notes = Note::where('user_id', Auth::id())->get();

        return view(
            'note.list',
            compact(
                'notes'
            )
        );
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * return the create/edit form page
     */
    public function create()
    {
        $categories = $this->category_repository->getWhere('user_id', Auth::id());

        return view('note.form', compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     */
    public function view()
    {
        $note = Note::where('id', request('note_id'))
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $categories = $this->category_repository->getWhere('user_id', Auth::id());

        return view('note.form', compact('note', 'categories'));
    }

    /**
     * @param NoteRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * create or update note
     */
    public function store(NoteRequest $request)
    {
        $validated = $request->validated();

        $note = Note::where('id', request('note_id'))
            ->where('user_id', Auth::id())
            ->first();

        if (!$note) {
            $note = new Note();
        }

        $validated['user_id'] = Auth::id();
        $note->fill($validated);
        $note->save();

        //add categories to note
        $note->categories()->sync($request->category, false);

        return redirect(route('note.list'))->with('status', 'Note Saved');
    }
}
