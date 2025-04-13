@include('component.header')

<main class="main">
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/contact-page-title-bg.jpg);">
        <div class="container">
            <h1>Contact Us for Help</h1>
            <p>We are here to assist you with any inquiries. Please feel free to reach out for support and information. Your satisfaction is our priority!</p>
        </div>
    </div>

    <section id="contact" class="contact section">
        <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-5">
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                        <i class="bi bi-geo-alt flex-shrink-0" style="background-color:#6ec0c7;"></i>
                        <div>
                            <h3>Address</h3>
                            <p>Jordan , Amman</p>
                        </div>
                    </div>

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-telephone flex-shrink-0" style="background-color:#6ec0c7;"></i>
                        <div>
                            <h3>Call Us</h3>
                            <p>+962 777777777</p>
                        </div>
                    </div>

                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-envelope flex-shrink-0" style="background-color:#6ec0c7;"></i>
                        <div>
                            <h3>Email Us</h3>
                            <p>Part_time@gmail.com</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <!-- Form starts here -->
                    <form id="contact-form" action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Your Name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Your Email"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <input type="text" name="subject"
                                    class="form-control @error('subject') is-invalid @enderror" placeholder="Subject"
                                    value="{{ old('subject') }}" required>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control @error('message') is-invalid @enderror" name="message"
                                    rows="6" placeholder="Message" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn w-50" style="background-color:#6ec0c7; border-radius: 50px; color: white;">Send Message</button>
                            </div>
                            
                            
                        </div>
                    </form>
                    <!-- Form ends here -->
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Success message handling -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@include('component.footer')
