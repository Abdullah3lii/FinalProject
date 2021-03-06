<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://www.tvtc.gov.sa/css/rayat.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"
        defer></script>
</head>

<body>
    <div id="app" style="display: flex; flex-direction: column; min-height: 100vh">
        <div class="position-absolute w-100 h-100 p-0 m-0" id="loadingSpin"
            style="background-color: #0002;z-index: 10; display: none;">
            <div class="spinner-border text-success position-absolute h3"
                style="width: 3rem; height: 3rem; top: 50%; left: 50%; z-index: 10;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Navigation -->
        <div class="navigation-wrap bg-light start-header border shadow sticky-top start-style">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-md navbar-light px-0">

                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">

                                    <!-- Authentication Links -->
                                    @guest
                                        @if (Route::has('login'))
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    href="{{ route('login') }}">{{ __('تسجيل الدخول') }}</a>
                                            </li>
                                        @endif

                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }}
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item text-right" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                                                                                                    document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" target="_blank" href="{{ asset('help.pdf') }}">تعليمات
                                                الاستخدام</a>
                                        </li>
                                    @endguest

                                </ul>
                                @auth

                                    {{-- --------- department boss ----------- --}}

                                    @if (Auth::user()->isDepartmentManager())
                                        <ul class="navbar-nav">
                                            <li id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>رئيس
                                                القسم</li>
                                            <li class="nav-item dropdown">
                                                <div class="dropdown-menu dropdown-menu-right text-right">
                                                    <a class="dropdown-item"
                                                        href="{{ route('deptBossDashboard') }}">{{ __('Go Home') }}</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('studentCourses') }}">المتدربين
                                                        المتعثرين</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('coursesPerLevel') }}">الجداول
                                                        المقترحة</a>
                                                    <a class="dropdown-item" href="{{ route('deptCoursesIndex') }}">ادارة
                                                        المقررات</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('deptCreateStudentForm') }}">اضافة متدرب</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('rayatReportFormCommunity', ['type' => 'departmentBoss']) }}">تقرير
                                                        رايات</a>
                                                </div>
                                            </li>
                                            {{-- <li class="nav-item">
                                                <a class="nav-link" href="{{ route('home') }}">{{ __('Go Home') }}</a>
                                            </li> --}}
                                        </ul>
                                    @endif

                                    {{-- --------- community ----------- --}}
                                    @if (Auth::user()->hasRole('خدمة المجتمع'))
                                        <ul class="navbar-nav">
                                            <li id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>خدمة
                                                المجتمع</li>
                                            <li class="nav-item dropdown">
                                                <div class="dropdown-menu dropdown-menu-right text-right">
                                                    <a class="dropdown-item"
                                                        href="{{ route('communityDashboard') }}">{{ __('Go Home') }}</a>

                                                    <a class="dropdown-item"
                                                        href="{{ route('publishToRayatFormCommunity', ['type' => 'community']) }}">الرفع
                                                        لرايات</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('rayatReportFormCommunity', ['type' => 'community']) }}">تقرير
                                                        رايات</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('paymentsReviewForm') }}">تدقيق الايصالات</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('paymentsReport', ['type' => 'community']) }}">تقرير
                                                        طلبات الشحن</a>
                                                    <a class="dropdown-item" href="{{ route('manageUsersForm') }}">ادارة
                                                        المستخدمين</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('communityManageStudentsForm') }}">ادارة
                                                        المتدربين</a>
                                                    <a class="dropdown-item" href="{{ route('coursesIndex') }}">ادارة
                                                        المقررات</a>
                                                    <a class="dropdown-item" href="{{ route('refundOrdersForm') }}">طلبات
                                                        الاسترداد</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('refundOrdersReport') }}">تقرير طلبات
                                                        الاسترداد</a>
                                                    <a class="dropdown-item" href="{{ route('oldStudentsReport') }}">جميع
                                                        المتدربين المستمرين</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('newStudentsReport', ['type' => 'community']) }}">جميع
                                                        المتدربين المستجدين</a>
                                                    <a class="dropdown-item" href="{{ route('reportAllForm') }}">جميع
                                                        العمليات المالية</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('reportFilterdForm') }}">العمليات المالية حسب
                                                        التخصص</a>
                                                    {{-- <a class="dropdown-item" href="{{ route('chargeForm') }}">ادارة محفظة المتدرب</a> --}}
                                                    <a class="dropdown-item" href="{{ route('newSemesterForm') }}">فصل
                                                        تدريبي جديد</a>
                                                </div>
                                            </li>
                                            {{-- <li class="nav-item">
                                                <a class="nav-link" href="{{ route('home') }}">{{ __('Go Home') }}</a>
                                            </li> --}}
                                        </ul>
                                    @endif


                                    {{-- --------- student affairs ----------- --}}
                                    @if (Auth::user()->hasRole('شؤون المتدربين'))
                                        <ul class="navbar-nav">
                                            <li id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                شؤون المتدربين</li>
                                            <li class="nav-item dropdown">
                                                <div class="dropdown-menu dropdown-menu-right text-right">

                                                    <a class="dropdown-item"
                                                        href="{{ route('affairsDashboard') }}">{{ __('Go Home') }}</a>
                                                    <a class="dropdown-item" href="{{ route('finalAcceptedForm') }}">
                                                        القبول
                                                        النهائي </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('finalAcceptedReport') }}">تقرير
                                                        القبول النهائي</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('NewStudents', ['type' => 'Affairs']) }}">المتدربين
                                                        المستجدين </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('rayatReportFormAffairs', ['type' => 'affairs']) }}">تقرير
                                                        رايات</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('publishToRayatFormAffairs', ['type' => 'affairs']) }}">الرفع
                                                        لرايات</a>
                                                    <a class="dropdown-item" href="{{ route('AddExcelForm') }}">اضافة
                                                        اكسل
                                                        مستجدين</a>
                                                    {{-- <a class="dropdown-item" href="{{ route('OldForm') }}">
                                                        اضافة اكسل مستمرين </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('UpdateStudentsWalletForm') }}">
                                                        اضافة الفائض / العجز للمستمرين </a> --}}
                                                    {{-- <a class="dropdown-item" href="{{ route('chargeForm') }}">شحن محفظة متدرب</a> --}}
                                                    <a class="dropdown-item" href="{{ route('addRayatIdForm') }}">اضافة
                                                        الرقم التدريبي للمستجدين</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('coursesPerLevel') }}">الجداول المقترحة</a>


                                                </div>
                                            </li>
                                            {{-- <li class="nav-item">
                                                <a class="nav-link" href="{{ route('home') }}">{{ __('Go Home') }}</a>
                                            </li> --}}

                                        </ul>
                                    @endif


                                    {{-- --------- private state ----------- --}}
                                    @if (Auth::user()->hasRole('الإرشاد'))
                                        <ul class="navbar-nav">
                                            <li id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                الارشاد</li>
                                            <li class="nav-item dropdown">
                                                <div class="dropdown-menu dropdown-menu-right text-right">

                                                    <a class="dropdown-item"
                                                        href="{{ route('privateDashboard') }}">{{ __('Go Home') }}</a>

                                                    <a class="dropdown-item"
                                                        href="{{ route('PrivateAllStudentsForm') }}">تدقيق المستندات</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('PrivateStudentsReport') }}">تقرير الطلبات
                                                        المدققة</a>
                                                </div>
                                            </li>
                                            {{-- <li class="nav-item">
                                                <a class="nav-link" href="{{ route('home') }}">{{ __('Go Home') }}</a>
                                            </li> --}}
                                        </ul>
                                    @endif

                                    {{-- ---------  student ----------- --}}
                                    @if (Auth::user()->hasRole('متدرب'))
                                        <ul class="navbar-nav">
                                            {{-- <li class="nav-item">
                                            <a class="nav-link" target="_blank" href="{{asset('help.pdf')}}">تعليمات الاستخدام</a>
                                        </li> --}}
                                            {{-- <li class="nav-item">
                                                <a class="nav-link" href="{{ route('home') }}">{{ __('Go Home') }}</a>
                                            </li> --}}
                                        </ul>
                                    @endif

                                    @if (Auth::user()->hasRole('مدقق ايصالات'))
                                        <ul class="navbar-nav">
                                            <li id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                مدقق ايصالات</li>
                                            <li class="nav-item dropdown">
                                                <div class="dropdown-menu dropdown-menu-right text-right">
                                                    <a class="nav-link"
                                                        href="{{ route('paymentCheckerDashboard') }}">الرئيسية</a>
                                                    <a class="nav-link"
                                                        href="{{ route('checkerPaymentsReviewForm') }}">تدقيق
                                                        الايصالات</a>
                                                </div>
                                            </li>
                                            {{-- <li class="nav-item">
                                                <a class="nav-link" href="{{ route('home') }}">{{ __('Go Home') }}</a>
                                            </li> --}}
                                        </ul>
                                    @endif

                                    @if (Auth::user()->hasRole('الإدارة العامة'))
                                        <ul class="navbar-nav">
                                            <li id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                الإدارة العامة</li>
                                            <li class="nav-item dropdown">
                                                <div class="dropdown-menu dropdown-menu-right text-right">
                                                    <a class="nav-link"
                                                        href="{{ route('managementDashboard') }}">الرئيسية</a>
                                                    <a class="nav-link"
                                                        href="{{ route('generalPaymentsReviewForm') }}">تدقيق
                                                        الايصالات</a>
                                                </div>
                                            </li>
                                            {{-- <li class="nav-item">
                                                <a class="nav-link" href="{{ route('home') }}">{{ __('Go Home') }}</a>
                                            </li> --}}
                                        </ul>
                                    @endif

                                    <!-- dean -->
                                    @if (Auth::user()->hasRole('المشرف العام'))
                                        <ul class="navbar-nav">
                                            <li id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>المشرف العام</li>
                                            <li class="nav-item dropdown">
                                                <div class="dropdown-menu dropdown-menu-right text-right">
                                                    <a class="dropdown-item"
                                                        href="{{ route('deanDashboard') }}">{{ __('Go Home') }}</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('deanCoursesOrdersReportView') }}">تقرير عقود التدريب</a>
                                                </div>
                                            </li>
                                        </ul>
                                    @endif

                                    <!-- trainer -->
                                    @if (Auth::user()->trainer != null)
                                        <ul class="navbar-nav">
                                            <li id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> مدرب </li>
                                            <li class="nav-item dropdown">
                                                <div class="dropdown-menu dropdown-menu-right text-right text-right">
                                                    <a class="dropdown-item"
                                                        href="{{ route('trainerDashboard') }}">{{ __('Go Home') }}</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('trainerInfo') }}">المعلومات الشخصية</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('addCoursesToTrainerView') }}">إنشاء عقد تدريبي</a>
                                                </div>
                                            </li>
                                        </ul>
                                    @endif

                                    <li class="navbar-nav">
                                        <a class="nav-link" href="{{ route('home') }}">الرئيسية</a>
                                    </li>
                                @endauth
                            </div>
                            <a class="navbar-brand py-0 pl-3" href="{{ route('home') }}">
                                <img style="width: 250px;" class="" src="{{ asset('images/tvtclogo2.png') }}" />
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <main class="py-4 my-4 p-2" style="text-align: right !important; flex-grow: 1" dir="rtl">
            @yield('content')
        </main>
        
        <footer class="card bg-light" dir="rtl">
            <div class="card-body container">
                <div class="row text-right justify-content-center ">

                    <div class="col-md-3 align-self-center">
                        <img width="200px" class="mb-5" src="{{ asset('images/tvtclogo2.png') }}" alt="شعار الكلية">
                    </div>

                    <div class="col-xs-4 m-0 pl-3">
                        <h4>التواصل</h4>
                        <hr>
                        <ul class="list-unstyled pr-0">
                            <li>
                                <a class="btn text-black-50" href="mailto: tvtc.brct.ctc@gmail.com">
                                    <i class="fa fa-envelope-o text-black-50 pl-2" aria-hidden="true"></i> tvtc.brct.ctc@gmail.com 
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-xs-4">
                        <h4>المطورون</h4>
                        <hr>
                        <ul class="list-unstyled text-black-50 pr-3">
                            <li>م. عبدالله النغيمشي</li>
                            <li>م. مهند الرسيني</li>
                            <li>م. ريان العرفج</li>
                            <li class="mt-2">اشراف م. باسم الحسيني</li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="card-footer text-secondary text-center">
                <p class="m-0"><span class="text-black-50">© جميع الحقوق محفوظة</span> - مركز خدمة المجتمع والتدريب المستمر بالكلية التقنية ببريدة 2021 <span class="text-black-50 pr-3">نسخة تجريبية</span></p>
            </div>
        </footer>

        {{-- <footer class="page-footer" dir="rtl">
                <i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto: rayan7899@hotmail.com">اتصل بنا</a>

            <div class="card bg-dark text-white">
                <img src="/images/background.jpg" style="height: 150px;" class="card-img" alt="...">
                <div class="card-img-overlay">
                    <p class="text-center">
                        للتواصل:
                        tvtc.brct.ctc@gmail.com
                        <br>
                        <br>
                        تصميم وتطوير مركز خدمة المجتمع والتدريب المستمر بالكلية التقنية ببريدة
                        <br>
                        ©️ جميع الحقوق محفوظة -الكلية التقنية ببريدة 2021
                        <br>
                        نسخة تجريبية
                    </p>
                </div>
            </div>
        </footer> --}}
    </div>
</body>


</html>
