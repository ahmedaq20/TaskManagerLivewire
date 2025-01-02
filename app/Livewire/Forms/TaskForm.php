<?php

namespace App\Livewire\Forms;

use App\Models\Task;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Attributes\Rule;
use Illuminate\Support\Str;



class TaskForm extends Form
{
    public ?Task $task;

    public $editTask = false;

    #[Rule('required|string|min:3')]
    public $title;
    #[Rule('required|string')]
    public $slug;
    #[Rule('required|string|min:10')]
    public $description;
    #[Rule('required')]
    public $status;
    #[Rule('required')]
    public $priority;
    #[Rule('required|date')]
    public $deadline;

    //  public function updatedTitle($value){
    //     $this->slug= Str::slug($value);
    // }



    public function setTask(Task $task)
    {
        $this->task = $task;
        $this->editTask = true;
        $this->title = $task->title;
        $this->slug = $task->slug;
        $this->description = $task->description;
        $this->status = $task->status;
        $this->priority = $task->priority;
        $this->deadline = $task->deadline->format('Y-m-d');
    }
    public function createTask()
    {

        // if taskupdat = true

        if ($this->editTask) {
            $this->task->update([
                'title' => $this->title,
                'slug' => $this->slug,
                'description' => $this->description,
                'status' => $this->status,
                'priority' => $this->priority,
                'deadline' => $this->deadline,

            ]);
            session()->flash('success', 'Task Updated Successfully');
             $this->editTask = false;
        } else {
            auth()->user()->tasks()->create(
                [
                    'title' => $this->title,
                    'slug' => $this->slug,
                    'description' => $this->description,
                    'status' => $this->status,
                    'priority' => $this->priority,
                    'deadline' => $this->deadline,
                ]
            );
            session()->flash('success', 'Task Add Successfully');
        }
        //way 3 using Form

    }
}
