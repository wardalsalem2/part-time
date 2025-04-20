@include('component.header')
<main class="main">
<!-------------------------------------- face of web Section ------------------------------------------------>
    <section id="hero" class="hero section dark-background">
        <img src="assets/img/contact-page-title-bg.jpg" alt="" data-aos="fade-in">
        <div class="container">
            <div class="row">
                <div class="col-xl-4">
                    <h1 data-aos="fade-up">Find the Perfect Part-Time Job</h1>
                    <blockquote data-aos="fade-up" data-aos-delay="100">
                        <p>Balance your studies and work with flexible job opportunities designed for university
                            students like you.</p>
                    </blockquote>
                    <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{route(name: 'jobOffersIndex')}}" class="btn-get-started"
                            style=" background-color:#6ec0c7;">Explore Jobs Now</a>
                    </div>
                </div>
            </div>
    </section>
    {{----------------------------------- aboute us ---------------------------------------------------------- --}}
    <section id="about" class="about section">
        <div class="container">
            <div class="section-header text-center mb-5" data-aos="fade-up">
                <h2 class="text-center mb-4" style="font-size: 2.5rem; font-weight: 700;">About Us</h2>
                <p>Discover how we connect students with the best part-time job opportunities.</p>
            </div>

            <div class="row g-0">
                <div class="col-xl-5 img-bg" data-aos="fade-up" data-aos-delay="100">
                    <img src="assets/img/why-us-bg.jpg" alt="">
                </div>

                <div class="col-xl-7 slides position-relative" data-aos="fade-up" data-aos-delay="200">
                    <div class="swiper init-swiper">
                        <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
                            "autoplay": {
                                "delay": 5000
                            },
                            "slidesPerView": "auto",
                            "centeredSlides": true,
                            "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                            },
                            "navigation": {
                                "nextEl": ".swiper-button-next",
                                "prevEl": ".swiper-button-prev"
                            }
                        }
                    </script>
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="item">
                                    <h3 class="mb-3">Empowering Students with Opportunities</h3>
                                    <h4 class="mb-3">We connect university students with part-time jobs that fit their
                                        schedules.</h4>
                                    <p>Our mission is to help students gain real-world experience, earn extra income,
                                        and develop their skills while balancing their studies. We believe in providing
                                        flexible job opportunities that support students’ academic and professional
                                        growth.</p>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="item">
                                    <h3 class="mb-3">Why Choose Us?</h3>
                                    <h4 class="mb-3">A trusted platform for students and employers alike.</h4>
                                    <p>We make job searching easy and efficient by offering verified job listings,
                                        direct communication with employers, and a user-friendly platform tailored for
                                        students. Whether you're looking for remote work, internships, or freelance
                                        gigs, we’ve got you covered.</p>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="item">
                                    <h3 class="mb-3">Connecting Talent with the Right Opportunities</h3>
                                    <h4 class="mb-3">Helping businesses find motivated student workers.</h4>
                                    <p>Employers can find enthusiastic, skilled students who are eager to contribute and
                                        learn. Our platform simplifies the hiring process by matching employers with
                                        students who meet their needs, ensuring a seamless recruitment experience.</p>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="item">
                                    <h3 class="mb-3">Your Journey Starts Here</h3>
                                    <h4 class="mb-3">Take control of your career while studying.</h4>
                                    <p>Whether you need a part-time job to support your education or want to gain
                                        experience in your field of interest, our platform is the perfect place to
                                        start. Join us and unlock a world of opportunities!</p>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </section>
    <hr class="section-divider">
    <!-------------------------------------------- jobs Section------------------------------------------- -->
    <section id="job-offers" class="job-offers section py-5" style="background-color: #ffffff;">
        <div class="container">
            <h2 class="text-center mb-4" style="font-size: 2.5rem; font-weight: 700;">Job Offers</h2>
            <p class="text-center mb-5 text-muted" style="font-size: 1.1rem;">Browse through the latest job offers and
                find your next opportunity!</p>

            <div class="row g-4">
                @foreach ($jobOffers as $job)
                    <div class="col-lg-4 col-md-6">
                        <div class="card"
                            style="border: none; border-radius: 20px; background: white; box-shadow: 0 12px 25px rgba(0, 0, 0, 0.06); transition: all 0.3s ease-in-out;">
                            <div class="card-header"
                                style="background: linear-gradient(135deg, #6ec0c7, #3b8f94); color: white; border-radius: 20px 20px 0 0; padding: 1.5rem; text-align: center;">
                                <h5 class="card-title mb-0" style="font-size: 1.4rem; font-weight: 700;">{{ $job->title }}
                                </h5>
                            </div>
                            <div class="card-body" style="padding: 2rem;">
                                <div class="job-meta" style="margin-bottom: 1rem;">
                                    <p class="mb-2" style="font-size: 0.95rem; color: #555;">
                                        <i class="fas fa-building me-2" style="color: #6ec0c7;"></i>
                                        {{ $job->company->name }}
                                    </p>
                                    <p class="mb-2" style="font-size: 0.95rem; color: #555;">
                                        <i class="fas fa-map-marker-alt me-2" style="color: #6ec0c7;"></i>
                                        {{ $job->location }}
                                    </p>
                                    <p class="mb-2" style="font-size: 0.95rem; color: #555;">
                                        <i class="bi bi-tags me-2" style="color: #6ec0c7;"></i>
                                        {{ $job->category }}
                                    </p>
                                    <p class="mb-2" style="font-size: 0.95rem; color: #555;">
                                        <i class="fas fa-money-bill-wave me-2" style="color: #6ec0c7;"></i>
                                        {{ number_format($job->salary, 2) }}
                                        JD
                                    </p>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge"
                                        style="background-color: #6ec0c7; color: white; padding: 0.4rem 0.8rem; font-size: 0.85rem; border-radius: 10px;">W.Hours:
                                        {{ ucfirst($job->work_hours) }}</span>
                                    <small class="text-muted" style="font-size: 0.9rem;">
                                        <i class="fas fa-clock me-1"></i>
                                        Deadline: {{ \Carbon\Carbon::parse($job->deadline)->format('d M, Y') }}
                                    </small>
                                </div>
                                <p class="mt-3 text-truncate-3"
                                    style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; font-size: 1rem; color: #555;">
                                    {{ Str::limit($job->description, 150) }}
                                </p>
                                <a href="{{ route('jobOffersDetails', $job->id) }}" class="btn btn-primary mt-3 w-100"
                                    style="background: linear-gradient(135deg, #6ec0c7, #3b8f94); border: none; padding: 0.75rem 1.5rem; font-weight: 600; color: white; border-radius: 30px; transition: all 0.3s ease;">
                                    View Details <i class="fas fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <hr class="section-divider">
    <!------------------------------------ Services Section ---------------------------------------------------->
    <section id="services" class="services section">
        <div class="container section-title" data-aos="fade-up">
            <h2 class="text-center mb-4" style="font-size: 2.5rem; font-weight: 700;">Our Services</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div>
    
        <div class="container">
            <div class="row gy-4">
                <!-- Repeatable Service Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="card service-card h-100 shadow-sm border-light" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-body text-center">
                            <div class="icon mb-3">
                                <i class="bi bi-clipboard" style="color: #f57813; font-size: 2rem;"></i>
                            </div>
                            <h4 class="card-title">Part-Time Job Listings</h4>
                            <p class="card-text">Explore part-time job opportunities for university students, including remote work options.</p>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-4 col-md-6">
                    <div class="card service-card h-100 shadow-sm border-light" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-body text-center">
                            <div class="icon mb-3">
                                <i class="bi bi-robot" style="color: #15a04a; font-size: 2rem;"></i>
                            </div>
                            <h4 class="card-title">Smart Job Matching</h4>
                            <p class="card-text">AI-driven job matching system connecting students with the most suitable job offers.</p>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-4 col-md-6">
                    <div class="card service-card h-100 shadow-sm border-light" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-body text-center">
                            <div class="icon mb-3">
                                <i class="bi bi-briefcase" style="color: #d90769; font-size: 2rem;"></i>
                            </div>
                            <h4 class="card-title">Internship & Training</h4>
                            <p class="card-text">Get hands-on training and internship opportunities that prepare you for the job market.</p>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-4 col-md-6">
                    <div class="card service-card h-100 shadow-sm border-light" data-aos="fade-up" data-aos-delay="400">
                        <div class="card-body text-center">
                            <div class="icon mb-3">
                                <i class="bi bi-hand-thumbs-up" style="color: #6ec0c7; font-size: 2rem;"></i>
                            </div>
                            <h4 class="card-title">Employer Support</h4>
                            <p class="card-text">Supporting employers in finding talented students who fit their job requirements.</p>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-4 col-md-6">
                    <div class="card service-card h-100 shadow-sm border-light" data-aos="fade-up" data-aos-delay="500">
                        <div class="card-body text-center">
                            <div class="icon mb-3">
                                <i class="bi bi-person-check" style="color: #f5cf13; font-size: 2rem;"></i>
                            </div>
                            <h4 class="card-title">Career Guidance</h4>
                            <p class="card-text">Providing career advice and guidance to help students navigate the job market successfully.</p>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-4 col-md-6">
                    <div class="card service-card h-100 shadow-sm border-light" data-aos="fade-up" data-aos-delay="600">
                        <div class="card-body text-center">
                            <div class="icon mb-3">
                                <i class="bi bi-globe" style="color: #6ec0c7; font-size: 2rem;"></i>
                            </div>
                            <h4 class="card-title">Flexible Work Options</h4>
                            <p class="card-text">Offering flexible work options that fit your schedule and work preferences.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!------------------------------------------------ contact us  Section ---------------------------------------------->
    <section id="call-to-action" class="call-to-action section dark-background" style="padding: 80px 0;">
        <div class="cta-background" style="position: relative; height: 500px;">
            <img src="assets/img/cta-bg.jpg" alt="" class="w-100 h-100" style="object-fit: cover;">

            <div class="container h-100">
                <div class="row justify-content-center align-items-center h-100 text-center" data-aos="zoom-in"
                    data-aos-delay="100">
                    <div class="col-xl-10">
                        <h3 class="text-white" style="font-size: 36px; font-weight: 700; line-height: 1.3;">Join the
                            Best Part-Time Opportunities</h3>
                        <p class="text-white"
                            style="font-size: 18px; max-width: 700px; margin: 20px auto; line-height: 1.5;">
                            Looking for a flexible part-time job while studying? Explore a range of opportunities
                            designed
                            specifically for university students. Get started today and find the perfect job that fits
                            your
                            schedule and skills.
                        </p>
                        <a class="cta-btn" href="{{ route('contactCreate') }}"
                        style="background: linear-gradient(135deg, #6ec0c7, #3b8f94); border: none; padding: 0.75rem 1.5rem; font-weight: 600; color: white; border-radius: 30px; transition: all 0.3s ease;">
                        Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@include('component.footer')