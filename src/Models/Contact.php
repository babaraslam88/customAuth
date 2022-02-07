<?php

namespace Insyghts\Authendication\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{

    use HasFactory , SoftDeletes;

    protected $dates = ['deleted_at'];

    public function Contacts()
    {
        return  $Contact = Contact::all();
    }

    public function single($id)
    {

        $Contact = Contact::where('id',$id)->first();
        if($Contact){
            return response()->json([
                'status' => 1,
                'message' => 'Singe Contact',
                'Contact'   => $Contact
            ]);
        }else{
            return response()->json([
                'status'  => 0,
                'message' => 'No Record Found of Resquested Id'

            ]);
        }
    }




    public function store($data){

        if($data['first_name'] == '' ){

            return response()->json([
                'message' => 'First Name  Field is required'
            ]);

        }
        elseif($data['email'] == ''){

            return response()->json([
                'message' => ' Email  Field is required'
            ]);

        }
        elseif($data['designation'] ==''){

            return response()->json([
                'message' => ' Designation  Field is required'
            ]);

        }
        elseif($data['department'] ==''){

            return response()->json([
                'message' => 'Department Field is required'
            ]);

        }else{

            $Contact = new Contact();
            $Contact->system_contact_id = $data['system_contact_id'];
            $Contact->first_name = $data['first_name'];
            $Contact->last_name  = $data['last_name'];
            $Contact->mobile     = $data['mobile'];
            $Contact->email      = $data['email'];
            $Contact->designation= $data['designation'];
            $Contact->department = $data['department'];
            $Contact->company_id = $data['company_id'];

              //New Column
             // $Contact->created_by = $request->created_by;

            $Contact->save();




            return response()->json([
                'status' => 1,
                'message' => 'datataaa',
                'Contact'   => $data
            ]);

        }



    }

    public function ConttactUpdate($data , $id){

        $Contact = Contact::where('id',$id)->first();

        $Contact->first_name  =  !empty($data['first_name'])  ? $data['first_name'] : $Contact->first_name;
        $Contact->last_name   =  !empty($data['last_name'])   ? $data['last_name']  : $Contact->last_name;
        $Contact->mobile      =  !empty($data['mobile'])      ? $data['mobile']     : $Contact->mobile;
        $Contact->email       =  !empty($data['email'])       ? $data['email']      : $Contact->email;
        $Contact->designation =  !empty($data['designation']) ? $data['designation']: $Contact->designation;
        $Contact->department  =  !empty($data['department'])  ? $data['department'] : $Contact->department;
        $Contact->company_id  =  !empty($data['company_id'])  ? $data['company_id'] : $Contact->company_id;

        //  New Column
        // $Contact->last_modified_by = $request->last_modified_by;

        $Contact->save();

        return response()->json([
            'status' => 1,
            'message' => 'resquested id data',
            'updated contact' => $Contact
        ]);
    }









    public function delete_contact($id)
    {



        $Contact = Contact::where('id',$id)->first();
        if($Contact){
            $Contact->delete();
            return response()->json([
                'status' => 1,
                'message' => 'Singe Contact',
                'Contact'   => $Contact
            ]);
        }else{
            return response()->json([
                'status'  => 0,
                'message' => 'No Record Found of Resquested Id'

            ]);
        }
    }


}
