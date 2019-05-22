<?php
/**
 * Created by PhpStorm.
 * User: Debbabi Aymen
 * Date: 13/02/2018
 * Time: 11:37
 */

namespace App\Http\Middleware;

use App\User;
use Closure;
use Auth;


class AuthSingleSession
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
        $header = $request->header('Authorization');
        if ($header && substr($header, 0, 7) == 'Bearer ') {
            $user = User::findByToken(substr($header, 7));
            if ($user) {
                if ($user->status === 1){
                    Auth::setUser($user);
                    return $next($request);
                }else{
                    return response()->json(['status' => 'error', 'message' => 'User disabled'], 406);
                }

            }
        }
        return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
    }
}