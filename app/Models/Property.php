<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'address',
        'city',
        'postal_code',
        'country',
        'owner_id',
    ];

    /**
     * The owner of the property.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * The conveyancing cases related to this property.
     */
    public function conveyancingCases()
    {
        return $this->hasMany(ConveyancingCase::class);
    }
}