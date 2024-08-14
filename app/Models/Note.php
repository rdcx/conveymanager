<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Note extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'case_id',
        'user_id',
        'note_text',
    ];

    /**
     * The conveyancing case that this note is associated with.
     */
    public function conveyancingCase()
    {
        return $this->belongsTo(ConveyancingCase::class, 'case_id');
    }

    /**
     * The user who created this note.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}