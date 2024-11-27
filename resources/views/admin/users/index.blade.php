@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Editar</th>
                            <th scope="col">Nome</th>
                            <th scope="col">E-mail</th>
                            <th>Postagens</th>
                            <th scope="col">Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($list as $item)
                            <tr>
                                <td>
                                    <a href="{{route("user.edit",$item)}}" class="btn btn-primary">
                                        {{ __('Edit') }}
                                    </a>
                                </td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{ $item->posts->count() }}</td>
                                <td>
                                    <form style="display: inline-block;" action="{{route('user.destroy',$item)}}" method="post">
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
