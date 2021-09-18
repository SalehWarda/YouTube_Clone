<?php

namespace App\Http\Livewire\Vedio;

use App\Jobs\ConvertVideoForStreaming;
use App\Jobs\CreateThumbnailFromVideo;
use App\Models\Channel;
use App\Models\Video;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateVideo extends Component
{

    use WithFileUploads;

    public Channel $channel;
    public Video   $video;
    public $videoFile;


    protected  $rules = [

        'videoFile' => 'required|file|max:1228800'

    ];


    public function mount(Channel $channel){

         $this->channel = $channel;

    }

    public function render()
    {
        return view('livewire.vedio.create-video')
        ->extends('layouts.app');
    }

     public function fileCompleted()
    {

       // validation

       $this->validate();

    //    // save in folder
       if($this->videoFile){



        $path =   $this->videoFile->storeAs('images/channel '. $this->channel->name , $this->videoFile->getClientOriginalName(),'images' );

       }

       // save in DB

      $this->video = $this->channel->videos()->create([

        'title' => 'untitle',
        'description' => 'null',
        'uid'  => uniqid(true),
        'visibility'  => 'private',
        'path'   => $path


       ]);

       // dispatch jobs

        CreateThumbnailFromVideo::dispatch($this->video);
        ConvertVideoForStreaming::dispatch($this->video);


       //redirect to edit page

       return redirect()->route('video.edit',[

        'channel' => $this->channel,
        'video'   => $this->video,
       ]);


    }





}
