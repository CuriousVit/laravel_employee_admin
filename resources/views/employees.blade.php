<!-- login.blade.php -->

@extends('layout')

@section('title', 'Employees page')

@section('content')

    @if (Auth::check())
        <employees>Loading</employees>
    @else
        Please <a href="{{ route('login') }}">Login</a>
    @endif

@stop