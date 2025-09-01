<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('content')
    <form action="{{ route('register') }}" method="POST" class="max-w-md mx-auto bg-white p-6 rounded shadow">
        @csrf
        <x-input name="name" label="Nom" />
        <x-input name="email" type="email" label="Email" />
        <x-input name="password" type="password" label="Mot de passe" />
        <x-input name="password_confirmation" type="password" label="Confirmer le mot de passe" />
        <button class="bg-green-500 text-white px-4 py-2 rounded">S'inscrire</button>
    </form>
@endsection
