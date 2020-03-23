@extends('dashboard.layout.app')


@section("content")

<div class="container">
    <div class="row ">
        <div class="col-8">
            <form method="post" action="/upload" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file">
                <input type="submit">
            </form>
        </div>
    </div>
</div>


@endsection

