@extends('template.main')
@section('title', 'Order')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">@yield('title')</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="text-right">
                                    <a href="/order/create" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add
                                        Order</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-striped table-bordered table-hover text-center"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>상차지 시/도</th>
                                            <th>상차지 구/군</th>
                                            <th>상차지 읍/면/동</th>
                                            <th>상차지 상세</th>
                                            <th>하차지 시/도</th>
                                            <th>하차지 구/군</th>
                                            <th>하차지 읍/면/동</th>
                                            <th>하차지 상세</th>
                                            <th>혼적여부</th>
                                            <th>긴급여부</th>
                                            <th>왕복여부</th>
                                            <th>차량톤수</th>
                                            <th>차량종류</th>
                                            <th>적재중량</th>
                                            <th>상차일</th>
                                            <th>하차일</th>
                                            <th>상차방법</th>
                                            <th>하차방법</th>
                                            <th>화물상세내용</th>
                                            <th>운송료 지불구분</th>
                                            <th>운송료</th>
                                            <th>수수료</th>
                                            <th>하차지 전화번호</th>
                                            <th>의뢰자구분</th>
                                            <th>원화주명</th>
                                            <th>원화주 전화번호</th>
                                            <th>원화주 사업자번호</th>
                                            <th>전자세금계산서 발행여부</th>
                                            <th>운송료지급예정일</th>
                                            <th>등록일시</th>
                                            <th>24시 담당자 아이디</th>
                                            <th>24시 오더번호</th>
                                            <th>24시 연동오류 메세지</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $data)
                                            <tr>
                                                <td>{{ $data->id }}</td>
                                                <td>{{ $data->start_address_siNm }}</td>
                                                <td>{{ $data->start_address_sggNm }}</td>
                                                <td>{{ $data->start_address_emdNm }}</td>
                                                <td>{{ $data->start_address_detail }}</td>
                                                <td>{{ $data->end_address_siNm }}</td>
                                                <td>{{ $data->end_address_sggNm }}</td>
                                                <td>{{ $data->end_address_emdNm }}</td>
                                                <td>{{ $data->end_address_detail }}</td>
                                                <td>{{ $data->is_mix ? 'true' : 'false' }}</td>
                                                <td>{{ $data->is_urgent ? 'true' : 'false' }}</td>
                                                <td>{{ $data->is_round ? 'true' : 'false' }}</td>
                                                <td>{{ $data->car_ton }}</td>
                                                <td>{{ $data->car_type }}</td>
                                                <td>{{ $data->freight_ton }}</td>
                                                <td>{{ $data->start_date }}</td>
                                                <td>{{ $data->end_date }}</td>
                                                <td>{{ $data->start_work }}</td>
                                                <td>{{ $data->end_work }}</td>
                                                <td>{{ $data->freight_desc }}</td>
                                                <td>{{ $data->fare_pay_type }}</td>
                                                <td>{{ $data->fare }}</td>
                                                <td>{{ $data->fee }}</td>
                                                <td>{{ $data->end_phone_number }}</td>
                                                <td>{{ $data->user_type }}</td>
                                                <td>{{ $data->shipper_name }}</td>
                                                <td>{{ $data->shipper_phone_number }}</td>
                                                <td>{{ $data->shipper_biz_number }}</td>
                                                <td>{{ $data->is_tax_invoice ? 'true' : 'false' }}</td>
                                                <td>{{ $data->pay_due_date }}</td>
                                                <td>{{ $data->created_at }}</td>
                                                <td>{{ $data->twentyfour_id }}</td>
                                                <td>{{ $data->twentyfour_order_no }}</td>
                                                <td>{{ $data->twentyfour_error_msg }}</td>
                                                <td>
                                                    <form class="d-inline" action="/order/{{ $data->id }}/edit"
                                                        method="GET">
                                                        <button type="submit" class="btn btn-success btn-sm mr-1">
                                                            <i class="fa-solid fa-pen"></i> Edit
                                                        </button>
                                                    </form>
                                                    <!-- <form class="d-inline" action="/order/{{ $data->id }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            id="btn-delete"><i class="fa-solid fa-trash-can"></i> Delete
                                                        </button>
                                                    </form> -->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
        </div>
    </div>

@endsection
