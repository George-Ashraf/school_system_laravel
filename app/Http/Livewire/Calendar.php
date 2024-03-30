<?php

namespace App\Http\Livewire;

use App\Models\event;
use Livewire\Component;

class Calendar extends Component
{


// 36:00  video 47
     public $events = '';



    public function getevent()

    {

        $events = event::select('id','title','start')->get();



        return  json_encode($events);

    }



    /**

    * Write code on Method
    *

    * @return response()
21
    */

    public function addevent($event)

    {

        $input['title'] = $event['title'];

        $input['start'] = $event['start'];

        event::create($input);

    }
    public function eventDrop($event, $oldEvent)

        {

          $eventdata = Event::find($event['id']);

          $eventdata->start = $event['start'];

          $eventdata->save();

        }



        /**

        * Write code on Method

        *

        * @return response()

        */

        public function render()

        {

            $events = Event::select('id','title','start')->get();



            $this->events = json_encode($events);



            return view('livewire.calendar');

        }




}
