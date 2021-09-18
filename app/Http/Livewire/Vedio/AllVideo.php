<?php

namespace App\Http\Livewire\Vedio;

use App\Models\Channel;
use App\Models\Video;
use App\Policies\VideoPolicy;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class AllVideo extends Component
{

    use AuthorizesRequests;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $channel;

    public function mount(Channel  $channel){

        $this->channel = $channel;

    }
    public function render()
    {
        return view('livewire.vedio.all-video')
            ->with('videos', $this->channel->videos()->paginate(2))
            ->extends('layouts.app');
    }

    public function delete(Video $video){

        // check if user can delete folder

        $this->authorize('delete',$video);

        //  delete folder
        $deleted = Storage::disk('videosThumbnail')->deleteDirectory( $video->uid);

        if ($deleted){

            $video->delete();
        }

        return back();

    }
}
