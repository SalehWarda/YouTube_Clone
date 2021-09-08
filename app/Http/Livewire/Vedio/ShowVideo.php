<?php

namespace App\Http\Livewire\Vedio;

use Livewire\Component;

class ShowVideo extends Component
{
    public function render()
    {
        return view('livewire.vedio.show-video') ->extends('layouts.app');;
    }
}
