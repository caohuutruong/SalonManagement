@section('customerTable')
 <!-- phần bảng -->
<div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th><button
                        type="button with: 10px"
                        class="btn btn-success"
                        data-bs-toggle="modal"
                        data-bs-target="#modalId2"
                        
                        >
                        New
                        </button>
                    </th>
                    <th>Họ và tên</th>
                    <th>Số Điện Thoại</th>
                    <th>Giới Tính</th>
                    <th>Dịch Vụ Đã Sử Dụng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                @if($customers->count() > 0)
                    @foreach ($customers as $customer)
                        <tr data-id="{{ $customer->id }}">
                            <td>
                                <button id="editbtn"
                                    style="width: 57.9062px"
                                    data-id="{{ $customer -> id }}"
                                    data-name="{{ $customer -> name }}"
                                    data-phone="{{ $customer -> phone }}"
                                    data-service_used="{{ $customer -> service_used }}"
                                    data-price="{{ $customer -> price }}"
                                    type="button" class="btn edit-btn" data-bs-toggle="modal" data-bs-target="#editCustomerModal" >
                                    Sửa
                                </button>
                            </td>
                            <td class="editable" data-field="name">
                                <span class="view-mode">{{ $customer->name }}</span>
                                <input class="edit-mode form-control" style="display:none;" value="{{ $customer->name }}">
                                <button class="edit-btn-2" style="display:none;">🖉</button>
                            </td>

                            <td class="editable" data-field="phone">
                                <span class="view-mode">{{ $customer->phone }}</span>
                                <input class="edit-mode form-control" style="display:none;" value="{{ $customer->phone }}">
                                <button class="edit-btn-2" style="display:none;">🖉</button>
                            </td>

                            <td>{{ $customer->gender }}</td>

                            <td class="editable" data-field="service_used">
                                <span class="view-mode">{{ $customer->service_used }}</span>
                                <input class="edit-mode form-control" style="display:none;" value="{{ $customer->service_used }}">
                                <button class="edit-btn-2" style="display:none;">🖉</button>
                            </td>

                            <td class="editable" data-field="price">
                                <span class="view-mode">{{ number_format($customer->price, 0, ',', '.') }} VNĐ</span>
                                <input class="edit-mode form-control" style="display:none;" value="{{ $customer->price }}">
                                <button class="edit-btn-2" style="display:none;">🖉</button>
                            </td>
                        </tr>
                    @endforeach
                @else  
                    <tr>
                        <td colspan="5" class="text-center">Không có khách hàng nào được tìm thấy.</td>
                    </tr>
                @endif
            </tbody>
            
        </table>
        
    </div>
    <button id="save-all" type="button" class="btn " style="width: 100%;">Cập nhật thông tin khách hàng</button>
        <!-- phân trang pagination -->
        <nav aria-label="Page navigation example">
            <p class="text-center" style="margin-top: 10px;">Hiển thị từ {{ $customers->firstItem() }} đến {{ $customers->lastItem() }} trong tổng số {{ $customers->total() }} khách hàng</p>
            <ul class="pagination justify-content-center">
                <!-- Nút Trang đầu -->
                @if ($customers->onFirstPage())
                    <li class="page-item disabled"><span class="page-link">«</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $customers->url(1) }}">«</a></li>
                @endif
                <!-- Hiển thị số trang -->
                {{ $customers->links('pagination::bootstrap-4') }}
                <!-- Nút Next -->
                <!-- Nút Trang cuối -->
                @if ($customers->currentPage() == $customers->lastPage())
                    <li class="page-item disabled"><span class="page-link">»</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $customers->url($customers->lastPage()) }}">»</a></li>
                @endif
            </ul>
        </nav>
@endsection