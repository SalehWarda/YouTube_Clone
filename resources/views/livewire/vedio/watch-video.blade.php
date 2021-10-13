<div>

    @push('custom-css')

        <link href="https://vjs.zencdn.net/7.15.4/video-js.css" rel="stylesheet"/>

    @endpush


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="video-container">
                    <div class="video-container" wire:ignore>
                        <video   id="my-video"
                                 controls
                                 preload="auto"

                                 class="video-js vjs-fill vjs-styles=defaults vjs-big-play-centered"
                                 data-setup="{}"
                                   poster = "{{ asset('videosThumbnail/'. $video->uid . '/' . $video->thumbnail_image)}}">
                            <source src="{{ asset('videosThumbnail/'. $video->uid . '/' . $video->proccessed_file)}}"
                                    type="application/x-mpegURL"/>
                            <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a
                                web browser that
                                <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5
                                    video</a>
                            </p>
                        </video>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <h3 class="mt-4">{{$video->title}}</h3>
                                <p class="gray-text">{{$video->views}} views . {{$video->uploaded_date}}</p>
                            </div>
                            <div>

                                <livewire:vedio.voting :video="$video" />

                            </div>
                        </div>
                    </div>
                </div>

                <hr />
                <div class="row">
                    <div class="col-md-12">

                        <livewire:channel.channel-info :channel="$video->channel"
                                                       />

                    </div>
                </div>

                <hr />

                <h4> {{$video->AllCommentsCount()}} Comment</h4>

            @auth()
                    <div class="my-2">
                    <livewire:comment.new-comment  :video="$video" :col=0 :key="$video->id" />
                    </div>

                @endauth
                <livewire:comment.all-comments :video="$video" />


            </div>
            <div class="col-md-4"></div>
        </div>

    </div>


    @push('scripts')

        <script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>


        <script>

            var player = videojs('my-video')

            player.on('timeupdate',function (){


               if (this.currentTime() > 3){

                   this.off('timeupdate')

                   Livewire.emit('VideoViewed')
               }

            });

        </script>
    @endpush


</div>
