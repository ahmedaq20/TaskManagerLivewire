<?php

use App\Livewire\ImageIndex;
use App\Livewire\Search;
use App\Livewire\Tasks;
use Illuminate\Support\Facades\Route;

use function Laravel\Prompts\search;

Route::view('/', 'welcome');
Route::get('/tasks', Tasks::class)->middleware(['auth'])->name('tasks');
Route::get('/search', Search::class)->middleware(['auth'])->name('search');
Route::get('/ImageIndex', ImageIndex::class)->middleware(['auth'])->name('ImageIndex');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
