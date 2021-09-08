<div>

    <form wire:submit.prevent="update">



        @if ($channel->image)

            <div class="form-group">
                <label for="image"><strong>Current Image</strong></label><br>
                <img src="{{ $channel->getPhoto($channel->image) }}" alt="Image" class="img-thumbnail">
            </div>
        @endif





        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" wire:model="channel.name" class="form-control">

            @error('channel.name')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" wire:model="channel.slug" class="form-control">
            @error('channel.slug')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea cols="30" rows="4" class="form-control" wire:model="channel.description"></textarea>

            @error('channel.description')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>

        <div class="form-group">
            <label for="image"><strong>New Image</strong></label><br>
            <input type="file" wire:model="image">


            @error('image')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">


            @if ($image)
              
                <img src="{{ asset($image->temporaryUrl()) }}" class="img-thumbnail">
            @endif


        </div>
        <button type="submit" class="btn btn-primary">Update</button>


        @if (session()->has('message'))

            <div class="alert alert-success">
                {{ session('message') }}
            </div>

        @endif

    </form>

</div>
