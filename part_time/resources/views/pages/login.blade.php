@include('component.header')

<div class="body">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 border">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4 border">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="login-container">
        <div class="login-wrap">
            <div class="login-html">
                <!-- Tabs -->
                <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
                <label for="tab-1" class="tab">Sign In</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up">
                <label for="tab-2" class="tab">Sign Up</label>

                <div class="login-form">
                    <!-- Sign In Form -->
                    <div class="sign-in-htm">
                        <form action="{{ route('goLogin') }}" method="POST">
                            @csrf
                            {{-- @if ($errors->any())
                            <div>
                                @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                                @endforeach
                            </div>
                            @endif --}}
                            <div class="group">
                                <label for="sign-in-email" class="label">Email</label>
                                <input id="sign-in-email" type="email" name="email" class="input" required
                                    autocomplete="email">
                            </div>
                            <div class="group">
                                <label for="sign-in-password" class="label">Password</label>
                                <input id="sign-in-password" type="password" name="password" class="input" required
                                    autocomplete="current-password">
                            </div>

                            <div class="group">
                                <button type="submit" class="button" style="background-color:#6ec0c7;">Sign In</button>
                            </div>

                            @if ($errors->has('email'))
                                <div class="text-danger mt-2">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </form>
                        <div class="hr"></div>
                    </div>

                    <!-- Sign Up Form -->
                    <div class="sign-up-htm">
                        <form id="login-form" action="{{ route('register') }}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div>
                                    @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            <div class="group">
                                <label for="sign-up-name" class="label">Username</label>
                                <input id="sign-up-name" type="text" name="name" class="input" required
                                    autocomplete="username">
                            </div>
                            <div class="group">
                                <label for="sign-up-email" class="label">Email</label>
                                <input id="sign-up-email" type="email" name="email" class="input" required
                                    autocomplete="email">
                            </div>
                            <div class="group">
                                <label for="sign-up-password" class="label">Password</label>
                                <input id="sign-up-password" type="password" name="password" class="input" required
                                    autocomplete="new-password">
                            </div>
                            <div class="group">
                                <label for="sign-up-password-confirm" class="label">Confirm Password</label>
                                <input id="sign-up-password-confirm" type="password" name="password_confirmation"
                                    class="input" required autocomplete="new-password">
                            </div>

                            <!-- Register As Fieldset -->
                            <div class="group">
                                <fieldset>
                                    <legend>Register As</legend>
                                    <div class="radio-toggle">
                                        <input type="radio" id="sign-up-role-user" name="role_id" value="1" checked>
                                        <label for="sign-up-role-user" style="background-color:#6ec0c7;">User</label>

                                        <input type="radio" id="sign-up-role-company" name="role_id" value="2">
                                        <label for="sign-up-role-company"
                                            style="background-color:#6ec0c7;">Company</label>
                                    </div>
                                </fieldset>
                            </div>


                            <!-- Company Specific Fields -->
                            <div id="company_fields" style="display: none;">
                                <div class="group">
                                    <label for="sign-up-company-name" class="label">Company Name</label>
                                    <input id="sign-up-company-name" type="text" name="company_name" class="input"
                                        autocomplete="organization">
                                </div>
                                <div class="group">
                                    <label for="sign-up-company-website" class="label">Website</label>
                                    <input id="sign-up-company-website" type="url" name="company_website" class="input"
                                        autocomplete="url">
                                </div>
                                <div class="group">
                                    <label for="sign-up-company-phone" class="label">Phone</label>
                                    <input id="sign-up-company-phone" type="text" name="company_phone" class="input"
                                        autocomplete="tel">
                                </div>
                                <div class="group">
                                    <label for="sign-up-company-address" class="label">Address</label>
                                    <input id="sign-up-company-address" type="text" name="company_address" class="input"
                                        autocomplete="street-address">
                                </div>
                                <div class="group">
                                    <label for="sign-up-company-city" class="label">City</label>
                                    <input id="sign-up-company-city" type="text" name="company_city" class="input"
                                        autocomplete="address-level2">
                                </div>
                                <div class="group">
                                    <label for="sign-up-company-description" class="label">Description</label>
                                    <textarea id="sign-up-company-description" name="company_description" class="input"
                                        autocomplete="off"></textarea>
                                </div>
                                <div class="group">
                                    <label for="sign-up-company-industry" class="label">Industry</label>
                                    <input id="sign-up-company-industry" type="text" name="company_industry"
                                        class="input">
                                </div>
                                <div class="group">
                                    <label for="sign-up-company-email" class="label">Company Email</label>
                                    <input id="sign-up-company-email" type="email" name="company_email" class="input">
                                </div>
                                <div class="group">
                                    <label for="sign-up-company-num_employees" class="label">Number of Employees</label>
                                    <input id="sign-up-company-num_employees" type="number" name="company_num_employees"
                                        class="input">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="group">
                                <button type="submit" class="button" style="background-color:#6ec0c7;">Sign Up</button>
                            </div>

                            <!-- JavaScript to Show/Hide Company Fields -->
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const roleInputs = document.querySelectorAll('input[name="role_id"]');
                                    const companyFields = document.getElementById('company_fields');

                                    function toggleCompanyFields() {
                                        if (document.getElementById('sign-up-role-company').checked) {
                                            companyFields.style.display = 'block';
                                        } else {
                                            companyFields.style.display = 'none';
                                        }
                                    }

                                    roleInputs.forEach(input => {
                                        input.addEventListener('change', toggleCompanyFields);
                                    });

                                    // Run on page load in case of validation errors
                                    toggleCompanyFields();
                                });
                            </script>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('component.footer')