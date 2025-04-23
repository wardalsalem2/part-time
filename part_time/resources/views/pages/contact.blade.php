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
                            <p>Jordan, Amman</p>
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
                    <!-- Contact Form -->
                    <form id="contactForm" action="{{ route('contact.store') }}" method="POST" onsubmit="return validateContactForm()">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <input type="text" name="name" id="inputName" class="form-control" placeholder="Your Name" value="{{ old('name') }}" >
                                <div class="text-danger small" id="errorName"></div>
                            </div>

                            <div class="col-md-6">
                                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Your Email" value="{{ old('email') }}" >
                                <div class="text-danger small" id="errorEmail"></div>
                            </div>

                            <div class="col-md-12">
                                <input type="text" name="subject" id="inputSubject" class="form-control" placeholder="Subject" value="{{ old('subject') }}" >
                                <div class="text-danger small" id="errorSubject"></div>
                            </div>

                            <div class="col-md-12">
                                <textarea name="message" id="inputMessage" class="form-control" rows="6" placeholder="Message" >{{ old('message') }}</textarea>
                                <div class="text-danger small" id="errorMessage"></div>
                            </div>

                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn w-50" style="background-color:#6ec0c7; border-radius: 50px; color: white;">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

@if (session('success'))
    <div class="alert alert-success text-center mt-3">
        {{ session('success') }}
    </div>
@endif

@include('component.footer')

<!-- JavaScript Validation -->
<script>
function validateContactForm() {
    let valid = true;

    document.getElementById('errorName').textContent = '';
    document.getElementById('errorEmail').textContent = '';
    document.getElementById('errorSubject').textContent = '';
    document.getElementById('errorMessage').textContent = '';

    const name = document.getElementById('inputName').value.trim();
    const email = document.getElementById('inputEmail').value.trim();
    const subject = document.getElementById('inputSubject').value.trim();
    const message = document.getElementById('inputMessage').value.trim();

    if (name === '') {
        document.getElementById('errorName').textContent = 'Please enter your name.';
        valid = false;
    }

    if (email === '') {
        document.getElementById('errorEmail').textContent = 'Please enter your email.';
        valid = false;
    } else if (!/^\S+@\S+\.\S+$/.test(email)) {
        document.getElementById('errorEmail').textContent = 'Invalid email format.';
        valid = false;
    }

    if (subject === '') {
        document.getElementById('errorSubject').textContent = 'Please enter a subject.';
        valid = false;
    }

    if (message === '') {
        document.getElementById('errorMessage').textContent = 'Please enter your message.';
        valid = false;
    }

    return valid;
}
</script>
