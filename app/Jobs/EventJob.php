<?php

namespace App\Jobs;

use App\Mail\EventMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EventJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

//    private $contact;
    private $event;

    public function __construct( $event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // send email
        foreach ($this->event->Contacts as $contact) {

        $data=array(
            'email'=>$contact->email,
            'to'=>$contact->name,
            'from'=>$this->event->user->email,
            'subject'=>$this->event->name,
            'bodymessage'=>$this->event->text,
            'video'=>$this->event->video,
            'date'=>$this->event->date,

        );

        Mail::send('eventemail',$data,function ($message) use ($data){
            $message->from($data['from']);
            $message->to($data['email']);
            $message->subject($data['subject']);
        });}
    }
}
