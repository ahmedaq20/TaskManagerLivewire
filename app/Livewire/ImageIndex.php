<?php

namespace App\Livewire;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageIndex extends Component
{
    use WithFileUploads;
    #[Rule('required')]
    #[Rule(['photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'])]
    public $photos = [];

    public function save()
    {
        // dd($this->photo);
        $this->validate();

        // $name = $this->photo->getClientOriginalName();
        // hashName More secure than getVlientOriginalName
        // for one image
        //    if ($this->photo) {
        //    $name = $this->photo->hashName();
        //    $path  = $this->photo->storeAs('images',$name,'public');
        //     Image::create([
        //         'name'=>$name,
        //         'path'=>$path,
        //     ]);
        //     $this->reset();
        //     }
        $images=[];
        if (!is_null($this->photos)) {
            foreach ($this->photos as $photo) {
                $name = $photo->hashName();
                $path = $photo->storeAs('images', $name, 'public');
                $images[] = ['name' => $name, 'path' => $path];
            }
        }
        foreach ($images as $image) {
            Image::create($image);
        }
        $this->reset();
        unset($this->images);
    }


    #[Computed(persist:true)]
    public function images()
    {
        return Image::all();
    }

    public function download($id){
        $image= Image::findOrFail($id);
        //download image
        //way1
        // return Storage::disk('public')->download($image->path,'image');
        //way2                      (image_path,imagename.extintion(whene download image))
        return response()->download(storage_path('app/public/'.$image->path),'image.png');
    }
    public function render()
    {
        return view('livewire.image-index')->layout('layouts.app');
    }
}




// #[Validate(['photos.*' => 'image|max:1024'])]
//     public $photos = [];

//     public function save()
//     {
//         foreach ($this->photos as $photo) {
//             $photo->store(path: 'photos');
//         }
//     }
