<?php

namespace App\Http\Livewire\Channel;

use App\Models\Channel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;
use Image;

class EditChannel extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    public $channel;
    public $image;


    public function rules(){

        return [

            'channel.name' => 'required|max:255|unique:channels,name,'.$this->channel->id,
            'channel.slug' => 'required|max:255|unique:channels,slug,'.$this->channel->id,
            'channel.description' => 'nullable|max:1000',
            'image' => 'nullable|image|max:1000'
            ];
    }
    public function mount(Channel $channel){

        $this->channel = $channel;

    }

    public function render()
    {

        return view('livewire.channel.edit-channel');
    }


    public function update(){


        $this->authorize('update',$this->channel);
        $this->validate();

        $this->channel->update([

            'name' => $this->channel->name,
            'slug' => $this->channel->slug,
            'description' => $this->channel->description

        ]);

        // save image in folder

        if ($this->image){



                $name = $this->image->getClientOriginalName();
               $imagee =   $this->image->storeAs('images/channel '. $this->channel->name , $this->image->getClientOriginalName(),'images' );

                $img = Image::make($imagee)
                ->fit(80, 60, function ($constraint) {
                    $constraint->upsize();
                })->save();


                $this->channel->update([

                    'image' => $name
                ]);


        }

        session()->flash('message','Updated Successfully');

        return redirect()->route('channel.edit',['channel' => $this->channel->slug]);
    }
}
