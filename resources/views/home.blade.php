@extends('layouts.app')

@section('title', 'Real Time Chat')

@section('style')
<style>
    .list-group-item:hover {
        background: blue;
    }

</style>
@endsection

@section('content')
<div class="container">
    <h2 class="text-center">Real Time Chat</h2>
    <hr>
    <h3>Pilih kontak anda :</h3>
    <contact-list></contact-list>
</div>
@endsection

@section('script')
@endsection
