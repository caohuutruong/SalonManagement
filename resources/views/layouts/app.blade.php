<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Salon Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <!-- xem trước ảnh khi tải lên  -->
    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <!-- Updated navbar code with circular profile image avatar on the right -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
            <a class="navbar-brand logo-text" href="{{ route('dashboard') }}">
                Salon Management
            </a>

                <!-- Nút Toggle khi màn hình nhỏ -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navbarNav">
                    <ul class="navbar-nav ml-auto align-items-center">
                        <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">Profile11</a></li>                        
                    </ul>
                    <ul class="navbar-nav ml-auto align-items-center">
                        <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">Profile11</a></li>                       
                    </ul>
                    <ul class="navbar-nav ml-auto align-items-center">
                        <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">Profile11</a></li>
                    </ul>
               </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav ml-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                        </li>
                        <li class="nav-item" style="margin-right: ;" >
                            <a href="/logs" class="nav-link">Sign-up History</a>
                        </li>
                        <li class="nav-item" style="margin-right: ;" >
                            <a href="/userlogs" class="nav-link">Login-logs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        </li>
                        <li class="nav-item d-flex align-items-center" style="padding-right: 15px;  " >
                            @if (Auth::check() && Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle img-fluid" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                            <p class="text-muted">Chưa có ảnh đại diện</p>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    
    @yield('content')
    @yield('newCustomer')
    @yield('customerTable')
    </div>
    <!-- Footer -->
    <footer class="text-center mt-4">
        <p>&copy; 2025 Salon Management</p>
    </footer>

    
    <script>
    let edits = {}; // Lưu các giá trị đã sửa

    // Hover hiện nút edit
    $('.editable').hover(function() {
        $(this).find('.edit-btn-2').show();
    }, function() {
        $(this).find('.edit-btn-2').hide();
    });

    // Click vào nút Edit
    $('.edit-btn-2').click(function(e) {
        e.stopPropagation();
        let cell = $(this).closest('.editable');
        cell.find('.view-mode').hide();
        cell.find('.edit-mode').show().focus();
        $(this).hide();
    });

    // Khi người dùng sửa ô và rời khỏi ô
    $('.edit-mode').on('input', function() {
        let cell = $(this).closest('.editable');
        let row = cell.closest('tr');
        let id = row.data('id');
        let field = cell.data('field');
        let newValue = $(this).val();

        if (!edits[id]) edits[id] = {};
        edits[id][field] = newValue;
    });

    // Gửi tất cả thay đổi
    $('#save-all').click(function() {
        if (Object.keys(edits).length === 0) {
        alert("Không có thay đổi nào.");
        return;
        }


        $.ajax({
        url: '/customers/update-multiple',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            changes: edits
        },
        success: function(response) {
            alert("Cập nhật thành công!");

            // Cập nhật giao diện: chuyển lại sang view mode
            for (let id in edits) {
            let row = $(`tr[data-id="${id}"]`);
            for (let field in edits[id]) {
                let newValue = edits[id][field];
                row.find(`td[data-field="${field}"] .view-mode`).text(newValue).show();
                row.find(`td[data-field="${field}"] .edit-mode`).val(newValue).hide();
            }
            }

            edits = {}; // Xóa các thay đổi đã lưu
            location.reload();
        },
        error: function(xhr) {
            alert("Có lỗi xảy ra khi lưu.");
        }
        });
    });
    </script>
</body>
</html>
