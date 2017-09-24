<!-- login.blade.php -->

@extends('layout')

@section('title', 'Login page')

@section('content')

    <form class="form-signin" @submit.prevent="onSubmit">

        <h2 class="form-signin-heading">Please log in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus v-model="email">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required v-model="password">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>

    </form>

@stop
