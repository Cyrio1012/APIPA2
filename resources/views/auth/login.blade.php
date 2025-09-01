<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('content')
    <form action="{{ route('login') }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded shadow">
        @csrf
        <x-input name="email" type="email" label="Email" />
        <x-input name="password" type="password" label="Mot de passe" />
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Se connecter</button>
    </form>
@endsection
