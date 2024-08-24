<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
    <div class="d-flex row-flex justify-content-center mt-5">
        <h1>Login</h1>
    </div>
    <div class="d-flex row-flex justify-content-center">
        <div class="col-md-4">
            <form action="{{route('login')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" id="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" required value="{{old('email')}}">
                    @error('email')
                        <div class="invalid-feedback" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" required value="{{old('password')}}">
                    @error('password')
                        <div class="invalid-feedback" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <small class="d-block text-center mt-2">
                    Not registered? <a href="/register" class="col-reg">Register Now!</a>
                  </small>
            </form>
        </div>
    </div>
    
</body>
</html>