@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            <div class="alert alert-info">
                لمعرفة طريقة الاستخدام اضغط
                <a target="_blank" href="{{asset('help.pdf')}}"> هنا</a>
                 كما يمكنك الوصول الى التعليمات عبر الضغط على زر تعليمات الاستخدام في اعلى الصفحة 
            </div>
            <div class="card">
                <div class="card-header h5">تعليمات التسجيل والقبول بالفترة المسائية</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                    @endif

                    <div dir="rtl" style="text-align: right; ">

                        <p>
                        (1) يتم اعتماد افتتاح الشعبة في حال اكتمال الحد الأدنى للمتدربين المسددين للرسوم فيها
                        (20 متدرب) والمحدد في دليل برنامج التدريب التطبيقي المسائي.
                        <hr></p>

                        <p>
                        (2) أقر بعلمي بأن التدريب في البرنامج التطبيقي المسائي بمقابل مالي يدفع من قبل المتقدم
                        وأن البرنامج باللغة الإنجليزية لمرحلة البكالوريوس.
                        <hr></p>

                        <p>
                        (3) في حال الغاء او تأجيل البرنامج او حذف مقررات البرنامج من قبل الكلية يستعيد المتقدم كامل المبلغ المدفوع.
                        <hr></p>

                        <p>
                        (4) يحق للمتدرب استعادة كامل المبلغ المدفوع من تكاليف ساعات الفصل التدريبي إذا انسحب من البرنامج قبل بداية
                        الأسبوع الأول وفق التقويم التدريبي.
                        <hr></p>

                        <p>
                        (5) يحق للمتدرب استعادة (60%) من المبلغ المدفوع من تكاليف التدريب للفصل التدريبي او الساعات التدريبية إذا
                        انسحب من البرنامج او أحد المقررات قبل نهاية الأسبوع الرابع وفق التقويم التدريبي.
                        <hr></p>


                        <p>
                        (6) لا يحق للمتدرب المطالبة باستعادة أي مبلغ من تكاليف التدريب للفصل التدريبي بعد الأسبوع الرابع وفق التقويم
                        التدريبي.
                        <hr></p>

                        <p>
                        (7) تكون تكاليف التدريب للساعة التدريبية الواحدة المعتمدة لمتدربي الدبلوم والتكميلي (400 ريال)، وللبكالوريوس
                        (550 ريال).
                        <hr></p>


                        <p>
                        (8) ترفق ايصالات السداد (الإيداع البنكي فقط) عبر الموقع، ولن يتم النظر لأي طلب لا يوجد معه إيداع بنكي واضح في
                        الحساب الموضح ادناه ومدون فيه اسم المتقدم.
                        <hr></p>


                        <p>
                        (9) في حال مخالفة المتقدم طريقة السداد أدناه سيتحمل المتقدم مسؤولية ما يترتب على ذلك.
                        <hr></p>


                        <p>
                        (10) لمرحلة الدبلوم عند عدم إمكانية افتتاح التخصص لاي سبب سوف تسعى الكلية توفير تخصص آخر مناسب لتخصص المتقدم
                        وعند عدم الموافقة من قبل المتقدم سوف يكون بإمكانه استرجاع المبلغ المدفوع باستخدام نموذج لخدمة المجتمع وسوف
                        يصرف هذا المبلغ خلال مدة لا تتجاوز الشهرين من تقديم الطلب.
                        <hr></p>


                        <p>
                        (11) لمرحلة الدبلوم لا يمكن لخريج الثانوية العلوم الشرعية أو المعاهد العلمية أو تحفيظ القرآن القبول في تخصصات
                        غير (الإدارة المكتبية - المحاسبة - التسويق) وماعدا ذلك يمكن القبول في جميع التخصصات.
                        <hr></p>
                    </div>

                    <form method="POST" action="{{ route('AgreementSubmit') }}">
                        @csrf
                        <button name="agree" value="1" type="submit" class="btn btn-primary">أوافق</button>
                        <button name="disagree" value="1" type="submit" class="btn btn-danger">لا أوافق</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection