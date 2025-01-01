<style>
    .auth .auth-form-light select {
        color: #03164c;
    }
    .my_select {
        line-height: 14px;
        color: #03164c;
        display: block;
        padding-left: 8px;
        padding-right: 20px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        text-shadow: none;
        background: transparent;
        font-size: 0.9375rem;
        border: 1px solid #dee2e6;
        font-weight: 400;
        border-radius: 4px;
        height: 2.75rem;
        box-sizing: border-box;
        cursor: pointer;
        user-select: none;
        -webkit-user-select: none;
    }
    .my_select::before, .my_select::after {
        box-sizing: border-box;
    }
</style>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <h4>Hello! let's get You Connected Again</h4>
                        <h6 class="fw-light">Subscribe in to continue.</h6>
                        <h6>
                            <p class="text-danger"><?php echo $system_message; ?></p>
                        </h6>
                        <form class="pt-3" method="post" action="/payment">
                            <div class="form-group">
                                <label for="Email Address"></label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email"
                                       placeholder="Email Address" required>
                            </div>
                            <div class="form-group password-container">
                                <label for="" id="output">Phone Number</label>
                                <input type="tel" class="form-control form-control-lg" placeholder="Phone Number"
                                       aria-label="phone_number" aria-describedby="phone_number" name="phone_number"
                                       id="phone_number" required>
                            </div>
                            <script>
                                const input = document.querySelector("#phone_number");
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
                            <div class="form-group" data-select2-id="7">
                                <label for="my_select ">Subscription Package</label>
                                <select id="my_select " class="my_select  w-100" name="subscription_package">
                                    <option value="Annual" data-select2-id="3">Annual</option>
                                    <option value="six_months" data-select2-id="18">Six Months</option>
                                    <option value="monthly" data-select2-id="19">Monthly</option>
                                </select>
                            </div>
                            <div class="mt-3 d-grid gap-2">
                                <button class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn account" name="login" type="submit">
                                    Complete Your Subscription
                                </button>
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