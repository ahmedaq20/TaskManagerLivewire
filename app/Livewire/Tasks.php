<?php

namespace App\Livewire;

use App\Livewire\Forms\TaskForm;
use Livewire\Component;
use Illuminate\Support\Str;

class Tasks extends Component
{
   
    public function render()
    {
        return view('livewire.tasks')->layout('layouts.app');
    }
}
