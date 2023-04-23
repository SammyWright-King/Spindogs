<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CategoryRepository;
use App\Http\Requests\NoteRequest;
use App\Models\Note;
use Auth;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    protected $category_repository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->category_repository = $categoryRepository;
    }

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

    public function create()
    {
        $categories = $this->category_repository->getWhere('user_id', Auth::id());

        return view('note.form', compact('categories'));
    }

    public function view()
    {
        $note = Note::where('id', request('note_id'))
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $categories = $this->category_repository->getWhere('user_id', Auth::id());

        return view(
            'note.form',
            compact('note', 'categories')
        );
    }

    public function view2()
    {
        $note = Note::where('id', request('note_id'))
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view(
            'note.form',
            compact('note')
        );
    }

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

        $note->categories()->sync($request->category, false);

        return redirect(route('note.list'))->with('status', 'Note Saved');
    }
}
