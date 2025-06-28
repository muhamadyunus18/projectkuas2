@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <h1>Profil Saya</h1>
    <p>Nama: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>No. HP: {{ $user->phone ?? '-' }}</p>
    <a href="{{ route('profile.edit') }}">Edit Profil</a>
    <form action="{{ route('logout') }}" method="POST" style="display:inline; margin-left:10px;">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
@endsection 