<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class TaskList extends Component
{
    use WithPagination;

    public function placeholder()
    {
        return view('skeleton');
    }

    public function changeStatus($id, $status)
    {
        $task = Task::find($id);
        if ($task) {
            $task->update([
                'status' => $status,
            ]);
        }
    }



    #[Computed]
    public  function tasks(){
        // Fetch tasks with pagination
       return auth()->user()->tasks()->latest()->paginate(5);
    }
    #[Computed(persist:true)]
    public function tasksByStatus(){
       return auth()->user()->tasks()->select('status',DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->orderBy('status','desc')
            ->get();
    }

    #[On('task-created')]
    public function createTask(){
        unset($this->tasksByStatus);
    }


  
    public function render()
    {
        return view('livewire.task-list');
    }
}
