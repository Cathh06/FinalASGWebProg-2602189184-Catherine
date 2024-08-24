@extends('layout')

@section('title', 'Request')
@section('setAktif', 'active')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="container">
        <div class="row">
            @foreach ($friendRequest as $user)
                <div class="col-md-4 mb-4 mt-5">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $user->profile) }}" alt="{{ $user->name }}'s profile"
                            class="card-img-top img-fluid" style="object-fit: cover; height: 250px;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">{{ $user->hobby }}</p>
                            <div class="d-flex justify-content-between">
                                <form method="POST" action="{{ route('friend.store') }}" class="mb-2">
                                    @csrf
                                    <input type="hidden" name="request_id" value="{{ $user->request_id }}">
                                    <input type="hidden" name="friend_id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-primary rounded-circle p-3" title="Accept">
                                        <i class="fas fa-thumbs-up"></i>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('friend-request.destroy', $user->request_id) }}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger rounded-circle p-3" title="Decline">
                                        <i class="fas fa-thumbs-down"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
