@extends('layout')
@section('title', 'Home')
@section('setAktif', 'active')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex flex-column align-items-center mt-3">
        <!-- Search Form -->
        <form method="GET" action="{{ route('user.index') }}" class="mb-4 w-50">
            <div class="row">
                <div class="col-md-9 mx-auto">
                    <input type="text" name="search" class="form-control" placeholder="Search by name"
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-3 mx-auto">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </div>
        </form>

        <!-- Gender Filter -->
        <div class="mb-4">
            <form method="GET" action="{{ route('user.index') }}">
                <input type="hidden" name="search" value="{{ request('search') }}">
                <div class="btn-group" role="group" aria-label="Gender filter">
                    <button type="submit" name="gender" value="" class="btn btn-outline-secondary {{ request('gender') === '' ? 'active' : '' }}">All</button>
                    <button type="submit" name="gender" value="male" class="btn btn-outline-secondary {{ request('gender') === 'male' ? 'active' : '' }}">Male</button>
                    <button type="submit" name="gender" value="female" class="btn btn-outline-secondary {{ request('gender') === 'female' ? 'active' : '' }}">Female</button>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="row mt-4">
            @foreach ($users as $user)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $user->profile) }}" alt="{{ $user->name }}"
                            class="card-img-top img-fluid" style="object-fit: cover; height: 250px;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">{{ $user->hobby }}</p>
                            <form method="POST" action="{{ route('friend-request.store') }}" class="mt-auto">
                                @csrf
                                <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-thumbs-up"></i>
                                </button>                                    
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@push('styles')
<style>
    .btn-outline-secondary {
        border-radius: 0; 

    .btn-outline-secondary.active {
        background-color: #007bff; /* Change to desired active color */
        color: white;
        border-color: #007bff;
    }
</style>
@endpush
