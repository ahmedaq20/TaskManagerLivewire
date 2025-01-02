<?php

namespace App\Models;

use App\Enums\PriortyType;
use App\Enums\StatusType;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    protected $casts = [
        'deadline'=> 'date',
        'status' => StatusType::class,
        'priority' => PriortyType::class,
    ];




    public function user(){
        return $this->belongsTo(User::class);
    }
}
