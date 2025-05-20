@extends('layouts.app')
@section('content')
<p class="display-6 text-center" >Products Management</p>
<form action="{{ route('product.store') }}" method="POST">
    @csrf
    <div class="card p-3">
        <div class="mb-3">
            <label for="product_name" class="form-label">Tên Sản Phẩm</label>
            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="" >
        </div>

        <div class="mb-3">
            <label for="product_category" class="form-label">Loại Sản Phẩm</label>
            <select class="form-select" id="product_category" name="product_category" aria-label="disabled">
                <option selected disabled></option>
                <option value="hair_tools">Dụng cụ làm tóc</option>
                <option value="hair_care">Mỹ phẩm chăm sóc tóc</option>
                <option value="accessories">Phụ kiện làm tóc</option>
                
            </select>
        </div>

        <div class="mb-3">
            <label for="product_quantity" class="form-label">Số Lượng</label>
            <input type="number" class="form-control" id="product_quantity" name="product_quantity" min="1" placeholder="">
        </div>

        <div class="mb-3">
            <label for="product_price" class="form-label">Giá</label>
            <input type="number" class="form-control" id="product_price" name="product_price" min="0" step="0.01" placeholder="">
        </div>

        <div class="mb-3">
            <label for="product_description" class="form-label">Miêu Tả</label>
            <textarea class="form-control" id="product_description" name="product_description" rows="1"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </div>
</form>    

@endsection