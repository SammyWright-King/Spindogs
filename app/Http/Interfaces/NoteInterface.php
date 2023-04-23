<?php

namespace App\Http\Interfaces;

use App\Models\Note;

interface NoteInterface
{
    public function save(array $data);

    public function update($id, array $data);

    public function getNote($note_id, $user_id);

    public function getWhere($key, $value);

    public function addCategory(Note $note, array $data = []);
}
