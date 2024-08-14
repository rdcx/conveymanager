<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ConveyancingCase extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'property_id',
        'conveyancer_id',
        'status',
        'start_date',
        'end_date',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($conveyancingCase) {
            $conveyancingCase->ref = strtoupper(Str::random(8));
        });

        static::deleting(function ($conveyancingCase) {
            $conveyancingCase->clients()->detach();
        });
    }

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
    public function clients()
    {
        return $this->belongsToMany(Client::class, 'cases_clients');
    }

    /**
     * The lead client associated with this conveyancing case.
     */
    public function leadClient()
    {
        return $this->clients()->wherePivot('is_lead', true)->first();
    }

    public function amlResults()
    {
        return $this->hasMany(AMLResult::class);
    }

    /**
     * Get the tasks associated with the conveyancing case.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}