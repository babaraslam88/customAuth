<?php

namespace Insyghts\Authendication\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Insyghts\Authendication\Models\SessionToken;



class myAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(!isset($_SERVER['HTTP_TOKEN'])){
            return response()->json('Unauthenticated');
        }
        if(isset($_SERVER['HTTP_TOKEN'])){
            $Token = $_SERVER['HTTP_TOKEN'];
            $auth = Session::get('auth');
            // $user_id = auth::user();
            $SessionToken = SessionToken::where('user_id' , $auth->id)->first();
            if($SessionToken->token == $Token){

                return $next($request);

            }else{
                return response()->json([
                    'status' => 0,
                    'message' => "Unauthenticated Wrong Token"

                ]);
            }


        }




    }

}
