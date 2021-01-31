<?php

namespace App\Http\Middleware;

use Closure;
use App\Categories;

class VerifyCategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Categories::all()->count()==0){
            session()->flash('error','You need to add categories to add posts');
            return redirect(route('categories.create'));
        }
        return $next($request);
    }
}
