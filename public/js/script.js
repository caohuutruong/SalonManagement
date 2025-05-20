
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function () {
            let customerId = this.getAttribute("data-id");
            let customerName = this.getAttribute("data-name");
            let customerPhone = this.getAttribute("data-phone");
            let customerServiceused = this.getAttribute("data-service_used");
            let customerprice = this.getAttribute("data-price");

            // Gán dữ liệu vào modal
            
            document.getElementById("customer_id").value = customerId;
            document.getElementById("customer_name").value = customerName;
            document.getElementById("customer_phone").value = customerPhone;
            document.getElementById("customer_service_used").value = customerServiceused;
            document.getElementById("customer_price").value = customerprice;
            document.getElementById("customerForm").action = `/customers/${customerId}`;
            document.getElementById("deleteForm").action = `/customers/${customerId}`;
            // Hiển thị modal
            new bootstrap.Modal(document.getElementById("editModal")).show();
        });
    });
});

// delete
function submitDeleteForm() {
    if (confirm("Bạn có chắc muốn xóa khách hàng này không?")) {
        const deleteForm = document.getElementById("deleteForm");
        deleteForm.submit();
    }
}

// alert
document.addEventListener("DOMContentLoaded", function () {
    let alertBox = document.getElementById("success-alert");
    if (alertBox) {
        setTimeout(() => {
            alertBox.style.transition = "opacity 0.5s ease";
            alertBox.style.opacity = "0"; // Làm mờ dần
            setTimeout(() => alertBox.style.display = "none", 500); // Ẩn hoàn toàn sau 0.5s
        }, 2000); 
    }
});
document.addEventListener("DOMContentLoaded", function () {
    let alertBox = document.getElementById("fail-alert");
    if (alertBox) {
        setTimeout(() => {
            alertBox.style.transition = "opacity 0.5s ease";
            alertBox.style.opacity = "0"; // Làm mờ dần
            setTimeout(() => alertBox.style.display = "none", 500); // Ẩn hoàn toàn sau 0.5s
        }, 4000); 
    }
});



