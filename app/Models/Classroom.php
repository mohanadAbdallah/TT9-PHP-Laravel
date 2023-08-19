<?php

namespace App\Models;

use App\Models\Scopes\UserClassroomScope;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;



class Classroom extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=['name','subject','section','room','cover_image_path','code'];


    public function users() :BelongsToMany
    {

        return $this->belongsToMany(User::class);
    }

    public function classworks(): HasMany
    {
        return $this->hasMany(ClassWork::class);
    }

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }
    public function scopeActive(Builder $query): void
    {
        $query->where('status','=','active');
    }

    public function scopeRecent(Builder $query)
    {
        $query->orderBy('updated_at','DESC');
    }

    public function scopeStatus(Builder $query , $status ='active')
    {
        $query->where('status','=',$status);
    }

    public static function booted(): void
    {
        static::addGlobalScope(new UserClassroomScope());
    }

    // Change the parameter of the model binding from the default { id } To { code }
        //    public function getRouteKeyName(): string
        //    {
        //        return 'code';
        //    }
}
