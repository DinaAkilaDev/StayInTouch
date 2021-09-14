<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResources;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function show(){
        $contact = Contact::all();
        $page_number = intval(\request()->get('page_number'));
        $page_size = \request()->get('page_size');
        $total_records = $contact->count();
        $total_pages = ceil($total_records / $page_size);
        $contacts = $contact->skip(($page_number - 1) * $page_size)
            ->take($page_size)->all();
        $data = [
            'status' => true,
            'statusCode' => 200,
            'message' => 'Success',
            'items' => [
                'data' => ContactResources::collection($contacts),
                'page_number' => $page_number,
                'total_pages' => $total_pages,
                'total_records' => $total_records,

            ]

        ];

        return response()->json($data);
    }

    public function add(Request $request)
    {
        $valid = validator($request->only('phone', 'name'), [
            'phone' => 'required|max:10',
            'name' => 'required',

        ]);

        if ($valid->fails()) {
            $data = [
                'status' => false,
                'statusCode' => 422,
                'message' => 'you add wrong data',
                'items' => '',
            ];

            return response()->json($data);
        }

        $data = request()->only('phone', 'email', 'photo', 'name','user_id');

        $contact = Contact::create([
            'phone' => $data['phone'],
            'email' => $data['email'],
            'photo' => $data['photo'],
            'name' => $data['name'],
            'user_id' => Auth::user()->id,
        ]);
        $data = [
            'status' => true,
            'statusCode' => 200,
            'message' => 'Successfully added',
            'items' => new ContactResources($contact),

        ];

        return response()->json($data);
    }


    public function edit(Request $request,$id)
    {
        if (User::find($request->user_id)===null){
            $data = [
                'status' => false,
                'statusCode' => 500,
                'message' => 'There is no user with this id',
                'items' =>'',

            ];
            return response()->json($data);
        }
        $contact = Contact::find($id);
        $contact->phone = $request->input('phone');
        $contact->email = $request->input('email');
        $contact->photo = $request->input('photo');
        $contact->name = $request->input('name');
        $contact->user_id = $request->input('user_id');
        $contact->save();

        $data = [
            'status' => true,
            'statusCode' => 200,
            'message' => 'Success edit',
            'items' => new  ContactResources($contact),

        ];
        return response()->json($data);
    }
    public function delete($id){
        $contact = Contact::find($id);
        if ($contact != null) {
            $contact->delete();
            $data = [
                'status' => true,
                'statusCode' => 200,
                'message' => 'Success delete',
                'items' => '',

            ];

            return response()->json($data);

        }
        if ($contact == null) {
            $data = [
                'status' => false,
                'statusCode' => 400,
                'message' => 'there is no contact with this id',
                'items' => '',

            ];

            return response()->json($data);
        }
    }

}
