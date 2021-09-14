<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $contacts=Contact::where('user_id', $user_id)->get();
        return view('contacts')->with(compact('contacts'));
    }
    public function add(){
        return view('createcontact');
    }
    public function addcontact(Request $request){
        $data = request()->only('phone', 'email', 'photo', 'name','user_id');

        $contact = Contact::create([
            'phone' => $data['phone'],
            'email' => $data['email'],
            'photo' => $data['photo']->store('public/storage'),
            'name' => $data['name'],
            'user_id' => Auth::user()->id,
        ]);

        return Redirect::back()->withErrors(['Added Successfully', 'The Message']);
    }
    public function deletecontact($id){
        $contact = Contact::find($id);
        $contact->destroy($id);
        return Redirect::back();
    }
    public function editcontact($id)
    {
        $contacts = Contact::find($id);
        return view('editcontact')->with(compact('contacts'));
    }

    public function addeditcontact(Request $request)
    {

        $id=$request->input('id');
        $contact = Contact::find($id);
        $contact->phone = $request->input('phone');
        $contact->email = $request->input('email');
        if($request->hasFile('photo')){
            $contact->photo = $request->file('photo')->store('public/storage');
        }

        $contact->name = $request->input('name');
        $contact->save();
        return Redirect::back()->withErrors(['Edited Successfully', 'The Message']);
    }
}
