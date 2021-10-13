<?php

namespace App\Http\Livewire\Vedio;

use App\Models\Dislike;
use App\Models\Like;
use App\Models\Video;
use Livewire\Component;

class Voting extends Component
{

    public $video;
    public $like;
    public $dislike;
    public $likeActive;
    public $dislikeActive;


    protected $listeners=['load_value' => '$refresh'];

    public function mount(Video $video)
    {
        $this->video = $video;
    }
    public function render()
    {

        $this->like = $this->video->likes->count();
        $this->dislike = $this->video->dislikes->count();
        return view('livewire.vedio.voting')->extends('layouts.app');
    }


    public function like(){

        if ($this->video->doesUserLikedVideo()){

            Like::where('user_id' , auth()->id())->where('video_id' , $this->video->id)->delete();

            $this->likeActive = false;

        }else{

            $this->video->likes()->create([

                'user_id' => auth()->id(),

            ]);

            $this->likeActive = true;


        }

        $this->disabledislike();
        $this->emit('load_value');

    }

    public function dislike(){

        if ($this->video->doesUserdisLikedVideo()){

            Dislike::where('user_id' , auth()->id())->where('video_id' , $this->video->id)->delete();

            $this->dislikeActive = false;

        }else {
            $this->video->dislikes()->create([

                'user_id' => auth()->id(),


            ]);

            $this->dislikeActive = true;
        }

        $this->disablelike();
        $this->emit('load_value');
    }


    public function disabledislike(){

        Dislike::where('user_id' , auth()->id())->where('video_id' , $this->video->id)->delete();

        $this->dislikeActive = false;
    }

    public function disablelike(){

        Like::where('user_id' , auth()->id())->where('video_id' , $this->video->id)->delete();

        $this->likeActive = false;
    }
}
