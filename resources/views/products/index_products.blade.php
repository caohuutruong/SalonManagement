@extends('layouts.app')
@section('content')
<p class="display-6 text-center" >Products Management</p>
<!-- modal thêm sản phẩm -->
<button style="margin: 0px 0px 5px 2px" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#productModal">
    Thêm sản phẩm mới
</button>
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="productModalLabel">Thêm sản phẩm mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('product.store') }}" method="POST">
                    @csrf
                    <div class="card p-3">
                        <div class="mb-3">
                            <label for="product_name" class="form-label">Tên Sản Phẩm</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Nhập tên sản phẩm">
                        </div>

                        <div class="mb-3">
                            <label for="product_category" class="form-label">Loại Sản Phẩm</label>
                            <select class="form-select" id="product_category" name="product_category">
                                <option selected disabled>Chọn loại sản phẩm</option>
                                <option value="Dụng cụ làm tóc">Dụng cụ làm tóc</option>
                                <option value="Mỹ phẩm chăm sóc tóc">Mỹ phẩm chăm sóc tóc</option>
                                <option value="Phụ kiện làm tóc">Phụ kiện làm tóc</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="product_quantity" class="form-label">Số Lượng</label>
                            <input type="number" class="form-control" id="product_quantity" name="product_quantity" min="1" placeholder="Nhập số lượng">
                        </div>

                        <div class="mb-3">
                            <label for="product_price" class="form-label">Giá</label>
                            <input type="number" class="form-control" id="product_price" name="product_price" min="0" step="0.01" placeholder="Nhập giá sản phẩm">
                        </div>

                        <div class="mb-3">
                            <label for="product_description" class="form-label">Miêu Tả</label>
                            <textarea class="form-control" id="product_description" name="product_description" rows="3" placeholder="Nhập mô tả sản phẩm"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Lưu sản phẩm</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- bảng -->
<div class="card ">
    <div class="table-responsive">
        <table class="table  table-striped ">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Loại sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Chú Thích</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ number_format($product->price) }}₫</td>
                        <td>{{ $product->description }}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}">
                                <i class="fas fa-edit"></i> Sửa
                            </button>
                        </td>
                        <td>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Xóa 
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- modal nút sửa -->
@foreach ($products as $product)
    <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editModalLabel{{ $product->id }}">Chỉnh sửa sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card p-3">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Tên Sản Phẩm</label>
                                <input type="text" class="form-control" name="product_name" value="{{ $product->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="product_category" class="form-label">Loại Sản Phẩm</label>
                                <select class="form-select" name="product_category">
                                    <option value="Dụng cụ làm tóc" {{ $product->category == 'hair_tools' ? 'selected' : '' }}>Dụng cụ làm tóc</option>
                                    <option value="Mỹ phẩm chăm sóc tóc" {{ $product->category == 'hair_care' ? 'selected' : '' }}>Mỹ phẩm chăm sóc tóc</option>
                                    <option value="Phụ kiện làm tóc" {{ $product->category == 'accessories' ? 'selected' : '' }}>Phụ kiện làm tóc</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="product_quantity" class="form-label">Số Lượng</label>
                                <input type="number" class="form-control" name="product_quantity" value="{{ $product->quantity }}" min="1">
                            </div>

                            <div class="mb-3">
                                <label for="product_price" class="form-label">Giá</label>
                                <input type="number" class="form-control" name="product_price" value="{{ $product->price }}" min="0" step="0.01">
                            </div>

                            <div class="mb-3">
                                <label for="product_description" class="form-label">Miêu Tả</label>
                                <textarea class="form-control" name="product_description" rows="3">{{ $product->description }}</textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection