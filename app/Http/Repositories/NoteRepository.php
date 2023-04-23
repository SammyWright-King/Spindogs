<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\NoteInterface;
use App\Models\Note;

class NoteRepository implements NoteInterface
{
    /**
     * @param array $data
     * save new note
     */
    public function save(array $data)
    {
        return Note::create($data);
    }

    public function update($id, array $data)
    {
        $note = Note::find($id);
        $note->fill($data);
        $note->update();
    }


    public function getNote($note_id, $user_id)
    {
        return Note::where('id', $note_id)
                    ->where('user_id', $user_id)->first();
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     * get note where key is value
     */
    public function getWhere($key, $value)
    {
        return Note::where($key, $value)->latest()->get();
    }

    /**
     * @param Note $note
     * @param array $data
     * @return array
     * add multiple categories to a note
     */
    public function addCategory(Note $note, array $data = [])
    {
        return $note->categories()->sync($data, false);
    }
}
