<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo">
                            <a href="/"><img src="assets/images/logo.png" alt="logo"></a>
                        </div>
                        <h4>Hello! let's get started</h4>
                        <h6 class="fw-light">Login in to continue.</h6>
                        <h6>
                            <p class="text-danger"><?php echo $system_message; ?></p>
                        </h6>
                        <form class="pt-3" method="post" action="/userLogin">
                            <div class="form-group">
                                <label for="username"></label>
                                <input type="text" class="form-control form-control-lg" id="username" name="username"
                                 placeholder="Username or Email Address" required>
                            </div>
                            <div class="form-group password-container">
                                <input type="password" class="form-control form-control-lg" placeholder="Password"
                                       aria-label="Password" aria-describedby="password-addon" name="password"
                                       id="password" required>
                                <span class="toggle-password" onclick="togglePassword()">👁️</span>
                            </div>
                            <script>
                                function togglePassword() {
                                    var passwordField = document.getElementById("password");
                                    if (passwordField.type === "password") {
                                        passwordField.type = "text";
                                    } else {
                                        passwordField.type = "password";
                                    }
                                }
                            </script>
                            <div class="mt-3 d-grid gap-2">
                                <button class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn account" name="login" type="submit">
                                    Login to Your Account!
                                </button>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                                </div>
                                <a href="/remember" class="auth-link text-black">Forgot password?</a>
                            </div>
                            <div class="text-center mt-4 fw-light"> Don't have an account?
                                <a href="/signup" class="text-primary">Create</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>