@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __($data->name) }}</div>
                <div class="card-body">
                    <dept-edit :dept="{{ $data }}"></dept-edit>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
