@extends('layouts.app')
@section('content')
<div class="card shadow-sm border-0 p-4">

 <h4 class="fw-bold text-center mb-3">Danh Sách Khách Hàng</h4>
 
    <!-- //phần tìm kiếm -->
    <form method="GET" action="{{ route('dashboard') }}">
        <div class="row g-2 align-items-center" style="padding: 10px ">
            <!-- Ô tìm kiếm -->
            <div style="position: relative; display: inline-block;" class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Nhập họ và tên"
                    value="{{ request('name') }}" style="padding-right: 40px;">
                <button type="submit" class="btn" 
                    style="position: absolute; right: 7px; top: 50%; transform: translateY(-50%); padding: 5px 10px; margin-right: 20px;">
                    <i class="bi bi-search bg-light"> Tìm Kiếm</i>
                </button>
            </div>
            <div class="col-md-2 ">
                <a id="shareBtn" href="{{ route('dashboard') }}" class="btn btn2">Tất cả</a>
            </div>
        </div>
    </form>
                                     
    
    <!-- phần bảng -->
    <!-- @extends('customerTable') -->
    <!-- @extends('newCustomer') -->
    <!-- phan modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
        Cập nhật thông tin khách hàng
    </button> -->

    <!-- Modal -->
    <div>
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCustomerModalLabel">Cập nhật thông tin khách hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form nhập liệu -->
                        <form id="customerForm" method="POST" action="">
                            @csrf
                            @method('PUT')

                            <input type="hidden" id="customer_id" name="id">

                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Tên khách hàng</label>
                                <input type="text" name="name" class="form-control" id="customer_name" placeholder="Nhập tên">
                            </div>
                            <div class="mb-3">
                                <label for="customer_phone" class="form-label">Số điện thoại</label>
                                <input type="tel" name="phone" class="form-control" id="customer_phone" placeholder="Nhập số điện thoại">
                            </div>
                            <div class="mb-3">
                                <label for="customer_service_used" class="form-label">Dịch vụ đã sử dụng</label>
                                <input type="text" name="service_used" class="form-control" id="customer_service_used" placeholder="Nhập dịch vụ">
                            </div>
                            <div class="mb-3">
                                <label for="customer_price" class="form-label">Giá</label>
                                <input type="number" name="price" class="form-control" id="customer_price" placeholder="Nhập giá">
                            </div>

                            <div class="modal-footer d-flex justify-content-between">
                                <div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                    <button type="button" class="btn btn-danger" onclick="submitDeleteForm()">
                                        Xóa
                                    </button>
                                </div>

                                <!-- Form xóa riêng biệt -->                               
                            </div>
                        </form>
                        <form id="deleteForm" method="POST" action="{{ route('customers.destroy', 0) }}" style="display:inline-block;">
                            @csrf
                            @method('DELETE')    
                        </form>  
                    </div>
                </div>
            </div>
        </div>

 
    </div>
    
@endsection
<!-- alert -->
            @if ($errors->any())
                <div class="alert alert-danger " id="fail-alert" >
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success" id="success-alert" >
                    {{ session('success') }}
                </div>
            @endif