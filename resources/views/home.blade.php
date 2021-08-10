<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <title>Drugly</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- fontawesome CSS -->
    <link rel="stylesheet" href="{{asset('assets/libs/fontawesome/all.min.css')}}" />
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('assets/libs/animate-wow/animate.min.css')}}" />
    <!-- Owl carousel CSS-->
    <link rel="stylesheet" href="{{asset('assets/libs/owlcarousel/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/libs/owlcarousel/owl.theme.default.min.css')}}" />
    <!-- Popup -->
    <link rel="stylesheet" href="{{asset('assets/libs/magnific-popup/magnific-popup.css')}}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/libs/bootstrap/bootstrap.min.css')}}" />
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('assets/libs/website/main.css')}}" />
</head>

<body>


    <!-- Preloader -->

    <div class="absCenter">
        <div class="loaderPill">
            <div class="loaderPill-anim">
                <div class="loaderPill-anim-bounce">
                    <div class="loaderPill-anim-flop">
                        <div class="loaderPill-pill"></div>
                    </div>
                </div>
            </div>
            <div class="loaderPill-floor">
                <div class="loaderPill-floor-shadow"></div>
            </div>
        </div>
    </div>


    <!-- Top Menu -->
    <div class="navbar navbar-expand-lg navbar-menu navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">Pharmacy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="show-min">
                    <ul class="navbar-nav ms-5">
                        <li class="nav-item">
                            <a class="nav-link" href="#speciality">Speciality</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#aboutUs">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#prices">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#freeReg">Consultation</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn" href="/ar">العربية <i class="fas fa-globe-africa ms-1"></i></a>
                        </li>
                    </ul>
                    <div class="d-flex ms-auto">
                        <ul class="navbar-nav me-auto sigins">
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('login') }}">Sign In</a>
                            </li>
							<!--<li class="nav-item">
                                <a class="nav-link active-link" href="/signup">Sign Up</a>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="home" class="main-banner main-banner-two">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-12">
                            <div class="hero-slides owl-carousel owl-theme owl-text-select-on">
                                <div class="item">
                                    <div class="hero-content">
                                        <h1>
                                            Providing Quality Health Care. Your Health is Our Top
                                            Priority with <span>Comprehensive</span>
                                        </h1>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore
                                            magna aliqua. Quis ipsum suspendisse ultrices gravida.
                                            Risus commodo viverra maecenas accumsan lacus vel
                                            facilisis.
                                        </p>
                                        <a href="/checkout" class="btn">Appointment Now</a>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="hero-content">
                                        <h1>
                                            Providing Quality Health Care. Your Health is Our Top
                                            Priority with <span>Comprehensive</span>
                                        </h1>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore
                                            magna aliqua. Quis ipsum suspendisse ultrices gravida.
                                            Risus commodo viverra maecenas accumsan lacus vel
                                            facilisis.
                                        </p>
                                        <a href="/checkout" class="btn">Appointment Now</a>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="hero-content">
                                        <h1>
                                            Providing Quality Health Care. Your Health is Our Top
                                            Priority with <span>Comprehensive</span>
                                        </h1>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore
                                            magna aliqua. Quis ipsum suspendisse ultrices gravida.
                                            Risus commodo viverra maecenas accumsan lacus vel
                                            facilisis.
                                        </p>
                                        <a href="/checkout" class="btn">Appointment Now</a>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="hero-content">
                                        <h1>
                                            Providing Quality Health Care. Your Health is Our Top
                                            Priority with <span>Comprehensive</span>
                                        </h1>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore
                                            magna aliqua. Quis ipsum suspendisse ultrices gravida.
                                            Risus commodo viverra maecenas accumsan lacus vel
                                            facilisis.
                                        </p>
                                        <a href="/checkout" class="btn">Appointment Now</a>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="hero-content">
                                        <h1>
                                            Providing Quality Health Care. Your Health is Our Top
                                            Priority with <span>Comprehensive</span>
                                        </h1>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore
                                            magna aliqua. Quis ipsum suspendisse ultrices gravida.
                                            Risus commodo viverra maecenas accumsan lacus vel
                                            facilisis.
                                        </p>
                                        <a href="/checkout" class="btn">Appointment Now</a>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="hero-content">
                                        <h1>
                                            Providing Quality Health Care. Your Health is Our Top
                                            Priority with <span>Comprehensive</span>
                                        </h1>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore
                                            magna aliqua. Quis ipsum suspendisse ultrices gravida.
                                            Risus commodo viverra maecenas accumsan lacus vel
                                            facilisis.
                                        </p>
                                        <a href="/checkout" class="btn">Appointment Now</a>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="hero-content">
                                        <h1>
                                            Providing Quality Health Care. Your Health is Our Top
                                            Priority with <span>Comprehensive</span>
                                        </h1>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore
                                            magna aliqua. Quis ipsum suspendisse ultrices gravida.
                                            Risus commodo viverra maecenas accumsan lacus vel
                                            facilisis.
                                        </p>
                                        <a href="/checkout" class="btn">Appointment Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12">
                            <div class="hero-video">
                                <a href="https://www.youtube.com/watch?v=bk7McNUjWgw"
                                    class="video-play-btn popup-video"><i class="fas fa-play-circle"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="boxes-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="single-box">
                        <i class="fas fa-user-md"></i>
                        <h3>Qualified Doctors</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-box">
                        <i class="fas fa-ambulance"></i>
                        <h3>Emergency Care</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-box">
                        <i class="fas fa-theater-masks"></i>
                        <h3>Operation Theater</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-box">
                        <i class="far fa-life-ring"></i>
                        <h3>24 Hours Service</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="aboutUs" class="
        our-about
        pd-100
        wow
        animate__animated animate__fadeIn animate__slow
      " style="background-image: url(assets/images/shapes/bg-intro-about.webp)">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-6">
                    <div class="section-text-container">
                        <h3 class="
                  wow
                  animate__animated
                  animate__fadeInDown
                  animate__slower
                  animate__delay-.5s
                ">
                            About Us
                        </h3>
                        <p>
                            Your life is our Speciality. Our team of experinced physicians
                            offers <br />
                            a comprehensive range healthcare services.
                        </p>
                    </div>
                    <div class="inner-about-container">
                        <div class="icon-about"><i class="fas fa-user-md"></i></div>
                        <h6>Experted Doctors</h6>
                        <p>
                            Our team of physicians treats patients of <br />
                            all ages. from infants to seniors
                        </p>
                    </div>
                    <div class="inner-about-container">
                        <div class="icon-about"><i class="far fa-hospital"></i></div>
                        <h6>Healthy Environment</h6>
                        <p>
                            Our team of physicians treats patients of <br />
                            all ages. from infants to seniors
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1542736667-069246bdbc6d?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1951&q=80"
                        class="img-fluid shadow-lg" alt="" />
                </div>
            </div>
        </div>
    </section>

    <!-- Our Speciality -->
    <section id="speciality" class="
        our-speciality
        pd-100
        wow
        animate__animated animate__fadeIn animate__slow
      " style="background-image: url(assets/images/shapes/sec-shape.webp)">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-5 text-center">
                    <div class="section-text-container">
                        <h3 class="
                  wow
                  animate__animated
                  animate__fadeInDown
                  animate__slower
                  animate__delay-.5s
                ">
                            Our Speciality
                        </h3>
                        <p>
                            Your life is our Speciality. Our team of experinced physicians
                            offers <br />
                            a comprehensive range healthcare services.
                        </p>
                    </div>
                </div>
                <div class="
              col-md-4
              wow
              animate__animated animate__fadeInRight animate__faster
            ">
                    <div class="card-container">
                        <div class="icon-card"><i class="fas fa-stethoscope"></i></div>
                        <h4 class="title-card">Primary Care</h4>
                        <p class="desc-card">
                            Our team personalizes each athlete's treatment based on his/her
                            sport and age growing bodies
                        </p>
                    </div>
                </div>
                <div class="
              col-md-4
              wow
              animate__animated animate__fadeInRight animate__faster
            ">
                    <div class="card-container">
                        <div class="icon-card"><i class="fas fa-running"></i></div>
                        <h4 class="title-card">Sport Medicine</h4>
                        <p class="desc-card">
                            Our team personalizes each athlete's treatment based on his/her
                            sport and age growing bodies
                        </p>
                    </div>
                </div>
                <div class="
              col-md-4
              wow
              animate__animated animate__fadeInRight animate__faster
            ">
                    <div class="card-container">
                        <div class="icon-card"><i class="fas fa-ambulance"></i></div>
                        <h4 class="title-card">Emergency Medicine</h4>
                        <p class="desc-card">
                            Our team personalizes each athlete's treatment based on his/her
                            sport and age growing bodies
                        </p>
                    </div>
                </div>
                <div class="
              col-md-4
              wow
              animate__animated animate__fadeInLeft animate__faster
            ">
                    <div class="card-container">
                        <div class="icon-card"><i class="fas fa-heartbeat"></i></div>
                        <h4 class="title-card">Cardiology</h4>
                        <p class="desc-card">
                            Our team personalizes each athlete's treatment based on his/her
                            sport and age growing bodies
                        </p>
                    </div>
                </div>
                <div class="
              col-md-4
              wow
              animate__animated animate__fadeInLeft animate__faster
            ">
                    <div class="card-container">
                        <div class="icon-card"><i class="fas fa-cut"></i></div>
                        <h4 class="title-card">General Surgery</h4>
                        <p class="desc-card">
                            Our team personalizes each athlete's treatment based on his/her
                            sport and age growing bodies
                        </p>
                    </div>
                </div>
                <div class="
              col-md-4
              wow
              animate__animated animate__fadeInLeft animate__faster
            ">
                    <div class="card-container">
                        <div class="icon-card"><i class="fas fa-syringe"></i></div>
                        <h4 class="title-card">infectious Disease</h4>
                        <p class="desc-card">
                            Our team personalizes each athlete's treatment based on his/her
                            sport and age growing bodies
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Prices Section -->
    <section id="prices" class="
        our-prices
        pd-100
        wow
        animate__animated animate__fadeIn animate__slow
      " style="background-image: url(assets/images/shapes/bg-intro-about.webp)">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-5 text-center">
                    <div class="section-text-container">
                        <h3>Our Pricing</h3>
                        <p>
                            Your life is our Speciality. Our team of experinced physicians
                            offers <br />
                            a comprehensive range healthcare services.
                        </p>
                    </div>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-pharmacy-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-pharmacy " type="button" role="tab"
                                aria-controls="pills-pharmacy" aria-selected="true">
                                Pharmacy
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-warehouse-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-warehouse" type="button" role="tab"
                                aria-controls="pills-warehouse" aria-selected="false">
                                Store
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-pharmacy" role="tabpanel"
                            aria-labelledby="pills-pharmacy-tab">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="pricing-table">
                                        <div class="pricing-header">
                                            <h3>Body CT Scan</h3>
                                        </div>
                                        <div class="price">
                                            <span><sup>$</sup>350</span>
                                        </div>
                                        <div class="pricing-features">
                                            <ul>
                                                <li>Cholesterol and lipid tests</li>
                                                <li>Oestrogen blood test</li>
                                                <li>Thyroid function tests</li>
                                                <li>Kidney function tests</li>
                                                <li>C-reactive protein (CRP) test</li>
                                                <li>Cholesterol and lipid tests</li>
                                                <li>Oestrogen blood test</li>
                                                <li>Thyroid function tests</li>
                                            </ul>
                                        </div>
                                        <div class="pricing-footer">
                                            <a href="/checkout" class="btn">Appointment Now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="pricing-table">
                                        <div class="pricing-header">
                                            <h3>Body CT Scan</h3>
                                        </div>
                                        <div class="price">
                                            <span><sup>$</sup>350</span>
                                        </div>
                                        <div class="pricing-features">
                                            <ul>
                                                <li>Cholesterol and lipid tests</li>
                                                <li>Oestrogen blood test</li>
                                                <li>Thyroid function tests</li>
                                                <li>Kidney function tests</li>
                                                <li>C-reactive protein (CRP) test</li>
                                                <li>Cholesterol and lipid tests</li>
                                                <li>Oestrogen blood test</li>
                                                <li>Thyroid function tests</li>
                                            </ul>
                                        </div>
                                        <div class="pricing-footer">
                                            <a href="/checkout" class="btn">Appointment Now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="pricing-table">
                                        <div class="pricing-header">
                                            <h3>Body CT Scan</h3>
                                        </div>
                                        <div class="price">
                                            <span><sup>$</sup>350</span>
                                        </div>
                                        <div class="pricing-features">
                                            <ul>
                                                <li>Cholesterol and lipid tests</li>
                                                <li>Oestrogen blood test</li>
                                                <li>Thyroid function tests</li>
                                                <li>Kidney function tests</li>
                                                <li>C-reactive protein (CRP) test</li>
                                                <li>Cholesterol and lipid tests</li>
                                                <li>Oestrogen blood test</li>
                                                <li>Thyroid function tests</li>
                                            </ul>
                                        </div>
                                        <div class="pricing-footer">
                                            <a href="/checkout" class="btn">Appointment Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-warehouse" role="tabpanel"
                            aria-labelledby="pills-warehouse-tab">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="pricing-table">
                                        <div class="pricing-header">
                                            <h3>Body CT</h3>
                                        </div>
                                        <div class="price">
                                            <span><sup>$</sup>400</span>
                                        </div>
                                        <div class="pricing-features">
                                            <ul>
                                                <li>Cholesterol and lipid tests</li>
                                                <li>Oestrogen blood test</li>
                                                <li>Thyroid function tests</li>
                                                <li>Kidney function tests</li>
                                                <li>C-reactive protein (CRP) test</li>
                                                <li>Cholesterol and lipid tests</li>
                                                <li>Oestrogen blood test</li>
                                                <li>Thyroid function tests</li>
                                            </ul>
                                        </div>
                                        <div class="pricing-footer">
                                            <a href="/checkout" class="btn">Appointment Now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="pricing-table">
                                        <div class="pricing-header">
                                            <h3>Body CT</h3>
                                        </div>
                                        <div class="price">
                                            <span><sup>$</sup>400</span>
                                        </div>
                                        <div class="pricing-features">
                                            <ul>
                                                <li>Cholesterol and lipid tests</li>
                                                <li>Oestrogen blood test</li>
                                                <li>Thyroid function tests</li>
                                                <li>Kidney function tests</li>
                                                <li>C-reactive protein (CRP) test</li>
                                                <li>Cholesterol and lipid tests</li>
                                                <li>Oestrogen blood test</li>
                                                <li>Thyroid function tests</li>
                                            </ul>
                                        </div>
                                        <div class="pricing-footer">
                                            <a href="/checkout" class="btn">Appointment Now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="pricing-table">
                                        <div class="pricing-header">
                                            <h3>Body CT</h3>
                                        </div>
                                        <div class="price">
                                            <span><sup>$</sup>400</span>
                                        </div>
                                        <div class="pricing-features">
                                            <ul>
                                                <li>Cholesterol and lipid tests</li>
                                                <li>Oestrogen blood test</li>
                                                <li>Thyroid function tests</li>
                                                <li>Kidney function tests</li>
                                                <li>C-reactive protein (CRP) test</li>
                                                <li>Cholesterol and lipid tests</li>
                                                <li>Oestrogen blood test</li>
                                                <li>Thyroid function tests</li>
                                            </ul>
                                        </div>
                                        <div class="pricing-footer">
                                            <a href="/checkout" class="btn">Appointment Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Free Reg Section -->
    <section id="freeReg" class="
        our-free-reg
        pd-100
        wow
        animate__animated animate__fadeIn animate__slow
      ">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-md-7">
                    <div class="section-text-container">
                        <h3>Free Medical Consultation</h3>
                        <p>
                            We provide a free medical consultation for our patients, Once
                            you <br />
                            submit the request, our office will contact you within one
                            business day <br />
                            to schedule your appointment
                        </p>
                        <ul class="list-medical">
                            <li>
                                <i class="fas fa-check me-3"></i> Explain you health concerns.
                            </li>
                            <li>
                                <i class="fas fa-check me-3"></i> A Specialist will answer
                                your questions.
                            </li>
                            <li>
                                <i class="fas fa-check me-3"></i> Review your case documents.
                            </li>
                            <li>
                                <i class="fas fa-check me-3"></i> Follow up your medical
                                condition.
                            </li>
                            <li>
                                <i class="fas fa-check me-3"></i> Check your surgery result.
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="requset-table">
                        <h4>Request a Free Consultation</h4>
                        <form action="">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Your Name" />
                                <label for="floatingInput">Your Name*</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="tel" class="form-control" id="floatingPhone" placeholder="Your Phone" />
                                <label for="floatingPhone">Your Phone*</label>
                            </div>
                            <div class="form-text mb-2">
                                Are You a New or Existing Patients ?*
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                    value="option1" checked />
                                <label class="form-check-label" for="inlineRadio1">New</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                    value="option2" />
                                <label class="form-check-label" for="inlineRadio2">Existing</label>
                            </div>
                            <div class="form-floating mt-3 mb-4">
                                <select class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example">
                                    <option selected>Dental Clinic</option>
                                    <option value="1">Dental Clinic</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="floatingSelect">Speciality*</label>
                            </div>
                            <button type="submit" class="btn w-100">
                                REQUEST A FREE CONSULTATION
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->

    <!-- Info Details -->
    <footer id="footer" class="our-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="info-container">
                        <i class="fas fa-phone"></i>
                        <h6>Phone</h6>
                        <span>+221 340 210 533</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-container">
                        <i class="fas fa-map-marker"></i>
                        <h6>Address</h6>
                        <span>86 Stolham, PA 6542</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-container">
                        <i class="fas fa-clock"></i>
                        <h6>Opening Time</h6>
                        <span>Sat-Tue 5:00 to 8:00 PM</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <hr />
            <div class="copyrights">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <p>
                            Copyright @ 2021 Pharmacy. All rights reserved Created By
                            <a target="_blank" href="https://4soft-eg.com/">4Soft <sup>eg</sup></a>
                        </p>
                    </div>
                    <div class="col-md-6 text-right">
                        <ul class="social-media">
                            <li>
                                <a href="#"><i class="fab fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-dribbble"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-google-plus"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Js Libraries -->
    <script src="{{asset('assets/libs/jquery/jquery-3.6.0.min.js')}}"></script>
    <!-- <script src="assets/libs/bootstrap/bootstrap.bundle.min.js"></script> -->
    <script src="{{asset('assets/libs/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/bootstrap.min.js')}}"></script>
    <!-- Owl Carousel Js -->
    <script src="{{asset('assets/libs/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/libs/animate-wow/wow.min.js')}}"></script>
    <script src="{{asset('assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/libs/website/main.js')}}"></script>
</body>

</html>