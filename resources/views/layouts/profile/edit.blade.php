@extends('layouts.app')

@section('content')
<div class="container">
    <!-- profile -->
    <div>
        <br>
        <div class="card shadow-sm border-0 p-4">
            <div class="text-center mb-4">
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="img-thumbnail rounded-circle shadow-sm"
                    style="width: 120px; height: 120px; object-fit: cover;">
                <h4 class="mt-2 fw-bold">{{ Auth::user()->name }}</h4>
            </div>
            <div class="list-group">
                <div class="list-group-item d-flex justify-content-between">
                    <span class="fw-bold text-secondary">Email:</span>
                    <span class="text-dark">{{ Auth::user()->email }}</span>
                </div>
                <div class="list-group-item d-flex justify-content-between">
                    <span class="fw-bold text-secondary">Số Điện Thoại:</span>
                    <span class="text-dark">{{ Auth::user()->phone }}</span>
                </div>
            </div>
            @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif
            @if($errors->any())
                <ul style="color: red;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <br><br>
        <div class="card shadow-sm border-0 p-4">
            <h2 class="text-center" style="padding: 10px 0 5px 0;">Edit Profile</h2>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" name="phone" class="form-control" value="{{ old('phone', session('user')->phone ?? '') }}">
                </div>
                <!-- đổi mật khẩu -->
                <div class="form-group">
                    <label for="current_password">Mật khẩu hiện tại</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="new_password">Mật khẩu mới</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Xác nhận mật khẩu mới</label>
                    <input type="password" name="new_password_confirmation" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="avatar">Chọn ảnh đại diện</label>
                    <input class="form-control" type="file" id="avatar" name="avatar" onchange="previewImage(event)">
                </div>
                <div class="form-group text-center">
                    <div class="mt-2">
                        <img id="preview" class="img-thumbnail shadow"
                            style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%;">
                    </div>
                </div>
                <div class="form-group text-start">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
            @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif
            @if($errors->any())
                <ul style="color: red;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
