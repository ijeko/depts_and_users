@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>{{ __('Пользователи') }}</div>
                    <div><a class="btn btn-link text-primary text-decoration-none" href="/users/add">Создать</a></div>
                </div>
                <div class="card-body">
                    @foreach($data as $user)
                        <user-item :user="{{$user}}"></user-item>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center">
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
