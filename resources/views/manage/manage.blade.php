@extends('template.main')
@section('title', 'Manage')
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
                            <div class="card-body">
                                <label>24시 시/도 검색</label>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <button onclick="getAddr('result1')">Send</button>
                                    </div>
                                </div>
                                <div class="row" id="result1"></div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <label>24시 구/군 검색</label>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <input type="text" id="inputData1" placeholder="시/도">
                                    </div>
                                    <div class="col-lg-3">
                                        <button onclick="getAddr('result2', inputData1.value)">Send</button>
                                    </div>
                                </div>
                                <div class="row" id="result2"></div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <label>24시 읍/면/동 검색</label>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <input type="text" id="inputData2" placeholder="시/도">
                                    </div>
                                    <div class="col-lg-3">
                                        <input type="text" id="inputData3" placeholder="구/군">
                                    </div>
                                    <div class="col-lg-3">
                                        <button onclick="getAddr('result3', inputData2.value, inputData3.value)">Send</button>
                                    </div>
                                </div>
                                <div class="row" id="result3"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
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
<script>
    function getAddr(resultId, sido = null, gugun = null) {
        // var inputData = document.getElementById('inputData').value;
        var token = '{{ csrf_token() }}';

        // Ajax 요청 생성
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/api/manage/twentyFour.getAddr');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-Token', token);

        // Ajax 요청 완료 후 실행할 함수 설정
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                var element = document.getElementById(resultId);
                document.getElementById(resultId).innerText = response.message;
            } else {
                console.error('Request failed. Error:', xhr.statusText);
            }
        };

        // 데이터 전송
        var param = {};
        if (sido) {
            param.sido = sido;
        }
        if (gugun) {
            param.gugun = gugun;
        }
        xhr.send(JSON.stringify(param));
    }
</script>