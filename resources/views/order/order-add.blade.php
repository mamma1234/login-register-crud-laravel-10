@extends('template.main')
@section('title', 'Add Order')
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
            <li class="breadcrumb-item"><a href="/order">Order</a></li>
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
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="text-right">
                <a href="/order" class="btn btn-warning btn-sm"><i class="fa-solid fa-arrow-rotate-left"></i>
                  Back
                </a>
              </div>
            </div>
            <form class="needs-validation" novalidate action="/order" method="POST">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="start_date">상차일("YYYYMMDD")</label>
                      <input type="text" name="start_date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" placeholder="상차일" value="{{old('start_date')}}" required>
                      @error('start_date')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="end_date">하차일("YYYYMMDD")</label>
                      <input type="text" name="end_date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" placeholder="하차일" value="{{old('end_date')}}" required>
                      @error('end_date')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="end_phone_number">하차지 전화번호(숫자만)</label>
                      <input type="number" name="end_phone_number" class="form-control @error('end_phone_number') is-invalid @enderror" id="end_phone_number" placeholder="하차지 전화번호" value="{{old('end_phone_number')}}" required>
                      @error('end_phone_number')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="fare_pay_type">운송료 지불구분</label>
                      <input type="text" name="fare_pay_type" class="form-control" id="fare_pay_type" placeholder="운송료 지불구분" value="{{old('fare_pay_type')}}">
                      <span>("선착불","인수증","카드" 중 선택)</span>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="fare">운송료(숫자만)</label>
                      <input type="number" name="fare" class="form-control @error('fare') is-invalid @enderror" id="fare" placeholder="운송료" value="{{old('fare')}}" required>
                      @error('fare')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="fee">수수료(숫자만)</label>
                      <input type="number" name="fee" class="form-control" id="fee" placeholder="수수료" value="{{old('fee')}}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="start_address_siNm">상차지 시/도</label>
                      <input type="text" name="start_address_siNm" class="form-control @error('start_address_siNm') is-invalid @enderror" id="start_address_siNm" placeholder="상차지 시/도" value="{{old('start_address_siNm')}}" required>
                      @error('start_address_siNm')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="start_address_sggNm">상차지 구/군</label>
                      <input type="text" name="start_address_sggNm" class="form-control @error('start_address_sggNm') is-invalid @enderror" id="start_address_sggNm" placeholder="상차지 구/군" value="{{old('start_address_sggNm')}}" required>
                      @error('start_address_sggNm')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="start_address_emdNm">상차지 읍/면/동</label>
                      <input type="text" name="start_address_emdNm" class="form-control @error('start_address_emdNm') is-invalid @enderror" id="start_address_emdNm" placeholder="상차지 읍/면/동" value="{{old('start_address_emdNm')}}" required>
                      @error('start_address_emdNm')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="start_address_detail">상차지 상세</label>
                      <input type="text" name="start_address_detail" class="form-control @error('start_address_detail') is-invalid @enderror" id="start_address_detail" placeholder="상차지 상세" value="{{old('start_address_detail')}}" required>
                      @error('start_address_detail')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="end_address_siNm">하차지 시/도</label>
                      <input type="text" name="end_address_siNm" class="form-control @error('end_address_siNm') is-invalid @enderror" id="end_address_siNm" placeholder="하차지 시/도" value="{{old('end_address_siNm')}}" required>
                      @error('end_address_siNm')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="end_address_sggNm">하차지 구/군</label>
                      <input type="text" name="end_address_sggNm" class="form-control @error('end_address_sggNm') is-invalid @enderror" id="end_address_sggNm" placeholder="하차지 구/군" value="{{old('end_address_sggNm')}}" required>
                      @error('end_address_sggNm')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="end_address_emdNm">하차지 읍/면/동</label>
                      <input type="text" name="end_address_emdNm" class="form-control @error('end_address_emdNm') is-invalid @enderror" id="end_address_emdNm" placeholder="하차지 읍/면/동" value="{{old('end_address_emdNm')}}" required>
                      @error('end_address_emdNm')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="start_address_detail">하차지 상세</label>
                      <input type="text" name="end_address_detail" class="form-control @error('end_address_detail') is-invalid @enderror" id="end_address_detail" placeholder="하차지 상세" value="{{old('end_address_detail')}}" required>
                      @error('end_address_detail')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-1">
                    <div class="form-group">
                      <label for="is_mix">혼적</label>
                      <input type="checkbox" name="is_mix" class="form-control" id="is_mix" placeholder="혼적" {{ old('is_mix') ? 'checked' : '' }} >
                    </div>
                  </div>
                  <div class="col-lg-1">
                    <div class="form-group">
                      <label for="is_urgent">긴급</label>
                      <input type="checkbox" name="is_urgent" class="form-control" id="is_urgent" placeholder="긴급" {{ old('is_urgent') ? 'checked' : '' }} >
                    </div>
                  </div>
                  <div class="col-lg-1">
                    <div class="form-group">
                      <label for="is_round">왕복</label>
                      <input type="checkbox" name="is_round" class="form-control" id="is_round" placeholder="왕복" {{ old('is_round') ? 'checked' : '' }} >
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="car_ton">차량톤수</label>
                      <input type="text" name="car_ton" class="form-control @error('car_ton') is-invalid @enderror" id="car_ton" placeholder="차량톤수" value="{{old('car_ton')}}" required>
                      @error('car_ton')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                      <span>(0.3, 0.5, 1, 1.4, 2.5, 3.5, 4, 5, 8, 9.5, 11, 14, 15, 18, 25)</span>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="car_type">차량종류</label>
                      <input type="text" name="car_type" class="form-control @error('car_type') is-invalid @enderror" id="car_type" placeholder="차량종류" value="{{old('car_type')}}" required>
                      @error('car_type')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                      <span>(카고, 윙바디, 탑, 초장축, 호루, 냉동탑, 리프트, 리프트윙, 카/윙, 냉장윙, 리프트호, 리프트탑, 초장축호, 초장축탑, 초장축윙, 냉장탑, 초장축호리, 초장축탑리, 초장축윙리, 초장축냉동탑, 초냉장윙리, 냉장탑리, 초냉장탑리, 초장축리, 냉동윙, 냉동윙리, 냉장윙리, 초장축냉동윙, 초냉동윙리, 초장축냉장윙, 초냉동탑리, 초장축냉장탑)</span>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="freight_ton">적재중량(차량톤수의 110%까지)</label>
                      <input type="text" name="freight_ton" class="form-control @error('freight_ton') is-invalid @enderror" id="freight_ton" placeholder="적재중량" value="{{old('freight_ton')}}" required>
                      @error('freight_ton')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="start_work">상차방법</label>
                      <input type="text" name="start_work" class="form-control @error('start_work') is-invalid @enderror" id="start_work" placeholder="상차방법" value="{{old('start_work')}}" required>
                      @error('start_work')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                      <span>("지게차","수작업","크레인","호이스트","컨베이어","기타" 중 선택)</span>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="end_work">하차방법</label>
                      <input type="text" name="end_work" class="form-control @error('end_work') is-invalid @enderror" id="end_work" placeholder="하차방법" value="{{old('end_work')}}" required>
                      @error('end_work')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                      <span>("지게차","수작업","크레인","호이스트","컨베이어","기타" 중 선택)</span>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="freight_desc">화물상세내용</label>
                      <textarea name="freight_desc" id="freight_desc" class="form-control @error('freight_desc') is-invalid @enderror" cols="10" rows="5" placeholder="화물상세내용" required>{{old('freight_desc')}}</textarea>
                      @error('freight_desc')
                      <span class="invalid-feedback text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="shipper_name">원화주명</label>
                      <input type="text" name="shipper_name" class="form-control" id="shipper_name" placeholder="원화주명" value="{{old('shipper_name')}}">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="shipper_phone_number">원화주 전화번호</label>
                      <input type="number" name="shipper_phone_number" class="form-control" id="shipper_phone_number" placeholder="원화주 전화번호" value="{{old('shipper_phone_number')}}">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="shipper_biz_number">원화주 사업자번호</label>
                      <input type="number" name="shipper_biz_number" class="form-control" id="shipper_biz_number" placeholder="원화주 사업자번호" value="{{old('shipper_biz_number')}}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="is_tax_invoice">전자세금계산서 발행여부</label>
                      <input type="checkbox" name="is_tax_invoice" class="form-control" id="is_tax_invoice" placeholder="전자세금계산서 발행여부" {{ old('is_tax_invoice') ? 'checked' : '' }} >
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="pay_due_date">운송료지급예정일("YYYYMMDD")</label>
                      <input type="text" name="pay_due_date" class="form-control" id="pay_due_date" placeholder="운송료지급예정일" value="{{old('pay_due_date')}}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-dark mr-1" type="reset"><i class="fa-solid fa-arrows-rotate"></i>
                  Reset</button>
                <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk"></i>
                  Save</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.content -->
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var isMixCheckbox = document.getElementById('is_mix');
    isMixCheckbox.addEventListener('change', function() {
        if (isMixCheckbox.checked) {
            isMixCheckbox.value = '1';
        } else {
            isMixCheckbox.value = '0';
        }
    });

    var isUrgentCheckbox = document.getElementById('is_urgent');
    isUrgentCheckbox.addEventListener('change', function() {
        if (isUrgentCheckbox.checked) {
            isUrgentCheckbox.value = '1';
        } else {
            isUrgentCheckbox.value = '0';
        }
    });

    var isRoundCheckbox = document.getElementById('is_round');
    isRoundCheckbox.addEventListener('change', function() {
        if (isRoundCheckbox.checked) {
            isRoundCheckbox.value = '1';
        } else {
            isRoundCheckbox.value = '0';
        }
    });

    var isTaxInvoiceCheckbox = document.getElementById('is_tax_invoice');
    isTaxInvoiceCheckbox.addEventListener('change', function() {
        if (isTaxInvoiceCheckbox.checked) {
            isTaxInvoiceCheckbox.value = '1';
        } else {
            isTaxInvoiceCheckbox.value = '0';
        }
    });
});
</script>

@endsection