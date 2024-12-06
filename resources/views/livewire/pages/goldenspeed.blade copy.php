@extends('layouts.app')

@section('title', 'جولدن سبيد لإدارة رواد الأعمال')

@push('styles')
    <style>
        body {
            font-family: "Cairo", sans-serif !important;
            overflow-x: hidden;
            background: #fff !important;
            margin: 0;
            padding: 0;
        }

        .whatsapp-float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            z-index: 100;
        }

        .whatsapp-float img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }

        .whatsapp-float:hover img {
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        }

        .services__item:before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, #001f3d 0, #000000 100%);
            opacity: 0;
            transition: .5s;
            z-index: 0;
            box-shadow: 0 0 25px rgba(0, 0, 0, .5);
        }

        .loader-first {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .animate__animated {
            animation-duration: 1s;
            animation-fill-mode: both;
        }

        .animate__fadeInUp {
            animation-name: fadeInUp;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 100%, 0);
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
    </style>
@endpush

@section('content')
    <div class="main-wrapper">
        <a href="https://wa.me/+201094569809" class="whatsapp-float" target="_blank">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp Icon">
        </a>

        <div class="loader-first">
            <div>
                <img src="{{ asset('assets/goldenspeed/loader.png') }}" alt="Loader" style="width: 80%;margin:auto;">
            </div>
        </div>

        <header class="s-header">
            <div class="container">
                <div class="header__wrapper">
                    <div class="brand-logo animate__animated animate__fadeIn" data-animation="fadeInUpShort"
                        data-duration="1000">
                        <a style="background-image: url({{ asset('assets/goldenspeed/logo.png') }});width: 150px;background-position: right;"
                            href="/">
                            <span class="sr-only">جولدن سبيد لإدارة رواد الأعمال</span>
                        </a>
                    </div>
                    <div class="toggle-menu">
                        <a href="javascript:">
                            <span></span><span></span><span></span><span></span>
                        </a>
                    </div>
                    <nav class="navigation">
                        <ul id="menu-menu-1-arabic" class="nav__menu animate__animated animate__fadeIn">
                            <li class='menu__item'>
                                <a href='/' class='menu__link anchor--hover active'>الصفحة الرئيسة</a>
                            </li>
                            <li class='menu__item'>
                                <a href='#about' class='menu__link anchor--hover'>حول جولدن سبيد</a>
                            </li>
                            <li class='menu__item'>
                                <a href='#services' class='menu__link anchor--hover'>خدماتنا المتميزة</a>
                            </li>
                            <li class='menu__item'>
                                <a href='#contactus' class='menu__link anchor--hover'>تواصل معنا</a>
                            </li>
                        </ul>

                        <ul class="social-wrap animate__animated animate__fadeIn" data-animation="fadeInUpShort"
                            data-duration="1600">
                            <li>
                                <a href="https://twitter.com/Gs.emirates" target="_blank">
                                    <img src="{{ asset('assets/goldenspeed/twitter-w.svg') }}" alt="Twitter" height="24"
                                        width="24">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/Gs.emirates" target="_blank">
                                    <img src="{{ asset('assets/goldenspeed/insta-w.svg') }}" alt="Instagram" height="24"
                                        width="24">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/company/Gs.emirates" target="_blank">
                                    <img src="{{ asset('assets/goldenspeed/linkedin-w-01.svg') }}" alt="LinkedIn"
                                        height="24" width="24">
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/Gs.emirates" target="_blank">
                                    <img src="{{ asset('assets/goldenspeed/facebook-w-01.svg') }}" alt="Facebook"
                                        height="24" width="24">
                                </a>
                            </li>
                        </ul>

                        <ul class="lang-switcher animate__animated animate__fadeIn" data-animation="fadeInUpShort"
                            data-duration="1900">
                            <li class="active">
                                <a href="/">العربية</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <main>
            <section class="section section--hero animate__animated animate__fadeIn">
                <div class="dotted"></div>
                <div class="hero__img"></div>
                <div class="hero__caption animate__animated animate__fadeInUp">
                    <div class="container">
                        <div class="inner-container" style="padding: 0">
                            <div class="hero__title">
                                <h1 class="animate__animated animate__fadeInUp" style="margin-bottom: 0px;"
                                    data-animation="fadeInUpShort" data-duration="2300">
                                    <span>

                                        مرحبا بكم في "جولدن سبيد لإدارة رواد الأعمال"
                                    </span>
                                    <br>
                                    <span>

                                        رواد الابتكار، النجاح في الإمارات
                                    </span>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section section--about" style="padding: 0;" id="about">
                <div class="block vision-mission--block" style="padding: 0">
                    <div class="container">
                        <div class="inner-container" style="padding: 80px 0;">
                            <div class="sec-header">
                                <h1 class="head-line text-center animate__animated animate__fadeInUp"
                                    data-animation="fadeInUpShort" data-duration="200">حول جولدن سبيد لإدارة رواد الأعمال
                                </h1>
                                <p>
                                    تأسست جولدن سبيد لتكون الشركة الرائدة في خدمة رواد الأعمال والمستثمرين في الإمارات. نحن
                                    نؤمن بأن النجاح في عالم الأعمال يتطلب رؤية واضحة وتنفيذاً متميزاً. لذلك، نسعى لتوفير
                                    كافة الخدمات الضرورية، بما في ذلك تخليص المعاملات الحكومية وغير الحكومية وتصميم المواقع
                                    الإلكترونية والمتاجر، لتمكين عملائنا من تحقيق طموحاتهم والوصول إلى أعلى مستويات النجاح
                                    بشكل قانوني
                                </p>
                            </div>
                            <div class="twocol-row">
                                <div class="row__col">
                                    <div class="text-wrap mission--wrap">
                                        <h3 class="heading-line animate__animated animate__fadeInUp"
                                            data-animation="fadeInUpShort" data-duration="600">
                                            مهمتنا</h3>
                                        <p class="animate__animated animate__fadeInUp" data-animation="fadeInUpShort"
                                            data-duration="800">
                                            نحن ملتزمون بتمكين رواد الأعمال والمستثمرين من الحصول على التراخيص اللازمة بسرعة
                                            وكفاءة، مع تقديم خدمات ذات جودة عالية.
                                        </p>
                                    </div>
                                </div>
                                <div class="row__col">
                                    <div class="text-wrap vision--wrap">
                                        <div class="sec-header">
                                            <h3 class="heading-line animate__animated animate__fadeInUp"
                                                data-animation="fadeInUpShort" data-duration="200">رؤيتنا</h3>
                                        </div>
                                        <p class="animate__animated animate__fadeInUp" data-animation="fadeInUpShort"
                                            data-duration="600">
                                            أن نكون الخيار الأول المثالي لرواد الأعمال والمستثمرين في الإمارات، عبر تقديم
                                            خدمات مبتكرة وعالية الجودة.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="sec-header">
                                <h1 class="head-line text-center animate__animated animate__fadeInUp"
                                    data-animation="fadeInUpShort" data-duration="200">لماذا تختار جولدن سبيد؟</h1>
                                <p>
                                    • فريق من الخبراء المتخصصين: نخبة من المتخصصين في مجالات الإدارة، التقنية، والتسويق.
                                    <br />
                                    • شبكة علاقات واسعة: تقديم خدمات بكفاءة عالية بفضل شبكة العلاقات القوية.
                                    <br />
                                    • التزامنا بالتميز: تقديم خدمات ذات جودة عالية تساعد في تحقيق أهداف العملاء.
                                    <br />
                                    • حلول مبتكرة ومخصصة: توفير حلول مخصصة لتلبية احتياجات العملاء.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section section--services" id="services">
                <div class="container">
                    <div class="service__wrapper">
                        <div class="inner-container">
                            <div class="sec-header">
                                <p class="head-line animate__animated animate__fadeInUp" style="color: white"
                                    data-animation="fadeInUpShort" data-duration="200">خدماتنا المتميزة:</p>
                            </div>

                            <ul class="services__list">
                                <li class="services__item">
                                    <div class="service__icon home__service animate__animated animate__fadeInUp"
                                        data-animation="fadeInUpShort" data-duration="300"></div>
                                    <h3 class="animate__animated animate__fadeInUp" data-animation="fadeInUpShort"
                                        data-duration="500">إدارة المعاملات الحكومية وشبه الحكومية</h3>
                                    <p class="animate__animated animate__fadeInUp" data-animation="fadeInUpShort"
                                        data-duration="700">
                                        • تخليص كافة الإجراءات والمعاملات الرسمية بسرعة ودقة.
                                        <br />
                                        • تقديم استشارات وإرشادات حول الإجراءات الحكومية.
                                        <br />
                                        • متابعة وإدارة الوثائق لتوفير الوقت والجهد.
                                    </p>
                                </li>

                                <li class="services__item">
                                    <div class="service__icon home__service animate__animated animate__fadeInUp"
                                        data-animation="fadeInUpShort" data-duration="300"></div>
                                    <h3 class="animate__animated animate__fadeInUp" data-animation="fadeInUpShort"
                                        data-duration="500">تأسيس الشركات والمؤسسات</h3>
                                    <p class="animate__animated animate__fadeInUp" data-animation="fadeInUpShort"
                                        data-duration="700">
                                        • تقديم استشارات شاملة حول تأسيس الشركات واختيار الهيكل القانوني المناسب.
                                        <br />
                                        • دعم العملاء في كل خطوة، بما في ذلك العقود وتسجيل العلامات التجارية.
                                        <br />
                                        • مساعدة الشركات في الحصول على التراخيص والاعتمادات.
                                    </p>
                                </li>

                                <li class="services__item">
                                    <div class="service__icon home__service animate__animated animate__fadeInUp"
                                        data-animation="fadeInUpShort" data-duration="300"></div>
                                    <h3 class="animate__animated animate__fadeInUp" data-animation="fadeInUpShort"
                                        data-duration="500">تصميم وتجهيز المتاجر والمواقع الإلكترونية</h3>
                                    <p class="animate__animated animate__fadeInUp" data-animation="fadeInUpShort"
                                        data-duration="700">
                                        • تطوير مواقع إلكترونية مبتكرة بواجهة مستخدم مريحة وتجربة تفاعلية.
                                        <br />
                                        • إنشاء متاجر إلكترونية متكاملة تلبي احتياجات التجارة الإلكترونية.
                                        <br />
                                        • تقديم حلول تسويق إلكتروني لتعزيز التواجد الرقمي وزيادة المبيعات.
                                    </p>
                                </li>

                                <li class="services__item">
                                    <div class="service__icon home__service animate__animated animate__fadeInUp"
                                        data-animation="fadeInUpShort" data-duration="300"></div>
                                    <h3 class="animate__animated animate__fadeInUp" data-animation="fadeInUpShort"
                                        data-duration="500">الاستشارات الاستراتيجية لرواد الأعمال</h3>
                                    <p class="animate__animated animate__fadeInUp" data-animation="fadeInUpShort"
                                        data-duration="700">
                                        • تقديم استشارات استراتيجية مخصصة لتحديد الأهداف والطريق للنجاح.
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <section class="section section--contact gray--back" id="contactus">
                <div class="container">
                    <div class="bg-white">
                        <div class="row__col">
                            <div class="contact-wrap">
                                <div class="social-wrap">
                                    <ul>
                                        <li>
                                            <a href="https://twitter.com/Gs.emirates" target="_blank">
                                                <img src="{{ asset('assets/goldenspeed/twitter-w.svg') }}" alt="Twitter"
                                                    height="24" width="24">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.instagram.com/Gs.emirates" target="_blank">
                                                <img src="{{ asset('assets/goldenspeed/insta-w.svg') }}" alt="Instagram"
                                                    height="24" width="24">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.linkedin.com/company/Gs.emirates" target="_blank">
                                                <img src="{{ asset('assets/goldenspeed/linkedin-w-01.svg') }}"
                                                    alt="LinkedIn" height="24" width="24">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.facebook.com/Gs.emirates" target="_blank">
                                                <img src="{{ asset('assets/goldenspeed/facebook-w-01.svg') }}"
                                                    alt="Facebook" height="24" width="24">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="s-footer">
            <div class="container">
                <div class="footer__wrap">
                    <p class="animate__animated animate__fadeInUp" data-animation="fadeInUpShort" data-duration="200">
                        2024 جميع الحقوق محفوظة جولدن سبيد لإدارة رواد الأعمال</p>
                    <p class="animate__animated animate__fadeInUp" data-animation="fadeInUpShort" data-duration="200">
                        <a href="https://nanots.ae">
                            <img src="{{ asset('goldenspeed/nts.ico') }}" alt="" style="width: 80px;">
                            Powered By NTS
                        </a>
                    </p>
                </div>
            </div>
        </footer>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Add animation classes to elements
            $('.section--hero').addClass('animate__animated animate__fadeIn');
            $('.hero__caption').addClass('animate__animated animate__fadeInUp');
            $('.fadeInUpShort').addClass('animate__animated');

            // Initialize counters if they exist
            if ($('.counter').length) {
                $('.counter').counterUp({
                    delay: 10,
                    time: 1000
                });
            }
        });
    </script>
@endpush
