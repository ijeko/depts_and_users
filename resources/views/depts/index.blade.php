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
                    <user-index :users="{{ $data }}"></user-index>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
