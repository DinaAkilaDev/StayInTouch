<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Event;
use App\Models\EventContact;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //        `id`, `name`, `email`,  `password`, `photo`, `phone`
        $user=new User();
        $user->name='dina';
        $user->email='dinashadiakeela@gmail.com';
        $user->password=bcrypt('123456');
        $user->photo='https://img.freepik.com/free-vector/cute-panda-with-bamboo_138676-3053.jpg?size=338&ext=jpg';
        $user->phone='0597505581';
        $user->save();

        //        `id`, `name`, `date`, `text`, `type`, `video`,'user_id'
        $event = new Event();
        $event->name = 'Birthday';
        $event->date = '2021-10-21';
        $event->text = 'Happy Birthday my sweety';
        $event->type = 'email';
        $event->video = 'https://www.youtube.com/watch?v=nl62hhiBMOM';
        $event->user_id = $user->id;
        $event->save();


        //          `id`, `phone`, `email`, `photo`, `name`,'user_id'
        $contact = new Contact();
        $contact->phone = '0599174952';
        $contact->email = 'hanieman86@gmail.com';
        $contact->photo = 'https://i.pinimg.com/736x/33/32/6d/33326dcddbf15c56d631e374b62338dc.jpg';
        $contact->name = 'Eman Elessi';
        $contact->user_id = $user->id;
        $contact->save();

        //          `id`, `event_id`, `contact_id`
        $event_contact = new EventContact();
        $event_contact->event_id = $event->id;
        $event_contact->contact_id = $contact->id;
        $event_contact->save();
    }



}
