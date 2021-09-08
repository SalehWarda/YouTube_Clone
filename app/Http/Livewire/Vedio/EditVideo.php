<?php

namespace App\Http\Livewire\Vedio;

use App\Models\Channel;
use App\Models\Video;
use Livewire\Component;

class EditVideo extends Component
{



    public Video $video;
    public Channel $channel;





    protected $rules =[

        'video.title' => 'required|max:255',
        'video.description' => 'nullable|max:1000',
        'video.visibility'  => 'required|in:private,public,unlisted'

    ];


    public function mount($channel , $video){

       $this->channel = $channel;
       $this->video = $video;
    }



    public function render()
    {
        return view('livewire.vedio.edit-video') ->extends('layouts.app');;
    }


    public function update(){

      $this->validate();

      $this->video->update([

        'title'  => $this->video->title,
        'description'  => $this->video->description,
        'visibility'  => $this->video->visibility

      ]);

      session()->flash('message', 'Updated Successfully');


    }
}
