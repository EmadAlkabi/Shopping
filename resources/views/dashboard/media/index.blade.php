@extends("dashboard.layout.app")

@section("title", __("dashboard/media.index.title"))

@section("content")
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="alert alert-info text-center">
                    <i class="far fa-star text-danger"></i>
                    @lang("dashboard/media.index.note-1")
                </div>
                <form method="post" action="{{route("dashboard.media-images.store")}}" enctype="multipart/form-data">
                    @csrf()
                    <input type="hidden" name="item" value="{{$item->id}}">
                    <div class="d-block">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image[]" value="" multiple="multiple">
                            <div class="custom-file-label overflow-hidden">
                                @lang("dashboard/media.placeholder.image")
                            </div>
                        </div>
                        @error("image") <div class="text-warning">{{$message}}</div> @enderror
                        @error("image.*") <div class="text-warning">{{$message}}</div> @enderror
                    </div>
                    <div class="text-center mt-4">
                        <button class="btn btn-outline-primary" type="submit">
                            @lang("dashboard/media.index.btn-send")
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-sm-12">
                @forelse($item->images as $image)
                    @if($loop->first)
                        <div class="d-flex overflow-auto scrollbar-blue-gray thin">
                    @endif
                        <div class="m-3">
                            <img src="{{asset("images/medium".Storage::url($image->url))}}" alt="Item Image">
                            <div class="d-flex justify-content-center">
                                <button class="btn p-1 btn-outline-success" type="button" data-toggle="collapse"
                                        data-target="#select-image-{{$image->id}}" aria-expanded="false"
                                        aria-controls="select-image-{{$image->id}}">
                                    @if($image->main == 1)
                                        <i class="fas fa-check text-success"></i>
                                    @else
                                        <i class="fas fa-minus text-success"></i>
                                    @endif
                                </button>
                                <button class="btn p-1 btn-outline-danger" type="button" data-toggle="collapse"
                                        data-target="#delete-image-{{$image->id}}" aria-expanded="false"
                                        aria-controls="delete-image-{{$image->id}}">
                                    <i class="fas fa-trash-alt text-danger"></i>
                                </button>
                            </div>
                            <div class="collapse" id="select-image-{{$image->id}}">
                                <form class="text-center small" method="post" action="{{route("dashboard.media-images.select")}}">
                                    @csrf()
                                    @method("PUT")
                                    <input type="hidden" name="image" value="{{$image->id}}">
                                    @lang("dashboard/media.index.select-image")
                                    <button class="btn p-0 m-0 mb-1 btn-link font-weight-bold" type="submit">@lang("dashboard/media.index.btn-click-here")</button>
                                </form>
                            </div>
                            <div class="collapse" id="delete-image-{{$image->id}}">
                                <form class="text-center small" method="post" action="{{route("dashboard.media-images.delete")}}">
                                    @csrf()
                                    @method("Delete")
                                    <input type="hidden" name="image" value="{{$image->id}}">
                                    @lang("dashboard/media.index.delete-image")
                                    <button class="btn p-0 m-0 mb-1 btn-link font-weight-bold" type="submit">@lang("dashboard/media.index.btn-click-here")</button>
                                </form>
                            </div>
                        </div>
                    @if($loop->last)
                        </div>
                    @endif
                @empty
                    <div class="d-flex justify-content-center">
                        <div class="h5-responsive p-5">
                            @lang("dashboard/media.index.null-image")
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script>
        @if(session()->has("message"))
        $.toast({
            title: '{{session()->get("message")}}',
            type:  '{{session()->get("type")}}',
            delay: 2500
        });
        @endif
    </script>
@endsection
