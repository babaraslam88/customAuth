<?php


namespace Insyghts\Authendication\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Exists;
use Insyghts\Authendication\Models\User;
use Insyghts\Authendication\Models\SessionToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Insyghts\Authendication\Services\UserService;

class UserController extends Controller
{

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function login_old(Request $request){

        // $request->validate([
        //     'username' => 'required',
        //     'password' => 'required',
        // ]);


        // $name = $request->username;
        // $User = User::where('username', $name)->first();

        // if($User){
        //        if($User->password == $request->password){
        //             $ID  = $User->id;
        //             $Found = User::find($ID)->token;


        //             if($Found){
        //                 $login_id = $Found->id;
        //                 $SessionToken = SessionToken::where('id', $login_id)->first();

        //                     $Token = md5(uniqid(rand(), true));
        //                     $expiry = Carbon::now()->addDay();
        //                     $status = 'A';

        //                     $SessionToken->user_id = $User->id;
        //                     $SessionToken->token   = $Token;
        //                     $SessionToken->expiry  = $expiry;
        //                     $SessionToken->status  = $status;

        //                     //New Column
        //                     $SessionToken->last_modified_by  = $User->id;


        //                     $SessionToken->save();

        //                     return response()->json([
        //                         'staus' => 1,
        //                         'message' => 'Token Updated',
        //                         'expire_date' => $expiry,
        //                         'token'       => $Token
        //                     ]);


        //             }

        //             else{

        //             $Token = md5(uniqid(rand(), true));
        //             $expiry = Carbon::now()->addDay();
        //             $status = 'A';

        //             $SessionToken = new SessionToken();
        //             $SessionToken->user_id = $User->id;
        //             $SessionToken->token = $Token;
        //             $SessionToken->expiry = $expiry;
        //             $SessionToken->status = $status;

        //             //New Column
        //             $SessionToken->created_by = $User->id;

        //             $SessionToken->save();

        //             return response()->json([
        //                 'staus'   => 1,
        //                 'message' => 'Login Successfully New Token Generated sucessfully,This Token will valid for Next 24 Hours',
        //                 'expire_date' => $expiry,
        //                 'token'   => $Token,
        //                 'user_id' => $User->id

        //             ]);
        //             }
        //         }else{

        //             return response()->json([
        //                 'staus' => 0,
        //                 'message' => 'Invalid Password'
        //             ]);
        //         }

        // }else{

        //         return response()->json([
        //             'staus' => 0,
        //             'message' => 'Invalid User Name'
        //         ]);
        // }



    }




    public function refresh_old(Request $request){
        // $request->validate([
        //     'token' => 'required',
        // ]);


        // $current_time1 = Carbon::now();
        // $current_time  = $current_time1->toDateTimeString();

        // $SessionToken  = SessionToken::where('token', $request->token)->first();


        // if($SessionToken){
        //     if($current_time <= $SessionToken->expiry){

        //         $User  = $SessionToken->user_id;

        //         $Token     = md5(uniqid(rand(), true));
        //         $old_token = $SessionToken->token;
        //         $expiry    = Carbon::now()->addDay();

        //         $SessionToken->token  = $Token;
        //         $SessionToken->expiry = $expiry;

        //         $SessionToken->last_modified_by  = $User;

        //         $SessionToken->save();

        //         return response()->json([
        //             'status'       => 1,
        //             'message'      => 'Token Refreshed Sucessfully,This New Token will valid for Next 24 Hours',
        //             'new_token'   =>  $Token,
        //             'expire_date' =>  $expiry
        //         ]);

        //     }else{
        //         return response()->json([
        //             'status'       => 0,
        //             'message'      => 'Token Time Expired, You have to login',
        //             'current_time' => $current_time,
        //             'expiry_time'  => $SessionToken->expiry
        //         ]);

        //     }



        // }else{
        //     return response()->json([
        //         'status'  => 0,
        //         'message' => 'Unauthenticated token not found',
        //         'current_time' => $current_time
        //     ]);
        // }

    }
///////////////////////////////////////////////////////////////////////////

public function login(Request $request){
    $input = $request->input();
    $result = $this->userService->login($input);

    return response()->json([
        'status' => 1,
        'message' => 'You Loged in Successfully....!',
        'Token'   => $result
    ]);
}

public function refresh(Request $request){
    $input = $request->input();
    $result = $this->userService->refresh($input);

    return response()->json([
        'status' => 1,
        'message' => 'Token Refreshed....!',
        'Token'   => $result
    ]);
}

public function register(Request $request){
    // $user_id = auth::user();
    // echo '<pre>'; print_r($request->all()); exit;

   $User = new User();
   $User->contact_id = $request->contact_id;
   $User->username = $request->username;
   $User->password = Hash::make($request->password);
   $User->user_type = $request->user_type;
   $User->created_by = $request->created_by;

   $User->save();
echo '<pre>'; print_r($User); exit;

}





}
