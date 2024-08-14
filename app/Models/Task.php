<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'is_completed',
        'conveyancing_case_id',
    ];

    /**
     * The conveyancing case that this task belongs to.
     */
    public function conveyancingCase()
    {
        return $this->belongsTo(ConveyancingCase::class);
    }
}