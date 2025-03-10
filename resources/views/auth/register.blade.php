@extends("layouts.auth")

@section("style")
<style>
/* Full-screen centering with gradient background */
html, body {
    height: 100%;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(-45deg, #ff9a9e, #fad0c4, #ffdde1, #fc6076);
    background-size: 400% 400%;
    animation: gradientBG 6s infinite alternate;
}

/* Background animation */
@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    100% { background-position: 100% 50%; }
}

/* Enhanced Registration Card - Glassmorphism */
.center-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
    max-width: 450px;
    padding: 2.5rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    backdrop-filter: blur(20px);
    text-align: center;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    animation: fadeIn 1s ease-out forwards;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

/* Hover effect */
.center-container:hover {
    box-shadow: 0 20px 60px rgba(255, 117, 140, 0.6), 0 30px 80px rgba(252, 96, 118, 0.3);
    transform: translateY(-10px);
    transition: all 0.3s ease-in-out;
}

/* Wider input fields */
.form-signin input {
    width: 140%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    border: 2px solid transparent;
    transition: 0.3s;
    background: rgba(255, 255, 255, 0.8);
}

.form-signin input:focus {
    border-color: #ff758c;
    box-shadow: 0 0 15px #ff758c;
    outline: none;
}

/* Enhanced Sign-Up Button */
.btn-primary {
    background: #ff758c;
    border: none;
    padding: 12px 15px;
    font-size: 16px;
    transition: 0.3s;
    border-radius: 10px;
    font-weight: bold;
    position: relative;
    overflow: hidden;
}

.btn-primary::after {
    content: "";
    position: absolute;
    width: 300%;
    height: 300%;
    top: -100%;
    left: -100%;
    background: rgba(255, 255, 255, 0.2);
    transform: rotate(45deg);
    transition: 0.4s;
}

.btn-primary:hover::after {
    top: 0;
    left: 0;
}

.btn-primary:hover {
    background: #ff5858;
    transform: scale(1.1);
}

/* Fade-in Animation */
@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(-20px); }
    100% { opacity: 1; transform: translateY(0); }
}

/* Footer Text */
.text-body-secondary {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.8);
}
</style>
@endsection

@section("content")
<main class="d-flex justify-content-center align-items-center w-100" style="height: 100vh;">
    <div class="center-container">
        <h1 class="h3 mb-3 fw-normal">Create your account</h1>

        <form class="form-signin" method="POST" action="{{ route('register.post') }}">
            @csrf
            <div class="form-floating">
                <input name="name" type="text" class="form-control mb-2" id="floatingName" placeholder="Enter Name">
                <label for="floatingName">Full Name</label>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-floating">
                <input name="email" type="email" class="form-control mb-2" id="floatingEmail" placeholder="name@example.com">
                <label for="floatingEmail">Email address</label>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-check text-start my-1">
              
            </div>

            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif

            @if(Session("error"))
            <div class="alert alert-danger">
                {{ session("error") }}
            </div>
            @endif

            <button class="btn btn-primary w-100" type="submit">Sign up</button>
            <small class="text-center">Or</small><br>
            <a href="{{ route('login') }}" class="text-center">Login</a>
            <p class="mt-3 mb-3 text-body-secondary">&copy; Todo List App 2025</p>
        </form>
    </div>
</main>
@endsection