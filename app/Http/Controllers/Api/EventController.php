<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResources;
use App\Jobs\EventJob;
use App\Models\Contact;
use App\Models\Event;
use App\Models\EventContact;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{


    public function show(){
        $event = Event::all();
        $page_number = intval(\request()->get('page_number'));
        $page_size = \request()->get('page_size');
        $total_records = $event->count();
        $total_pages = ceil($total_records / $page_size);
        $events = $event->skip(($page_number - 1) * $page_size)
            ->take($page_size)->all();
        $data = [
            'status' => true,
            'statusCode' => 200,
            'message' => 'Success',
            'items' => [
                'data' => EventResources::collection($events),
                'page_number' => $page_number,
                'total_pages' => $total_pages,
                'total_records' => $total_records,

            ]

        ];

        return response()->json($data);
    }

    public function add(Request $request)
    {
        $valid = validator($request->only( 'name','date','text','type','video'), [
            'name' => 'required',
            'date' => 'required',
            'text' => 'required',
            'type' => 'required',
            'video' => 'required',
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

        $data = request()->only('name','date','text','type','video','user_id');

        $event = Event::create([
            'name' => $data['name'],
            'date' => $data['date'],
            'text' => $data['text'],
            'type' => $data['type'],
            'video' => $data['video'],
            'user_id' => Auth::user()->id,
        ]);
        foreach ($request->get('contacts_id') as $contact_id)
        {
            $contact_event = new EventContact();
            $contact_event->event_id = $event->id;
            $contact_event->contact_id = $contact_id;
            $contact_event->save();
        }
        $data = [
            'status' => true,
            'statusCode' => 200,
            'message' => 'Successfully added',
            'items' => new EventResources($event),

        ];
        // create job
        $event_job = (new EventJob($event))->delay(Carbon::parse($request->get('date')));
        $this->dispatch($event_job);


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
        $event = Event::find($id);
        $event->name = $request->input('name');
        $event->date = $request->input('date');
        $event->text = $request->input('text');
        $event->type = $request->input('type');
        $event->video = $request->input('video');
        $event->user_id = $request->input('user_id');
        $event->save();

        $data = [
            'status' => true,
            'statusCode' => 200,
            'message' => 'Success edit',
            'items' => new  EventResources($event),

        ];
        return response()->json($data);
    }
    public function delete($id){
        $event = Event::find($id);
        if ($event != null) {
            $event->delete();
            $data = [
                'status' => true,
                'statusCode' => 200,
                'message' => 'Success delete',
                'items' => '',

            ];

            return response()->json($data);

        }
        if ($event == null) {
            $data = [
                'status' => false,
                'statusCode' => 400,
                'message' => 'there is no event with this id',
                'items' => '',

            ];

            return response()->json($data);
        }
    }
    public function sendemail($event){

        $myevent=Event::find($event);
        if ($myevent == null or $myevent->type=='mobile') {
            $data = [
                'status' => false,
                'statusCode' => 400,
                'message' => 'there is no event with this id',
                'items' => '',

            ];

            return response()->json($data);
        }
        $contact=EventContact::find($event);
        $person=Contact::find($contact)->first();
        $data=array(
            'email'=>$person->email,
            'to'=>$person->name,
            'from'=>$myevent->user->email,
            'subject'=>$myevent->name,
            'bodymessage'=>$myevent->text,
            'video'=>$myevent->video,
            'date'=>$myevent->date,

        );

        Mail::send('eventemail',$data,function ($message) use ($data){
            $message->from($data['from']);
            $message->to($data['email']);
            $message->subject($data['subject']);
        });

        if (Mail::failures()) {
            $data = [
                'status' => false,
                'statusCode' => 500,
                'message' => 'There is issue when send email',
                'items' => '',

            ];

            return response()->json($data);
        }
        else{
            $data = [
                'status' => true,
                'statusCode' => 200,
                'message' => 'Your email sent succesfully',
                'items' => '',

            ];

            return response()->json($data);
        }

    }
    public function sendsms($event){

        $myevent=Event::find($event);
        if ($myevent == null or $myevent->type=='email') {
            $data = [
                'status' => false,
                'statusCode' => 400,
                'message' => 'there is no event with this id',
                'items' => '',

            ];

            return response()->json($data);
        }
        else{
            $data = [
                'status' => true,
                'statusCode' => 200,
                'message' => 'Your SMS sent succesfully',
                'items' => '',

            ];

            return response()->json($data);
        }

    }
}
