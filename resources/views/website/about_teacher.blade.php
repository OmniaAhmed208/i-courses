@extends('layouts.app')
@section('title', setting('website_name') . ' About Us')
@section('content')

    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <div class="section-heading">
                            <h2 class="section__title">@lang('site.about_teacher')</h2>
                        </div>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{ route('home') }}">@lang('site.home')</a></li>
                            <li>@lang('site.about_teacher')</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->


    <section class="about-area about-area2 padding-top-120px padding-bottom-110px overflow-hidden {{ app()->getLocale() == 'ar' ? 'text-left' : '' }}">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-content-box padding-right-50px">
                    <div class="section-heading">
                        <h2 class="section__title">
                            @if(app()->getLocale() == 'ar')
                                أستاذ / محمد الجلاد
                            @elseif(app()->getLocale() == 'en')
                                Mr / Mohamed El Gallad
                            @endif
                        </h2>
                        <span class="section-divider"></span>
                        <p class="section__desc mb-3">
                            @if(app()->getLocale() == 'ar')
                                أستاذ / محمد عبدالحى ناصف الشهير بأستاذ / محمد الجلاد مدرس لغة إنجليزيه وقد عمل بالتدريس أكثر من 18 عاماً ومتخصص في تدريس الثانوية العامة وقد قام بالتدريس في العديد من المؤسسات التعليمية والمدارس الحكومية وساعد على تطوير اسلوب تدريس اللغة بهذة المؤسسات بالإضافة الى كونه محاضر دولىيستطيع القاء المحاضرات باللغتين العربية والإنجليزية للناطقين والغير ناطقين باللغه وهذة المحاضرات لا تقتصر فقط على تدريس اللغه الإنجليزيه ولكن تتعدى الى محاضرات مختلفة في بناء الذات وتنمية المهارات والبرمجة اللغوية العصبية
                            @elseif(app()->getLocale() == 'en')
                                Mr / Mohamed Abd elHay Nassif, known as Mr / Muhammad El-Gallad, is an English language teacher who has taught for more than 18 years and specialized in teaching high school. He has taught in many educational institutions and government schools and helped develop the style of language teaching in these institutions in addition to being an international lecturer. He can give lectures. In both Arabic and English for native and non-native speakers, these lectures are not only limited to teaching the English language, but go beyond various lectures on self-building, skill development and NLP
                            @endif
                        </p>
                        <p class="section__desc mb-3">
                            @if(app()->getLocale() == 'ar')
                                يعمل أستاذ / محمد الجلاد كمالك لمنصة I-Courses التعليمية وسيقوم بإلقاء محاضرة بمؤتمر TEDx قريباً
                            @elseif(app()->getLocale() == 'en')
                                Mr / Mohamed El-Gallad works as the owner of the I-Courses educational platform and will be giving a lecture at TEDx Conference soon.
                            @endif
                        </p>
                        <p class="section__desc">
                            @if(app()->getLocale() == 'ar')
                                يعمل أستاذ / محمد الجلاد بجد علي تغير العالم وجعله مكاناً افضل عن طريق تقديم افضل نسخة وافضل نموذج للجنس البشرى والله الموفق المستعان
                            @elseif(app()->getLocale() == 'en')
                                Mr / Mohamed El-Gallad works hard to change the world and make it a better place by presenting the best version and the best model for the human being.
                            @endif
                        </p>
                    </div><!-- end section-heading -->
                </div>
            </div><!-- end col-lg-6 -->
            <div class="col-lg-6">
                <div class="about-img-wrap about-img-wrap-3">
                    <div class="img-box img-box-5">
                        <img src="{{ asset('images/mr_mohamed_elgallad.jpeg') }}" alt="" style="max-width: 450px;">
                    </div>
                </div>
            </div><!-- end col-lg-6 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end about-area -->


@endsection
