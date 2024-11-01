@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Posts') }}</div>

                <div class="card-body">

                        @if ($data->id)

                            <form method="POST" action="{{ route('post.update', $data) }}">
                            @csrf
                            @method('PUT')

                        @else

                            <form method="POST" action="{{ route('post.store') }}">
                            @csrf

                        @endif

                        <div class="row mb-3">
                            <label for="subject" class="col-md-4 col-form-label text-md-end">
                                    {{ __('Subject') }}</label>

                            <div class="col-md-6">
                                <input id="subject" type="text" 
                                        class="form-control @error('subject') is-invalid @enderror" 
                                        name="subject" value="{{ old('subject', $data->subject) }}" required autofocus>

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
                                <input id="slug" type="date" 
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



                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
