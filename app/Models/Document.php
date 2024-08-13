<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'case_id',
        'file_path',
        'file_name',
        'uploaded_by',
        'document_type',
    ];

    /**
     * The conveyancing case that this document is associated with.
     */
    public function conveyancingCase()
    {
        return $this->belongsTo(ConveyancingCase::class, 'case_id');
    }

    /**
     * The user who uploaded this document.
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}