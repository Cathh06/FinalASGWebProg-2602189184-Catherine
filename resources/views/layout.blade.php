<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="">ConnectFriend</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @yield('setAktif')" href="{{ route('user.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('setAktif')" href="{{ route('friend-request.index') }}">Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('setAktif')" href="{{ route('friend.index') }}">Friends</a>
                    </li>
                </ul>
                @if (Auth::check())
                    <div class="d-flex align-items-center">
                        <span class="text-dark me-3">Welcome, {{ Auth::user()->name }}!</span>
                        
                        <!-- Notification Button -->
                        <div class="dropdown me-3">
                            <button class="btn btn-outline-primary position-relative" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bell"></i>
                                @if(Auth::user()->unreadNotifications->count())
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ Auth::user()->unreadNotifications->count() }}
                                        <span class="visually-hidden">unread notifications</span>
                                    </span>
                                @endif
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                                @forelse (Auth::user()->notifications as $notification)
                                    <li class="dropdown-item d-flex justify-content-between align-items-center">
                                        {{ $notification->data['message'] }}
                                        <a href="{{ route('notifications.destroy', $notification->id) }}" class="btn btn-danger btn-sm ms-2"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $notification->id }}').submit();">
                                            <i class="icon-close"></i>
                                        </a>
                                        <form id="delete-form-{{ $notification->id }}"
                                            action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                @empty
                                    <li class="dropdown-item">No new notifications</li>
                                @endforelse
                            </ul>
                        </div>

                        <!-- Wallet Button -->
                        <div class="dropdown me-3">
                            <button class="btn btn-outline-success position-relative" id="walletDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-wallet"></i> Wallet
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="walletDropdown">
                                    <li class="dropdown-item">
                                        {{Auth::user()->coins}} Coins
                                    </li>
                            </ul>
                        </div>
                        
                        <form method="POST" action="{{ url('/logout') }}" class="mb-0">
                            @csrf
                            <button type="submit" class="btn btn-primary">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="d-flex">
                        <a href="{{ url('/login') }}" class="btn btn-primary">Login</a>
                        {{-- <a href="{{ url('/register') }}" class="btn btn-primary">Register</a> --}}
                    </div>
                @endif
            </div>
        </div>
    </nav>
    @yield('content')

    <script src="/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
