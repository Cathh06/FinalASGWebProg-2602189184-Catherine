@extends('layout')

@section('title', 'Message')
@section('setAktif', 'active')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <h1>Chat</h1>
            <div class="col-md-10 col-lg-12">
                <div class="card chat-room shadow-sm" style="height: 800px;">
                    <div class="card-body d-flex flex-column" style="height: 100%;">
                        <div class="chat-messages flex-grow-1" style="overflow-y: auto;">
                            @foreach ($messages as $msg)
                                <div
                                    class="d-flex {{ $msg->sender_id === auth()->user()->id ? 'justify-content-end' : 'justify-content-start' }} mb-3">
                                    <div class="message p-3 rounded-3 {{ $msg->sender_id === auth()->user()->id ? 'bg-primary text-white' : 'bg-light' }}"
                                        style="max-width: 75%;">
                                        <p class="mb-0">{{ $msg->message }}</p>
                                        @if ($msg->created_at)
                                            <p class="text-muted">{{ $msg->created_at->format('H:i') }}</p>
                                        @else
                                            <p class="text-muted">--</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <form method="POST" action="{{ route('message.store') }}" class="mt-3">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="new_message" class="form-control" placeholder="Enter your message"
                                    required>
                                <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
