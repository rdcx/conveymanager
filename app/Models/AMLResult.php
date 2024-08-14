<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AMLResult extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'aml_results';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'success',
        'conveyancing_case_id',
        'client_id',
    ];

    /**
     * The conveyancing case that this note is associated with.
     */
    public function conveyancingCase()
    {
        return $this->belongsTo(ConveyancingCase::class);
    }

    /**
     * The client who who this note is associated with.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}