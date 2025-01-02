<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class Search extends Component
{
    public $search;
    public function render()
    {
        $results =[];
        if(strlen($this->search)>2){
            $results = auth()->user()->tasks()->where('title','like','%'.$this->search.'%')->get();
        }
        return view('livewire.search',[
            'results' => $results ,
         ])->layout('layout.app');
    }
}
