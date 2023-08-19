<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['name','classroom_id','user_id'];

    public function classworks(): HasMany
    {
        return $this->hasMany(ClassWork::class);
    }
}
