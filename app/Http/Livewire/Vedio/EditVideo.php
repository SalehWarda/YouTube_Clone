<?php

namespace App\Http\Livewire\Vedio;

use Livewire\Component;

class EditVideo extends Component
{
    public function render()
    {
        return view('livewire.vedio.edit-video') ->extends('layouts.app');;
    }
}
