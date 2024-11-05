<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/css/intlTelInput.css">
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/intlTelInput.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" />
<style>
    .iti {
        position: relative;
        display: inline-block;
        width: 100%;
    }
</style>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo">
                            <a href="/"><img src="assets/images/logo.png" alt="logo"></a>
                        </div>
                        <h4>New here?</h4>
                        <h6 class="fw-light">Signing up is easy. It only takes a few steps</h6>
                        <h6>
                            <p class="text-danger"><?php echo $system_message; ?></p>
                        </h6>
                        <form class="pt-3" action="/user_registration" method="post">
                            <div class="form-group">
                                <input type="text" name="username[]" class="form-control form-control-lg"
                                   placeholder="Enter Username" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"></label>
                                <input type="email" class="form-control form-control-lg" id="exampleInputEmail1"
                                       name="email[]" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="tel" id="output"></label>
                                <input type="text" name="phone[]" class="form-control form-control-lg" id="tel"
                                   placeholder="Enter Phone Number" required>
                                <script>
                                    const input = document.querySelector("#tel");
                                    const output = document.querySelector("#output");
                                    const iti = window.intlTelInput(input, {
                                        initialCountry: "ug",
                                        nationalMode: true,
                                        strictMode: true,
                                        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@23.0.10/build/js/utils.js",
                                    });
                                    const handleChange = () => {
                                        let text;
                                        if (input.value) {
                                            if(iti.isValidNumber()){
                                                text = "Valid number! Full international format: "+iti.getNumber();
                                                input.value = iti.getNumber();
                                            }else {
                                                text = "Invalid number - please try again";
                                            }
                                        } else {
                                            text = "Please enter a valid number below";
                                        }
                                        const textNode = document.createTextNode(text);
                                        output.innerHTML = "";
                                        output.appendChild(textNode);
                                    };
                                    // listen to "keyup", but also "change" to update when the user selects a country
                                    input.addEventListener('change', handleChange);
                                    input.addEventListener('keyup', handleChange);
                                </script>
                            </div>
                            <div class="form-group password-container">
                                <input type="password" class="form-control form-control-lg" minlength="8"
                                       placeholder="Password" id="password" name="password[]">
                                <span class="stoggle-password" onclick="togglePassword()">👁️</span>
                            </div>
                            <div class="form-group password-container">
                                <input type="password" class="form-control form-control-lg" id="c-password"
                                       placeholder="Confirm Password" name="cpassword[]" required>
                                <span class="stoggle-password" onclick="view_Password()">👁️</span>
                            </div>
                            <script>
                                function togglePassword() {
                                    const passwordField = document.getElementById("password");
                                    if (passwordField.type === "password") {
                                        passwordField.type = "text";
                                    } else {
                                        passwordField.type = "password";
                                    }
                                }
                                function view_Password(){
                                    const c_passwordField = document.getElementById("c-password");
                                    console.log('clicking me')
                                    if (c_passwordField.type === "password") {
                                        c_passwordField.type = "text";
                                    } else {
                                        c_passwordField.type = "password";
                                    }
                                }
                            </script>
                            <div class="mb-4">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input"> I agree to all Terms & Conditions </label>
                                </div>
                            </div>
                            <div class="mt-3 d-grid gap-2">
                                <button class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn account" name="signup"
                                    type="submit">Create Account</button>
                            </div>
                            <div class="text-center mt-4 fw-light"> Already have an account? <a href="/login"
                                class="text-primary">Login</a>
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