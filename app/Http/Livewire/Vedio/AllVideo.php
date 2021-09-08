<?php

namespace App\Http\Livewire\Vedio;

use Livewire\Component;

class AllVideo extends Component
{
    public function render()
    {
        return view('livewire.vedio.all-video') ->extends('layouts.app');;
    }
}
