@extends('layouts.app')
@section('content')

    {{-- @dd($users[0]->student->courses) --}}
    <div class="container-fluid">
        @if ($errors->any() || isset($error))
            <div class="alert alert-danger">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
                @if (isset($error))
                    {{ $error }}
                @endif
            </div>
        @endif

        <div class="table-responsive p-2 bg-white rounded border">
            <table id="publishToRayatTbl" class="table nowrap display cell-border">

                <thead>

                    {{-- <tr>
                        <th colspan="9">
                        </th>
                        <th colspan="4">
                            <div id="allHoursContainer" class="d-inline">
                                <label for="allHoursValue">تعديل جميع الساعات:</label>
                                <input type="number" name="allHoursValue" id="allHoursValue" class="d-inline" placeholder=""
                                    aria-describedby="helpId">
                                <button onclick="window.changeHoursInputs()" class="btn btn-primary btn-sm">تعديل</button>
                            </div>
                        </th>

                    </tr> --}}


                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">رقم الهوية</th>
                        <th class="text-center">الرقم التدريبي</th>
                        <th class="text-center">اسم المتدرب </th>
                        <th class="text-center">رقم الجوال</th>
                        <th class="text-center">رقم الطلب</th>
                        <th class="text-center">البرنامج</th>
                        <th class="text-center">القسم</th>
                        <th class="text-center">التخصص</th>
                        <th class="text-center">الحالة</th>
                        <th class="text-center">المحفظة</th>
                        <th class="text-center"> عدد الساعات</th>
                        <th class="text-center">التسجيل في رايات</th>
                    </tr>
                    <tr>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                        <th class="filterhead"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <script>
            var publishToRayat = "{{$type == 'community' ? route('publishToRayatStoreCommunity') : route('publishToRayatStoreAffairs')}}"
            var getStudentForRayatApi = "{{$type == 'community' ? route('getStudentForRayatCommunityApi',['type' => $type]) : route('getStudentForRayatAffairsApi',['type' => $type])}}"
            
            window.addEventListener('DOMContentLoaded', (event) => {
                window.changeHoursInputs();
                Swal.fire({
                    html: "<h4>جاري جلب البيانات</h4>",
                    timerProgressBar: true,
                    showClass: {
                        popup: '',
                        icon: ''
                    },
                    hideClass: {
                        popup: '',
                    },
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });
            });
        </script>

    </div>
@stop
