<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script> 
    <link rel="stylesheet" href="{{asset('welcome/welcome.css') }}" />
    <title>Sign in & Sign up Form</title>
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">


                <!-- Sign In Form -->
                <form action="{{ route('serviceProvider.login.post') }}" method="POST" class="sign-in-form">
                @csrf
                <h2 class="title">Sign in</h2>
                <div class="input-field">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required />
                </div>
                <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required />
                </div>
                <input type="submit" value="Login" class="btn solid" />
                <p class="social-text">Or Sign in with social platforms</p>
    <div class="social-media">
        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
        <a href="#" class="social-icon"><i class="fab fa-google"></i></a>
        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
    </div>
</form>



                <!-- Sign Up Form -->
                <form action="/service-provider-signup" method="POST" class="sign-up-form" id="serviceProviderSignupForm">
                    @csrf 
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="business_name" placeholder="Business Name" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-id-card"></i>
                        <input type="text" name="business_license_no" placeholder="Business License No" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-phone-alt"></i>
                        <input type="text" name="contact_no" placeholder="Contact No" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                    <input type="submit" class="btn" value="Sign up" />
                    <p class="social-text">Or Sign up with social platforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-google"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </form>

                <!-- Message Display -->
                <div id="responseMessage" style="display: none; margin-top: 10px;"></div>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here?</h3>
                    <p>Welcome to our platform. To keep connected with us please login with your personal info</p>
                    <button class="btn transparent" id="sign-up-btn">Sign up</button>
                </div>
                <img src="{{ asset('welcome/log.svg') }}" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us?</h3>
                    <p>If you already have an account, just sign in. We've missed you!</p>
                    <button class="btn transparent" id="sign-in-btn">Sign in</button>
                </div>
                <img src="{{ asset('welcome/register.svg') }}" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="{{ asset('welcome/welcome.js') }}"></script>
    <script>

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('serviceProviderSignupForm').addEventListener('submit', function(e) {
        e.preventDefault();

        console.log('Form submitted');

        let formData = new FormData(this);

        fetch('/service-provider-signup', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json().then(data => ({status: response.status, body: data})))
        .then(({status, body}) => {
            if (status === 200) {
                swal({
                    title: "Success!",
                    text: body.message,
                    icon: "success",
                    button: "OK"
                }).then(() => {
                    window.location.href = '/';
                });
            } else {
                swal({
                    title: "Error!",
                    text: body.message,
                    icon: "error",
                    button: "OK"
                });
            }
        })
        .catch(error => {
            swal({
                title: "Unexpected Error!",
                text: "An unexpected error occurred. Please try again later.",
                icon: "error",
                button: "OK"
            });
            console.error('Error:', error);
        });
    });
});


document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('serviceProviderSignupForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        fetch('/service-provider-signup', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json().then(data => ({status: response.status, body: data})))
        .then(({status, body}) => {
            if (status === 200) {
                swal({
                    title: "Success!",
                    text: body.message,
                    icon: "success",
                    button: "OK"
                }).then(() => {
                    window.location.href = '/';
                });
            } else {
                swal({
                    title: "Error!",
                    text: body.message,
                    icon: "error",
                    button: "OK"
                });
            }
        })
        .catch(error => {
            swal({
                title: "Unexpected Error!",
                text: "An unexpected error occurred. Please try again later.",
                icon: "error",
                button: "OK"
            });
            console.error('Error:', error);
        });
    });

    // Intercept login form submission
    document.querySelector('.sign-in-form').addEventListener('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        fetch('{{ route('serviceProvider.login.post') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json().then(data => ({status: response.status, body: data})))
        .then(({status, body}) => {
            if (status === 200) {
                swal({
                    title: "Success!",
                    text: "Logged in successfully!",
                    icon: "success",
                    button: "OK"
                }).then(() => {
                    window.location.href = `/providerdashboard?business_name=${encodeURIComponent(body.business_name)}`;
                });
            } else {
                swal({
                    title: "Error!",
                    text: body.message || "Invalid login credentials.",
                    icon: "error",
                    button: "OK"
                });
            }
        })
        .catch(error => {
            swal({
                title: "Unexpected Error!",
                text: "An unexpected error occurred. Please try again later.",
                icon: "error",
                button: "OK"
            });
            console.error('Error:', error);
        });
    });
});

    </script>
</body>
</html>
