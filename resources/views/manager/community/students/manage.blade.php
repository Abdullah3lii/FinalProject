@extends('layouts.app')
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('error') || isset($error))
            <div class="alert alert-danger">
                {{ session()->get('error') ?? $error }}
            </div>
        @endif
        @if (session()->has('success') || isset($success))
            <div class="alert alert-success">
                {{ session()->get('success') ?? $success }}
            </div>
        @endif
        <div class="card">
            <div class="card-header h5">{{ __('ادارة المتدربين') }}</div>
            <div class="card-body p-0 px-5">
                <div class="p-2">
                    @if (Auth::user()->id == 1)    
                        <a href="{{ route('createStudentForm') }}" class="btn btn-outline-primary p-3 m-2"
                            style="font-size: 16px; width: 220px;">اضافة متدرب</a>
                    @endif
                    <a href="{{ route('editStudentForm') }}" class="btn btn-outline-primary p-3 m-2"
                        style="font-size: 16px; width: 220px;">تعديل بيانات متدرب</a>
                    <a href="{{ route('chargeForm') }}" class="btn btn-outline-primary p-3 m-2"
                        style="font-size: 16px; width: 220px;">ادارة محفظة المتدرب</a>
                    <a href="{{ route('getStudentForm') }}" class="btn btn-outline-primary p-3 m-2"
                        style="font-size: 16px; width: 220px;">جميع طلبات و بيانات المتدرب</a>
                    <a href="#" onclick="return getOrder()" class="btn btn-outline-primary p-3 m-2"
                        style="font-size: 16px; width: 220px;">بحث برقم الطلب</a>
                    <a href="{{ route('exportMainStudentDataExcel') }}" class="btn btn-outline-primary p-3 m-2"
                        style="font-size: 16px; width: 220px;">بيانات جميع المتدربين اكسل</a>
                </div>
            </div>

        </div>
    </div>
    <script>
        function getOrder() {

            Swal.fire({
                title: 'رقم الطلب',
                html: `
                        <form id="orderSearchForm" method="GET">
                        <input type="text" id="orderId" class="swal2-input">
                        </form>
                        `,
                confirmButtonText: 'بحث',
                focusConfirm: false,
                preConfirm: () => {
                    const orderId = Swal.getPopup().querySelector('#orderId').value
                    if (!orderId) {
                        Swal.showValidationMessage(`ادخل رقم الطلب`)
                    }
                    return orderId;
                }
            }).then((result) => {
                console.log(result.value);
                document.getElementById("orderSearchForm").action = "/community/students/show-order/" + result.value;
                document.getElementById("orderSearchForm").submit();
            })
        }

    </script>
@stop
