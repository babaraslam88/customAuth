<?php

namespace Insyghts\Authendication\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Insyghts\Authendication\Models\Contact;
use Insyghts\Authendication\Services\ContactService;

class ContactController extends Controller
{

    public function __construct(ContactService $ContactService)
    {
        $this->contactService = $ContactService;
    }



    // public function store(Request $request){

    //     $request->validate([
    //         'first_name' => 'required',
    //         'email' => 'required|email',
    //     ]);

    //         $Contact = new Contact();
    //         $Contact->system_contact_id = $request->system_contact_id;
    //         $Contact->first_name = $request->first_name;
    //         $Contact->last_name  = $request->last_name;
    //         $Contact->mobile     = $request->mobile;
    //         $Contact->email      = $request->email;
    //         $Contact->designation= $request->designation;
    //         $Contact->department = $request->department;
    //         $Contact->company_id = $request->company_id;

    //          //New Column
    //         // $Contact->created_by = $request->created_by;

    //         $Contact->save();
    //         return response()->json([
    //             'status' => 1,
    //             'message' => 'New Contact Created successfullly',
    //             'Contact'   => $Contact
    //         ]);


    // }





    // public function contacts(){

    //     $Contact = Contact::all();

    //     return response()->json([
    //         'status' => 1,
    //         'message' => 'All Contacts',
    //         'Contacts'   => $Contact
    //     ]);
    // }

    // public function single($id){

    //     $Contact = Contact::where('id',$id)->first();
    //     if($Contact){
    //         return response()->json([
    //             'status' => 1,
    //             'message' => 'Singe Contact',
    //             'Contact'   => $Contact
    //         ]);
    //     }else{
    //         return response()->json([
    //             'status'  => 0,
    //             'message' => 'Not Found'

    //         ]);
    //     }


    // }



    // public function update(Request $request , $id){

    //     $Contact = Contact::where('id',$id)->first();

    //     $Contact->first_name  =  !empty($request->first_name) ? $request->first_name : $Contact->first_name;
    //     $Contact->last_name   =  !empty($request->last_name) ? $request->last_name : $Contact->last_name;
    //     $Contact->mobile      =  !empty($request->mobile) ? $request->mobile : $Contact->mobile;
    //     $Contact->email       =  !empty($request->email) ? $request->email : $Contact->email;
    //     $Contact->designation =  !empty($request->designation) ? $request->designation : $Contact->designation;
    //     $Contact->department  =  !empty($request->department) ? $request->department : $Contact->department;
    //     $Contact->company_id  =  !empty($request->company_id) ? $request->company_id : $Contact->company_id;

    //      //New Column
    //     // $Contact->last_modified_by = $request->last_modified_by;

    //     $Contact->save();

    //     return response()->json([
    //         'status' => 1,
    //         'message' => 'Contact Updated successfully',
    //         'updated contact' => $Contact
    //     ]);
    // }



    // public function delete($id){
    //     $Contact = Contact::where('id',$id)->first();

    //     if($Contact){
    //          //New Column
    //         // $Contact->deleted_by = $request->deleted_by;
    //         // $Contact->save();

    //         $Contact->delete();

    //         return response()->json([
    //             'status' => 1,
    //             'message' => 'Contact Deleted successfully'

    //         ]);
    //     }else{

    //         return response()->json([
    //             'status' => 0,
    //             'message' => 'Id does not exist'

    //         ]);
    //     }

    // }



    public function contacts(Request $request)
    {
        $Contact = new Contact();
        $result = $this->contactService->allContacts();

        return response()->json([
            'status' => 1,
            'message' => 'All Contacts',
            'Contact'   => $result
        ]);

    }

    public function single($id)
    {
        $Contact = new Contact();
        $result = $this->contactService->single($id);

        return response()->json([
            'status' => 1,
            'message' => 'Single Contacts',
            'Contact'   => $result
        ]);

    }

    public function store(Request $request)
    {
        $input = $request->input();
        $result = $this->contactService->store($input);

        return response()->json([
            'status' => 1,
            'message' => 'Contact Insertes Successfully....!',
            'Contact'   => $result
        ]);

    }

    public function update(Request $request ,$id)
    {
        $input = $request->input();
        $result = $this->contactService->update($input ,$id);

        return response()->json([
            'status' => 1,
            'message' => 'Contact Updated Successfully....!',
            'Contact'   => $result
        ]);

    }


    public function delete($id)
    {
        $Contact = new Contact();
        $result = $this->contactService->delete($id);

        return response()->json([
            'status' => 1,
            'message' => 'Contact Deleted Succcessfully',
            'Contact'   => $result
        ]);

    }







}
