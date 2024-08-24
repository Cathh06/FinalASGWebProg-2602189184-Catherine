<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="d-flex justify-content-center mt-5">
        <h1>Payment Form</h1>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-md-4 mt-5">
            <h3>Register Fee: {{ $price }}</h3>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('processpayment') }}" method="post">
                @csrf
                <div class="mb-3 mt-4">
                    <label for="amount" class="form-label">Enter amount:</label>
                    <input type="number" class="form-control" id="amount" name="amount" required value="{{ old('amount') }}">
                    <input type="hidden" name="price" value="{{ $price }}">
                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                </div>

                <button type="submit" class="btn btn-primary">Pay</button>
            </form>

            @if(session('overpaid'))
                <div class="alert alert-warning mt-3">
                    Sorry, you overpaid by {{ session('overpaidAmount') }}.
                    <form action="{{ route('coin-store') }}" method="post" class="d-inline">
                        @csrf
                        <input type="hidden" name="overpaidAmount" value="{{ session('overpaidAmount') }}">
                        <input type="hidden" name="user_id" value="{{ session('user_id') }}">
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </form>
                    <a href="{{ route('payment') }}" class="btn btn-secondary">No</a>
                </div>
            @endif

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
