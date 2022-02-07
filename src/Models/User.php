<?php

namespace Insyghts\Authendication\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Insyghts\Authendication\Models\SessionToken;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
// use Session;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use Illuminate\Http\Request;


class User extends Model
{

    use HasFactory , AuthenticableTrait;

    protected $fillable = [
       'contact_id' , 'username', 'password', 'user_type', 'status' ,'created_by','last_modified_by','deleted_by'
    ];
    public function token()
    {
        return $this->hasOne(SessionToken::class, 'user_id');

    }







    public function login($data){

        // $data->validate([
        //     'username' => 'required',
        //     'password' => 'required',
        // ]);
        if($data['username'] == ''){
            return response()->json([
                'message' => 'User Name Field is Required'
            ]);
        }
        elseif($data['password'] == ''){
            return response()->json([
                'message' => 'Password Field is Required'
            ]);
        }





        elseif( $User = User::where('username', $data['username'])->first()){



                $credentials = array(
                    "username" => $data['username'],
                    "password" => $data['password'],
                );

                if(Auth::attempt($credentials)) {

                    $TokenExist = User::find($User->id)->token;
                    if($TokenExist){

                        $TokenExist->delete();

                        $Token = md5(uniqid(rand(), true));
                        $expiry = Carbon::now()->addDay();
                        $status = 'A';

                        $SessionToken = new SessionToken();
                        $SessionToken->user_id = $User->id;
                        $SessionToken->token = $Token;
                        $SessionToken->expiry = $expiry;
                        $SessionToken->status = $status;

                        //New Column
                        $SessionToken->created_by = $User->id;

                        $SessionToken->save();
                        Session::put('auth', auth::user());

                        return response()->json([
                            'staus' => 1,
                            'message' => 'logged in',
                            'token'    => $Token

                        ]);


                    }else{

                        $Token = md5(uniqid(rand(), true));
                        $expiry = Carbon::now()->addDay();
                        $status = 'A';

                        $SessionToken = new SessionToken();
                        $SessionToken->user_id = $User->id;
                        $SessionToken->token = $Token;
                        $SessionToken->expiry = $expiry;
                        $SessionToken->status = $status;

                        //New Column
                        $SessionToken->created_by = $User->id;

                        $SessionToken->save();
                        Session::put('auth', auth::user());

                        return response()->json([
                            'staus' => 1,
                            'message' => 'logged in',
                            'token'    => $Token

                        ]);

                    }



                }else{

                    return response()->json([
                        'staus' => 0,
                        'message' => 'Invalid Password'
                    ]);
                }

        }else{

                return response()->json([
                    'staus' => 0,
                    'message' => 'Invalid User Name'
                ]);
        }



    }


    public function refresh_token($data){


            $current_time1 = Carbon::now();
            $current_time  = $current_time1->toDateTimeString();

            $SessionToken  = SessionToken::where('token', $data['token'])->first();


            if($SessionToken){
                if($current_time <= $SessionToken->expiry){

                    $User  = $SessionToken->user_id;

                    $Token     = md5(uniqid(rand(), true));
                    $old_token = $SessionToken->token;
                    $expiry    = Carbon::now()->addDay();

                    $SessionToken->token  = $Token;
                    $SessionToken->expiry = $expiry;

                    $SessionToken->last_modified_by  = $User;

                    $SessionToken->save();

                    return response()->json([
                        'status'       => 1,
                        'message'      => 'Token Refreshed Sucessfully,This New Token will valid for Next 24 Hours',
                        'new_token'   =>  $Token,
                        'expire_date' =>  $expiry
                    ]);

                }else{
                    return response()->json([
                        'status'       => 0,
                        'message'      => 'Token Time Expired, You have to login',
                        'current_time' => $current_time,
                        'expiry_time'  => $SessionToken->expiry
                    ]);

                }



            }else{
                return response()->json([
                    'status'  => 0,
                    'message' => 'Unauthenticated token not found',
                    'current_time' => $current_time
                ]);
            }

    }
















}
