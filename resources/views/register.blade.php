<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <title>Register</title>
</head>
<body>
    <div class="d-flex row-flex justify-content-center mt-5">
        <h1>Register</h1>
    </div>
    <div class="d-flex row-flex justify-content-center">
        <div class="col-md-4">
            <form action="{{url('/register')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mt-5">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror" required value="{{old('name')}}">
                        @error('name')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
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
                    <div class="mb-3">
                        <label for="Gender" class="form-label" name="gender">Gender</label>
                        <select class="form-select @error('gender') is-invalid @enderror" name="gender" aria-label="Select Gender">
                            <option selected>Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Hobby" class="form-label">Hobby (choose minimal 3)</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name = "hobby[]" value="Sport" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            Sport
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name = "hobby[]" value="Art and Crafts" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            Art and Crafts
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name = "hobby[]" value="Music" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            Music
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name = "hobby[]" value="Photography" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            Photography 
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name = "hobby[]" value="Reading" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            Reading 
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name = "hobby[]" value="Cooking" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            Cooking 
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name = "hobby[]" value="Games" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            Games 
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name = "hobby[]" value="Gardening" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            Gardening 
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name = "hobby[]" value="Adventure" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            Adventure 
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name = "hobby[]" value="Collecting" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            Collecting 
                            </label>
                        </div>  
                        @if($errors->has('hobby'))
                            <div class="invalid-feedback" role="alert">
                                {{$errors->first('hobby')}}
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="username_ig" class="form-label">Instagram username</label>
                        <input type="text" name="username_ig" id="username_ig" placeholder="http://www.instagram.com/username" class="form-control @error('username_ig') is-invalid @enderror" required value="{{old('username_ig')}}">
                        @error('username_ig')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phonenumber" class="form-label">Phone number</label>
                        <input type="text" name="phonenumber" id="phonenumber" placeholder="Phone Number" class="form-control @error('phonenumber') is-invalid @enderror" required value="{{old('phonenumber')}}">
                        @error('phonenumber')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Profile</label>
                        <input class="form-control @error('profile') is-invalid @enderror" type="file" id="profile" name="profile" required>
                        @error('profile')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                      </div>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" type="submit">Register</button>
                </div>
                <small class="d-block text-center mb-5">
                    Already have an account? <a href="/login" class="col-reg">Login</a>
                  </small>
            </form>
        </div>
    </div>
</body>
</html>