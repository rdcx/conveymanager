<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConveyancingCase extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'property_id',
        'conveyancer_id',
        'client_id',
        'status',
        'start_date',
        'end_date',
    ];

    /**
     * The property associated with this conveyancing case.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * The conveyancer handling this conveyancing case.
     */
    public function conveyancer()
    {
        return $this->belongsTo(User::class, 'conveyancer_id');
    }

    /**
     * The client involved in this conveyancing case.
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}