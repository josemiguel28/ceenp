@extends('layouts.user')

@section('title', 'Dashboard Maestro')

@section('content')
    <div class="container mx-auto px-4 py-8">

        <x-materias-user :materias="$materias" />
    </div>
@endsection
