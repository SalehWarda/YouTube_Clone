<?php

namespace App\Http\Livewire\Vedio;

use App\Models\Channel;
use App\Models\Video;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateVideo extends Component
{

    use WithFileUploads;

    public Channel $channel;
    public Video   $vedio;
    public $videoFile;


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

        dd('saleh');
    }





}
