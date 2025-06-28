@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
    <h1>Edit Profil</h1>
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" value="{{ $user->name }}" required><br>
        <input type="text" name="phone" value="{{ $user->phone }}" placeholder="No. HP"><br>
        <input type="password" name="password" placeholder="Password Baru (opsional)"><br>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"><br>
        <input type="file" name="profile_photo" accept="image/*"><br>
        <button type="submit">Simpan</button>
    </form>
    <a href="{{ route('profile') }}">Kembali</a>
@endsection 