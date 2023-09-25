<?php

namespace App\Models;

use App\Traits\HasPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory,HasPrice;

    protected $fillable = [
        'name',
        'slug',
        'stripe_plan',
        'price',
        'description',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

}
