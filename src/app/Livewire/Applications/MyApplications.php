<?php

namespace App\Livewire\Applications;

use App\Models\Application;
use Livewire\Component;

class MyApplications extends Component
{
    public string $first_name = '';
    public string $last_name = '';

    public function render()
    {
        $query = Application::where('user_id', auth()->user()->id);

        if ($this->first_name) {
            $query->where('first_name', 'LIKE', '%' . $this->first_name . '%');
        }

        if ($this->last_name) {
            $query->where('last_name', 'LIKE', '%' . $this->last_name . '%');
        }

        $my_applications = $query->get();

        return view('livewire.applications.my-applications')->with(
            ['my_applications' => $my_applications]
        );
    }
}
