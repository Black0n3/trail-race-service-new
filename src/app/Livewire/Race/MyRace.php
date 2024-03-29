<?php

namespace App\Livewire\Race;

use App\Models\Application;
use Livewire\Component;

class MyRace extends Component
{
    public function render()
    {
        $my_races = Application::where('user_id', auth()->user()->id)->get();
        return view('livewire.race.my-race')->with(
            ['my_races' => $my_races]
        );
    }
}
