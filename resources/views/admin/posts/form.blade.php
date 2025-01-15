@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Posts') }}</div>

                <div class="card-body">

                        @if ($data->id)

                            <form method="POST" 
                                id="main"
                                action="{{ route('post.update', $data) }}" 
                                enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                        @else

                            <form method="POST" 
                                id="main"
                                action="{{ route('post.store') }}" 
                                enctype="multipart/form-data">
                            @csrf

                        @endif

                        {{--@if ($data->id != "")            
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">
                                {{ __('Owner') }}</label>
                            
                                <div class="col-md-6">
                                    <input  class="form-control"
                        value="{{ $data->user->name }}"
                                    disabled>
                                </div>
                        </div>
                        @endif--}}

                        <div class="row mb-3">
                            <label for="user_id" class="col-md-4 col-form-label text-md-end">
                                {{ __('Dono escolhível') }}</label>
                            
                                <div class="col-md-6">
                                    <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                                        <option></option>
                                        @foreach ($users as $user)
                                            @if ($user->id == $data->user?->id)
                                                <option value="{{$user->id}}" selected>{{$user->name}}</option>
                                            @else
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endif
                                            
                                        @endforeach
                                    </select>

                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>




                        <div class="row mb-3">
                            <label for="subject" class="col-md-4 col-form-label text-md-end">
                                    {{ __('Subject') }}</label>

                            <div class="col-md-6">
                                <input id="subject" type="text" 
                                        class="form-control @error('subject') is-invalid @enderror" 
                                        name="subject" value="{{ old('subject', $data->subject) }}" autofocus>

                                @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">
                                {{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" 
                                    class="form-control @error('image') is-invalid @enderror" 
                                    name="image" value="">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror


                                @if ($data->id)
                                    <img src="{{asset($data->image)}}" class="rounded" width='200'/>
                                @endif

                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="publish_date" class="col-md-4 col-form-label text-md-end">
                                {{ __('Publish date') }}</label>

                            <div class="col-md-6">
                                <input id="publish_date" type="date" 
                                    class="form-control @error('publish_date') is-invalid @enderror" 
                                    name="publish_date" value="{{ old('publish_date', default: $data->publish_date?->format('Y-m-d')) }}">

                                @error('publish_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="slug" class="col-md-4 col-form-label text-md-end">
                                {{ __('Slug') }}</label>

                            <div class="col-md-6">
                                <input id="slug" type="text" 
                                    class="form-control" 
                                    value="{{ $data->slug }}" disabled>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="text" class="col-md-4 col-form-label text-md-end">
                                {{ __('Text') }}</label>

                            <div class="col-md-6">
                                <textarea name="text" 
                                class="form-control @error('text') is-invalid @enderror">{{ old('text', $data->text) }}</textarea>

                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </form>

                    

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                @can('update', $data)
                                <button type="submit" class="btn btn-primary" form="main">
                                    {{ __('Save') }}
                                </button>
                                @endcan

                                @can('create', App\Models\Post::class)
                                <a class="btn btn-secondary" href='{{route("post.create")}}'>
                                    {{ __('New Post') }}
                                </a>
                                @endcan

                                @can('delete', $data)
                                <form name='delete' action="{{route('post.destroy',$data)}}"
                                    method="post"
                                    style='display: inline-block;'>
                                    @csrf
                                    @method("DELETE")
                                    <button type="button" onclick="confirmDeleteModal(this)" class="btn btn-danger">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                                @endcan


                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
