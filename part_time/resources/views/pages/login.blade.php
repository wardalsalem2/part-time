@include('component.header')

<div class="body">
    <div class="login-container">
        <div class="login-wrap">
            <div class="login-html">
                <!-- Tabs -->
                <input id="tab-1" type="radio" name="tab" class="sign-in" {{ old('tab') != 'register' ? 'checked' : '' }}>
                <label for="tab-1" class="tab">Sign In</label>
                <input id="tab-2" type="radio" name="tab" class="sign-up" {{ old('tab') == 'register' ? 'checked' : '' }}>
                <label for="tab-2" class="tab">Sign Up</label>

                <div class="login-form">

                    <!-- Sign In Form -->
                    <div class="sign-in-htm">
                        <form action="{{ route('goLogin') }}" method="POST">
                            @csrf
                            <input type="hidden" name="tab" value="login">
                            <div class="group">
                                <label for="sign-in-email" class="label">Email</label>
                                <input id="sign-in-email" type="email" name="email" class="input" required autocomplete="email">
                                @error('email')
                                    <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="sign-in-password" class="label">Password</label>
                                <input id="sign-in-password" type="password" name="password" class="input" required autocomplete="current-password">
                                @error('password')
                                    <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <button type="submit" class="button" style="background-color:#6ec0c7;">Sign In</button>
                            </div>
                        </form>
                        <div class="hr"></div>
                    </div>

                    <!-- Sign Up Form -->
                    <div class="sign-up-htm">
                        <form id="login-form" action="{{ route('register') }}" method="POST">
                            @csrf
                            <input type="hidden" name="tab" value="register">

                            <div class="group">
                                <label for="sign-up-name" class="label">Username</label>
                                <input id="sign-up-name" type="text" name="name" class="input" required autocomplete="username">
                                @error('name')
                                    <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="sign-up-email" class="label">Email</label>
                                <input id="sign-up-email" type="email" name="email" class="input" required autocomplete="email">
                                @error('email')
                                    <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="sign-up-password" class="label">Password</label>
                                <input id="sign-up-password" type="password" name="password" class="input" required autocomplete="new-password">
                                @error('password')
                                    <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group">
                                <label for="sign-up-password-confirm" class="label">Confirm Password</label>
                                <input id="sign-up-password-confirm" type="password" name="password_confirmation" class="input" required autocomplete="new-password">
                            </div>

                            <!-- Register As Fieldset -->
                            <div class="group">
                                <fieldset>
                                    <legend>Register As</legend>
                                    <div class="radio-toggle">
                                        <input type="radio" id="sign-up-role-user" name="role_id" value="1" {{ old('role_id') != '2' ? 'checked' : '' }}>
                                        <label for="sign-up-role-user" style="background-color:#6ec0c7;">User</label>

                                        <input type="radio" id="sign-up-role-company" name="role_id" value="2" {{ old('role_id') == '2' ? 'checked' : '' }}>
                                        <label for="sign-up-role-company" style="background-color:#6ec0c7;">Company</label>
                                    </div>
                                </fieldset>
                                @error('role_id')
                                    <p style="color:red;">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Company Specific Fields -->
                            <div id="company_fields" style="display: none;">
                                @php
                                    $companyFields = [
                                        'company_name' => 'Company Name',
                                        'company_website' => 'Website',
                                        'company_phone' => 'Phone',
                                        'company_address' => 'Address',
                                        'company_city' => 'City',
                                        'company_description' => 'Description',
                                        'company_industry' => 'Industry',
                                        'company_email' => 'Company Email',
                                        'company_num_employees' => 'Number of Employees',
                                    ];
                                @endphp

                                @foreach($companyFields as $field => $label)
                                    <div class="group">
                                        <label for="sign-up-{{ $field }}" class="label">{{ $label }}</label>
                                        @if($field == 'company_description')
                                            <textarea id="sign-up-{{ $field }}" name="{{ $field }}" class="input">{{ old($field) }}</textarea>
                                        @else
                                            <input id="sign-up-{{ $field }}" type="{{ $field == 'company_email' ? 'email' : ($field == 'company_num_employees' ? 'number' : 'text') }}"
                                                name="{{ $field }}" class="input" value="{{ old($field) }}">
                                        @endif
                                        @error($field)
                                            <p style="color:red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>

                            <!-- Submit -->
                            <div class="group">
                                <button type="submit" class="button" style="background-color:#6ec0c7;">Sign Up</button>
                            </div>

                            <!-- Show/Hide Company Fields -->
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

                                    toggleCompanyFields(); // Load state
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
