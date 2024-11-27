@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Categories') }}</div>

                <div class="card-body">

                        @if ($data->id)

                            <form method="POST" 
                                id="main"
                                action="{{ route('category.update', $data) }}" >
                            @csrf
                            @method('PUT')

                        @else

                            <form method="POST" 
                                id="main"
                                action="{{ route('category.store') }}">
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
                            <label for="name" class="col-md-4 col-form-label text-md-end">
                                    {{ __('Postagem') }}</label>

                            <div class="col-md-6">
                            <select class="form-select @error('post_id') is-invalid @enderror"
                                    id="post_id"
                                    name="post_id" >
                                    <option value=''>{{__("Select one option")}}</option>
                                    <option value='50'>Opção invalida</option>
                                    @foreach($postsList as $post)
                                    
                                        <option value='{{$post->id}}'
                                            @if (old('post_id',$data->post_id) == $post->id)
                                                selected
                                            @endif
                                            >{{$post->subject}}</option>
                                    @endforeach
                            </select>


                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </form>

                    @if($data->exists)
                        <ul>
                        @foreach ($posts as $post)
                        <li>
                            <a href='{{route('post.edit',$post)}}'>{{ $post->subject }}</a>
                            <a href="{{route('category.desvincular',$post->category_post_id)}}">X</a>
                        </li>
                        @endforeach
                        </ul>
                        {{ $posts->links() }}
                    @endif


                    

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" form="main">
                                    {{ __('Save') }}
                                </button>

                                <a class="btn btn-secondary" href='{{route("category.create")}}'>
                                    {{ __('New Category') }}
                                </a>

                                @if ($data->id != "")
                                <form name='delete' action="{{route('category.destroy',$data)}}"
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
