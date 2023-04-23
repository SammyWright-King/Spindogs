<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * Categories the note belongs to
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'notes_categories', 'note_id');
    }
}
