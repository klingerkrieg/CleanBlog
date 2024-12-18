@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">

                        @if ($data->id)

                            <form method="POST" 
                                id="main"
                                action="{{ route('user.update', $data) }}" >
                            @csrf
                            @method('PUT')

                        @else

                            <form method="POST" 
                                id="main"
                                action="{{ route('user.store') }}">
                            @csrf

                        @endif



                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">
                                    {{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" 
                                        class="form-control @error('name') is-invalid @enderror" 
                                        name="name" value="{{ old('name', $data->name) }}" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">
                                    {{ __('E-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" 
                                        class="form-control @error('email') is-invalid @enderror" 
                                        name="email" value="{{ old('email', $data->email) }}" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <ol>
                        @foreach ($posts as $post)
                            <li><a href='{{route('post.edit',$post)}}'>{{ $post->subject }}</a></li>
                        @endforeach
                        </ol>
                        {{ $posts->links() }}



                    </form>

                    

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" form="main">
                                    {{ __('Save') }}
                                </button>

                                <a class="btn btn-secondary" href='{{route("user.create")}}'>
                                    {{ __('New User') }}
                                </a>

                                @if ($data->id != "")
                                <form name='delete' action="{{route('user.destroy',$data)}}"
                                    method="post"
                                    style='display: inline-block;'>
                                    @csrf
                                    @method("DELETE")
                                    <button type="button" onclick="confirmDeleteModal(this)" class="btn btn-danger">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                                @endif


                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
