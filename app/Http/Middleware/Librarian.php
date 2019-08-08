<?php
/**
 * Created by PhpStorm.
 * User: molde
 * Date: 06.08.2019
 * Time: 21:34
 */
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class Librarian
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
        if(Auth::user()->is_librarian == 0) {
            return redirect(route('librarian/home'));
        }
        return $next($request);
    }
}
