<?php

namespace App\Http\Livewire\Vedio;

use App\Models\Video;
use Livewire\Component;

class WatchVideo extends Component
{

    public $video;

    protected $listeners=['VideoViewed' => 'countViews'];
    public function mount(Video $video){

        $this->video = $video;

    }

    public function render()
    {
        return view('livewire.vedio.watch-video')->extends('layouts.app');
    }

    public function countViews()
    {

        $this->video->update([

            'views' => $this->video->views + 1,
        ]);
    }
}
