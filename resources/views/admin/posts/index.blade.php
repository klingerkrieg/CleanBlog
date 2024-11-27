@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Posts') }}</div>

                <div class="card-body">

                    <form method="GET" action="{{ route('post.list') }}">
                        
                        <div class="row mb-3">
                            <label for="subject" class="col-md-4 col-form-label text-md-end">
                                {{ __('Subject') }}</label>

                            <div class="col-md-6">
                                <input id="subject" type="text"  name="subject"
                                    class="form-control" 
                                    value="{{ old('subject') }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="text" class="col-md-4 col-form-label text-md-end">
                                {{ __('Text') }}</label>

                            <div class="col-md-6">
                                <input id="text" type="text"  name="text"
                                    class="form-control" 
                                    value="{{ old('text') }}">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Search') }}
                                </button>

                                <a href="{{route('post.create')}}" class='btn btn-secondary'>{{ __('New Post') }}</a>
                            </div>
                        </div>

                    </form>

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Editar</th>
                            <th scope="col">Assunto</th>
                            <th scope="col">Data de publicação</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Dono</th>
                            <th scope="col">Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($list as $item)
                            <tr>
                                <td>
                                    <a href="{{route("post.edit",$item)}}" class="btn btn-primary">
                                        {{ __('Edit') }}
                                    </a>
                                </td>
                                <td>{{$item->subject}}</td>
                                <td>{{$item->publish_date}}</td>
                                <td>{{$item->slug}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>
                                    <form style="display: inline-block;" action="{{route('post.destroy',$item)}}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button type="button" onclick="confirmDeleteModal(this)" 
                                            class="btn btn-danger">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    {{ $list->links() }}   
                                </td>
                            </tr>
                        </tfoot>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
