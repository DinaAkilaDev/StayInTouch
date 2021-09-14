<?php

namespace App\Http\Controllers;

use App\Jobs\EventJob;
use App\Models\Contact;
use App\Models\Event;
use App\Models\EventContact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $event = Event::where('user_id', $user_id)->get();
        return view('events')->with(compact('event'));
    }

    public function add()
    {
        $user_id = Auth::user()->id;
        $contacts = Contact::where('user_id', $user_id)->get();
        return view('createevent')->with(compact('contacts'));
    }

    public function addevent(Request $request)
    {
        $data = request()->only('name', 'date', 'text', 'type', 'video', 'user_id');

        $event = Event::create([
            'name' => $data['name'],
            'date' => $data['date'],
            'text' => $data['text'],
            'type' => $data['type'],
            'video' => $data['video'],
            'user_id' => Auth::user()->id,
        ]);
        $contact_event = new EventContact();
        $contact_event->event_id = $event->id;
        $contact_event->contact_id = $request->contacts_id;
        $contact_event->save();
        $event_job = (new EventJob($event))->delay(Carbon::parse($request->get('date')));
        $this->dispatch($event_job);

        return Redirect::back()->withErrors(['Added Successfully', 'The Message']);
    }

    public function deleteevent($id)
    {
        $event = Event::find($id);
        $event->destroy($id);
        return Redirect::back();
    }

    public function editevent($id)
    {
        $event = Event::find($id);
        $contact = EventContact::where('event_id', $id)->get('contact_id');
        $mycontact = Contact::find($contact)->first();
        $user_id = Auth::user()->id;
        $contacts = Contact::where('user_id', $user_id)->get();
        return view('editevent')->with(compact('event', 'contacts', 'mycontact'));
    }

    public function addeditevent(Request $request)
    {
        $id=$request->input('id');
        $contact_event = EventContact::where('event_id', $id)->get()->first();
        $event = Event::find($id);
        if ($request->input('date')!== $event->date){
            $event_job = (new EventJob($event))->delay(Carbon::parse($request->get('date')));
            $this->dispatch($event_job);
        }
        if ((int)$request->input('contacts_id')!== $contact_event->contact_id){
            $contact_event->event_id = $request->input('id');
            $contact_event->contact_id = $request->input('contacts_id');
            $contact_event->save();
        }
        $event->video = $request->input('video');
        $event->name = $request->input('name');
        $event->date = $request->input('date');
        $event->text = $request->input('text');
        $event->type = $request->input('type');

        $event->user_id = $request->input('user_id');
        $event->save();
        return Redirect::back()->withErrors(['Edited Successfully', 'The Message']);
    }
}
