@extends('layouts.app')

@section('title', 'Real Time Chat')

@section('style')
<link href="{{ URL::to('css/chat.css') }}" rel="stylesheet">
<style>
    /* .chat_list:focus {
        background: blue;
    } */

</style>
@endsection

@section('content')
<chat></chat>
@endsection

@section('script')
@endsection
