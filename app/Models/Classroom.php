<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class Classroom extends Model
{
    use HasFactory;
    protected $fillable=['name','subject','section','room','cover_image','code'];


    public function users() :BelongsToMany
    {

        return $this->belongsToMany(User::class);
    }
}
