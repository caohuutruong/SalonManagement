@extends('layouts.app') {{-- Nếu bạn dùng layout app, có thể đổi thành layout bạn đang sử dụng --}}

@section('content')
<div class="container">
    <br>
    <h2 style="text-align: center; padding: 15px 0px 15px 0px; " >Thống Kê Doanh Thu</h2>
    <br>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Doanh thu hôm nay</div>
                <div class="card-body">
                    <h5 class="card-title">{{ number_format($doanhThuHomNay, 0, ',', '.') }} VNĐ</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Doanh thu tháng này</div>
                <div class="card-body">
                    <h5 class="card-title">{{ number_format($doanhThuThangNay, 0, ',', '.') }} VNĐ</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Doanh thu năm nay</div>
                <div class="card-body">
                    <h5 class="card-title">{{ number_format($doanhThuNamNay, 0, ',', '.') }} VNĐ</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection