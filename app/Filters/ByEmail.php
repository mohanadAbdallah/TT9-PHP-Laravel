<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class ByEmail
{
    public function __construct(public Request $request)
    {
    }

    public function handle(Builder $builder, \Closure $next)
    {
        return $next($builder)
            ->when($this->request->has('email'),
                fn($q) => $q->where('email','REGEXP',$this->request->email)
            );
    }
}
