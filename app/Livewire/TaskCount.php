<?php

namespace App\Livewire;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class TaskCount extends Component
{
    //in reacive attribute any change doing in parents componant affect to chaild componant

    #[Reactive]
    public $tasksByStatus;

    public function render()
    {
        return view('livewire.task-count');

    }
}
