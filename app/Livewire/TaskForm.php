<?php

namespace App\Livewire;

use App\Livewire\Forms\TaskForm as FormsTaskForm;
use App\Models\Task;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskForm extends Component
{

    public FormsTaskForm $form;

    // public function updatedTitle($value){
    //     $this->slug= Str::slug($value);
    // }
    public function store(){
        $this->validate();
        //way 1
        //auth()->user()->tasks()->create($this->only(['title','slug','description','status','priority','deadline']));

        //way 2
        // auth()->user()->tasks()->create([
        //     'title'=>$this->title,
        //     'slug'=>Str::slug($this->title),
        //     'description'=>$this->description,
        //     'status'=>$this->status,
        //     'priority'=>$this->priority,
        //     'deadline'=>$this->deadline,
        // ]);

        //called create funciton in Form
        $this->form->createTask();
        $this->dispatch('task-created');
        $this->form->reset();
    }

    #[On('edit-task')]
    public function editTask($id){
        $task = Task::find($id);
        $this->form->setTask($task);

    }
    public function refresh(){
        $this->form->reset();
        // $this->form->editTask = false;
    }

    public function render()
    {
        return view('livewire.task-form');
    }
}
