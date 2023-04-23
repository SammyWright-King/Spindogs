<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CategoryRepository;
use App\Http\Requests\NoteRequest;
use App\Models\Note;
use Auth;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    /**
     * return view with all notes by user
     */
    public function overview()
    {
        //get all notes by authenticated / logged in user
        $notes = $this->note_repository->getWhere('user_id', Auth::id());

        return view('note.list', compact('notes'));
    }

    /**
     * return the create/edit form page
     */
    public function create()
    {
        $categories = $this->category_repository->getWhere('user_id', Auth::id());

        return view('note.form', compact('categories'));
    }

    /**
     *return view with selected note
     */
    public function view()
    {
        $note = $this->note_repository->getNote(request('note_id'), Auth::id());

        $categories = $this->category_repository->getWhere('user_id', Auth::id());

        return view('note.form', compact('note', 'categories'));
    }

    /**
     * @param NoteRequest $request
     * create or update note
     */
    public function store(NoteRequest $request)
    {
        $validated = $request->validated();

        $note = $this->note_repository->getNote(request('note_id'), Auth::id());

        if ($note) {
            $this->note_repository->update($note->id, $validated);

        }else {
            $validated['user_id'] = Auth::id();
            $note = $this->note_repository->save($validated);
        }

        //add categories to note
        $note->categories()->sync($request->category, false);

        return redirect(route('note.list'))->with('status', 'Note Saved');
    }
}
