# 🔐 Laravel Mini Project - 🔄 Biến đổi, 📛 Tên biến, 🏗️ Cấu trúc

📘 Tài liệu tham chiếu dành cho việc xây dựng hệ thống 🧑‍💻 đăng nhập / 🆕 đăng ký / 🚪 đăng xuất + 👤 hồ sơ trong Laravel 12

---

## 1️⃣. Biến & 🧩 field trong `AuthController.php`

| 🏷️ Tên biến / field         | 📝 Vai trò / Giải thích                        |
| ---------------------------- | ---------------------------------------------- |
| `$request`                   | 📤 Dữ liệu từ form gửi lên                     |
| `$user`                      | 👤 Đối tượng User model                        |
| `'name'`                     | 🧑‍💼 Tên người dùng                           |
| `'email'`                    | 📧 Email người dùng (unique)                   |
| `'password'`                 | 🔑 Mật khẩu (được hash)                        |
| `'phone'`                    | 📱 Số điện thoại                               |
| `'avatar'`                   | 🖼️ Ảnh đại diện                               |
| `$avatarPath`                | 📁 Đường dẫn lưu avatar                        |
| `session(['user' => $user])` | 🗂️ Lưu user vào session (thay auth)           |
| `Storage::disk('public')`    | 💾 Lưu/Đọc/Đổi file trong `storage/app/public` |

---

## 2️⃣. Biến & field trong `edit.blade.php`

| 🏷️ Tên biến / câu lệnh   | 📝 Vai trò                                |
| ------------------------- | ----------------------------------------- |
| `session('user')`         | 🔐 Lấy user hiện tại (nếu đang đăng nhập) |
| `session('user')->phone`  | 📞 Hiển thị số điện thoại                 |
| `session('user')->avatar` | 🖼️ Hiển thị ảnh đại diện                 |
| `old('phone')`            | ♻️ Giữ lại giá trị khi submit lỗi         |
| `@if(session('success'))` | ✅ Hiển thị thông báo update thành công    |
| `name="avatar"`           | 📤 Input file upload                      |

---

## 3️⃣. 🛣️ Route đã dùng trong dự án

| 🏷️ Route name   | 🎯 Chức năng                |
| ---------------- | --------------------------- |
| `login.form`     | 🔐 Trang login              |
| `dashboard`      | 📊 Trang sau khi login      |
| `profile.edit`   | ✏️ Trang sửa profile        |
| `profile.update` | 💾 Xử lý PUT update profile |

---

## 4️⃣. 📁 File & 📂 Folder trong dự án

| 📄 File / 📂 Folder                              | 📝 Vai trò                                        |
| ------------------------------------------------ | ------------------------------------------------- |
| `AuthController.php`                             | 🎮 Controller xử lý login/register/logout/profile |
| `resources/views/register.blade.php`             | 📝 Form đăng ký                                   |
| `resources/views/login.blade.php`                | 🔐 Form đăng nhập                                 |
| `resources/views/dashboard.blade.php`            | 📊 Dashboard user                                 |
| `resources/views/layouts/profile/edit.blade.php` | 🖋️ Form sửa profile                              |
| `public/storage/avatars`                         | 🗃️ Lưu trữ ảnh đại diện                          |

---

## 5️⃣. 🧠 Quy ước tên gợi nhớ

| ℹ️ Thông tin              | 🧩 Gợi nhớ                       |
| ------------------------- | -------------------------------- |
| 📞 Tên biến số điện thoại | `phone`                          |
| 🖼️ Tên biến ảnh đại diện | `avatar`                         |
| 🗂️ Session user          | `session('user')`                |
| 🛣️ Route profile         | `profile.edit`, `profile.update` |

---

❗ **Lưu ý:**

* Trong Laravel 1️⃣2️⃣ không còn `Kernel.php`, middleware được đăng ký trong `bootstrap/app.php` bằng closure `->withMiddleware(...)`
* Bạn đang dùng `session()` thay vì `auth()` => ⚠️ Phải thận trọng khi truy cập thông tin user trực tiếp.

---

📅 **Cập nhật lần cuối: 13/05/2025**

> ✍️ Biên soạn bởi ChatGPT - Laravel Documentation Assistant
