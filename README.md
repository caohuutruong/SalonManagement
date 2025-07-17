<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Chi tiêu">
    <link rel="apple-touch-icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Ccircle cx='50' cy='50' r='40' fill='%23667eea'/%3E%3Ctext x='50' y='60' text-anchor='middle' font-size='40' fill='white'%3E¥%3C/text%3E%3C/svg%3E">
    <title>Quản lý Chi tiêu</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 414px;
            margin: 0 auto;
            background: white;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .balance-card {
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            padding: 20px;
            margin: 10px 0;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .balance-amount {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .balance-period {
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .tabs {
            display: flex;
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            position: sticky;
            top: 140px;
            z-index: 99;
        }

        .tab {
            flex: 1;
            padding: 15px;
            text-align: center;
            background: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
        }

        .tab.active {
            background: white;
            color: #667eea;
            border-bottom: 3px solid #667eea;
        }

        .tab-content {
            display: none;
            padding: 20px;
        }

        .tab-content.active {
            display: block;
        }

        .expense-form {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #495057;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        .category-buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }

        .category-btn {
            padding: 12px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
            text-align: center;
        }

        .category-btn.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            width: 100%;
            transition: transform 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
        }

        .expense-item {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-left: 4px solid #667eea;
        }

        .expense-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 5px;
        }

        .expense-amount {
            font-size: 1.2rem;
            font-weight: bold;
            color: #dc3545;
        }

        .expense-category {
            background: #e9ecef;
            padding: 4px 8px;
            border-radius: 15px;
            font-size: 0.8rem;
            color: #495057;
        }

        .expense-date {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .expense-note {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 5px;
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin: 20px 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin: 20px 0;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: bold;
            color: #667eea;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 5px;
        }

        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }

        .ai-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .ai-input {
            margin-bottom: 15px;
        }

        .ai-response {
            background: white;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #28a745;
            margin-top: 10px;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            margin-top: 20px;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 8px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .calendar-day.has-expense {
            background: #e3f2fd;
            border: 2px solid #2196f3;
        }

        .calendar-day.selected {
            background: #667eea;
            color: white;
        }

        .expense-amount-small {
            font-size: 0.7rem;
            color: #dc3545;
            margin-top: 2px;
        }

        .toggle-group {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .toggle-btn {
            flex: 1;
            padding: 10px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            transition: all 0.3s;
        }

        .toggle-btn.active {
            background: #28a745;
            color: white;
            border-color: #28a745;
        }

        .toggle-btn.flexible {
            background: #ffc107;
            color: black;
            border-color: #ffc107;
        }

        @media (max-width: 414px) {
            .container {
                max-width: 100%;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Quản lý Chi tiêu</h1>
            <div class="balance-card">
                <div class="balance-amount" id="totalBalance">¥280,000</div>
                <div class="balance-period" id="currentPeriod">25/12/2024 - 24/01/2025</div>
            </div>
        </header>

        <div class="tabs">
            <button class="tab active" onclick="showTab('overview')">Tổng quan</button>
            <button class="tab" onclick="showTab('add')">Thêm chi tiêu</button>
            <button class="tab" onclick="showTab('calendar')">Lịch</button>
            <button class="tab" onclick="showTab('ai')">AI</button>
        </div>

        <div id="overview" class="tab-content active">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value" id="totalSpent">¥0</div>
                    <div class="stat-label">Đã chi tiêu</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value" id="remainingBalance">¥280,000</div>
                    <div class="stat-label">Còn lại</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value" id="dailyAverage">¥0</div>
                    <div class="stat-label">Trung bình/ngày</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value" id="fixedExpenses">¥0</div>
                    <div class="stat-label">Chi phí cố định</div>
                </div>
            </div>

            <div class="chart-container">
                <canvas id="expenseChart"></canvas>
            </div>

            <div id="warnings"></div>

            <div id="expenseList">
                <h3>Chi tiêu gần đây</h3>
            </div>
        </div>

        <div id="add" class="tab-content">
            <div class="expense-form">
                <div class="form-group">
                    <label>Số tiền (¥)</label>
                    <input type="number" id="amount" placeholder="Nhập số tiền">
                </div>

                <div class="form-group">
                    <label>Danh mục</label>
                    <div class="category-buttons">
                        <button class="category-btn active" data-category="food">🍽️ Ăn uống</button>
                        <button class="category-btn" data-category="transport">🚗 Di chuyển</button>
                        <button class="category-btn" data-category="fixed">🏠 Sinh hoạt cố định</button>
                        <button class="category-btn" data-category="shopping">🛒 Mua sắm</button>
                        <button class="category-btn" data-category="other">📦 Khác</button>
                    </div>
                </div>

                <div class="form-group">
                    <label>Ngày chi tiêu</label>
                    <input type="date" id="expenseDate">
                </div>

                <div class="form-group">
                    <label>Loại chi tiêu</label>
                    <div class="toggle-group">
                        <button class="toggle-btn active" id="mandatoryBtn" onclick="toggleExpenseType('mandatory')">Bắt buộc</button>
                        <button class="toggle-btn flexible" id="flexibleBtn" onclick="toggleExpenseType('flexible')">Linh hoạt</button>
                    </div>
                </div>

                <div class="form-group">
                    <label>Ghi chú</label>
                    <textarea id="note" placeholder="Thêm ghi chú..."></textarea>
                </div>

                <button class="btn-primary" onclick="addExpense()">Thêm chi tiêu</button>
            </div>
        </div>

        <div id="calendar" class="tab-content">
            <h3>Lịch chi tiêu - <span id="calendarMonth"></span></h3>
            <div class="calendar-grid" id="calendarGrid"></div>
        </div>

        <div id="ai" class="tab-content">
            <div class="ai-section">
                <h3>🤖 Phân tích AI</h3>
                <div class="form-group">
                    <label>Nhập câu hỏi hoặc yêu cầu phân tích</label>
                    <textarea id="aiInput" placeholder="Ví dụ: Phân tích chi tiêu tháng này, đưa ra gợi ý tiết kiệm, so sánh với tháng trước..."></textarea>
                </div>
                <button class="btn-primary" onclick="analyzeWithAI()">Phân tích</button>
                <div id="aiResponse" class="ai-response" style="display: none;"></div>
            </div>
        </div>
    </div>

    <script>
        // Dữ liệu toàn cục
        let expenses = [];
        let currentCategory = 'food';
        let currentExpenseType = 'mandatory';
        let chart = null;

        // Thiết lập ngày mặc định
        document.getElementById('expenseDate').value = new Date().toISOString().split('T')[0];

        // Khởi tạo ứng dụng
        function initApp() {
            setupCategoryButtons();
            updateCalendar();
            updateOverview();
            updateChart();
        }

        // Thiết lập nút danh mục
        function setupCategoryButtons() {
            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    currentCategory = this.dataset.category;
                });
            });
        }

        // Chuyển đổi tab
        function showTab(tabName) {
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            
            event.target.classList.add('active');
            document.getElementById(tabName).classList.add('active');
            
            if (tabName === 'calendar') {
                updateCalendar();
            }
        }

        // Chuyển đổi loại chi tiêu
        function toggleExpenseType(type) {
            currentExpenseType = type;
            document.getElementById('mandatoryBtn').classList.toggle('active', type === 'mandatory');
            document.getElementById('flexibleBtn').classList.toggle('active', type === 'flexible');
        }

        // Thêm chi tiêu
        function addExpense() {
            const amount = parseFloat(document.getElementById('amount').value);
            const date = document.getElementById('expenseDate').value;
            const note = document.getElementById('note').value;

            if (!amount || !date) {
                alert('Vui lòng nhập đầy đủ thông tin!');
                return;
            }

            const expense = {
                id: Date.now(),
                amount: amount,
                category: currentCategory,
                date: date,
                note: note,
                type: currentExpenseType,
                timestamp: new Date()
            };

            expenses.push(expense);
            updateOverview();
            updateChart();
            updateCalendar();

            // Reset form
            document.getElementById('amount').value = '';
            document.getElementById('note').value = '';
            
            // Chuyển về tab tổng quan
            showTab('overview');
            document.querySelector('.tab[onclick="showTab(\'overview\')"]').classList.add('active');
        }

        // Cập nhật tổng quan
        function updateOverview() {
            const totalSpent = expenses.reduce((sum, exp) => sum + exp.amount, 0);
            const remainingBalance = 280000 - totalSpent;
            const dailyAverage = expenses.length > 0 ? totalSpent / expenses.length : 0;
            const fixedExpenses = expenses.filter(exp => exp.category === 'fixed').reduce((sum, exp) => sum + exp.amount, 0);

            document.getElementById('totalSpent').textContent = `¥${totalSpent.toLocaleString()}`;
            document.getElementById('remainingBalance').textContent = `¥${remainingBalance.toLocaleString()}`;
            document.getElementById('dailyAverage').textContent = `¥${Math.round(dailyAverage).toLocaleString()}`;
            document.getElementById('fixedExpenses').textContent = `¥${fixedExpenses.toLocaleString()}`;

            // Cập nhật danh sách chi tiêu
            updateExpenseList();
            
            // Kiểm tra cảnh báo
            checkWarnings();
        }

        // Cập nhật danh sách chi tiêu
        function updateExpenseList() {
            const expenseList = document.getElementById('expenseList');
            const recentExpenses = expenses.slice(-10).reverse();
            
            const categoryNames = {
                food: '🍽️ Ăn uống',
                transport: '🚗 Di chuyển',
                fixed: '🏠 Sinh hoạt cố định',
                shopping: '🛒 Mua sắm',
                other: '📦 Khác'
            };

            expenseList.innerHTML = '<h3>Chi tiêu gần đây</h3>';
            
            recentExpenses.forEach(expense => {
                const item = document.createElement('div');
                item.className = 'expense-item';
                item.innerHTML = `
                    <div class="expense-header">
                        <span class="expense-amount">-¥${expense.amount.toLocaleString()}</span>
                        <span class="expense-category">${categoryNames[expense.category]}</span>
                    </div>
                    <div class="expense-date">${new Date(expense.date).toLocaleDateString('vi-VN')}</div>
                    ${expense.note ? `<div class="expense-note">${expense.note}</div>` : ''}
                `;
                expenseList.appendChild(item);
            });
        }

        // Cập nhật biểu đồ
        function updateChart() {
            const ctx = document.getElementById('expenseChart').getContext('2d');
            
            if (chart) {
                chart.destroy();
            }

            const categoryData = {
                food: 0,
                transport: 0,
                fixed: 0,
                shopping: 0,
                other: 0
            };

            expenses.forEach(expense => {
                categoryData[expense.category] += expense.amount;
            });

            const data = {
                labels: ['Ăn uống', 'Di chuyển', 'Sinh hoạt cố định', 'Mua sắm', 'Khác'],
                datasets: [{
                    data: Object.values(categoryData),
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF'
                    ]
                }]
            };

            chart = new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Kiểm tra cảnh báo
        function checkWarnings() {
            const warnings = document.getElementById('warnings');
            warnings.innerHTML = '';

            const totalSpent = expenses.reduce((sum, exp) => sum + exp.amount, 0);
            const categoryTotals = {};
            
            expenses.forEach(expense => {
                categoryTotals[expense.category] = (categoryTotals[expense.category] || 0) + expense.amount;
            });

            // Cảnh báo chi tiêu ăn uống > 30%
            if (categoryTotals.food && (categoryTotals.food / totalSpent) > 0.3) {
                const warning = document.createElement('div');
                warning.className = 'warning';
                warning.textContent = `⚠️ Chi tiêu ăn uống đã vượt quá 30% tổng chi tiêu (${((categoryTotals.food / totalSpent) * 100).toFixed(1)}%)`;
                warnings.appendChild(warning);
            }

            // Cảnh báo chi tiêu > 50% tổng thu nhập
            if (totalSpent > 140000) {
                const warning = document.createElement('div');
                warning.className = 'warning';
                warning.textContent = `⚠️ Bạn đã chi tiêu hơn 50% tổng thu nhập tháng này!`;
                warnings.appendChild(warning);
            }
        }

        // Cập nhật lịch
        function updateCalendar() {
            const now = new Date();
            const currentMonth = now.getMonth();
            const currentYear = now.getFullYear();
            
            document.getElementById('calendarMonth').textContent = `${currentMonth + 1}/${currentYear}`;
            
            const calendar = document.getElementById('calendarGrid');
            calendar.innerHTML = '';
            
            // Thêm header cho các ngày trong tuần
            const weekdays = ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'];
            weekdays.forEach(day => {
                const dayElement = document.createElement('div');
                dayElement.textContent = day;
                dayElement.style.fontWeight = 'bold';
                dayElement.style.textAlign = 'center';
                dayElement.style.padding = '10px';
                calendar.appendChild(dayElement);
            });

            // Tạo lịch cho tháng hiện tại
            const firstDay = new Date(currentYear, currentMonth, 1);
            const lastDay = new Date(currentYear, currentMonth + 1, 0);
            const startDate = new Date(firstDay);
            startDate.setDate(startDate.getDate() - firstDay.getDay());

            for (let i = 0; i < 42; i++) {
                const date = new Date(startDate);
                date.setDate(startDate.getDate() + i);
                
                const dayElement = document.createElement('div');
                dayElement.className = 'calendar-day';
                dayElement.textContent = date.getDate();
                
                if (date.getMonth() !== currentMonth) {
                    dayElement.style.opacity = '0.3';
                }
                
                // Kiểm tra có chi tiêu trong ngày này không
                const dateString = date.toISOString().split('T')[0];
                const dayExpenses = expenses.filter(exp => exp.date === dateString);
                
                if (dayExpenses.length > 0) {
                    dayElement.classList.add('has-expense');
                    const totalAmount = dayExpenses.reduce((sum, exp) => sum + exp.amount, 0);
                    const amountElement = document.createElement('div');
                    amountElement.className = 'expense-amount-small';
                    amountElement.textContent = `¥${totalAmount.toLocaleString()}`;
                    dayElement.appendChild(amountElement);
                }
                
                calendar.appendChild(dayElement);
            }
        }

        // Phân tích AI
        function analyzeWithAI() {
            const input = document.getElementById('aiInput').value;
            const response = document.getElementById('aiResponse');
            
            if (!input.trim()) {
                alert('Vui lòng nhập câu hỏi!');
                return;
            }

            // Tính toán thống kê
            const totalSpent = expenses.reduce((sum, exp) => sum + exp.amount, 0);
            const categoryTotals = {};
            const typeSpending = { mandatory: 0, flexible: 0 };
            
            expenses.forEach(expense => {
                categoryTotals[expense.category] = (categoryTotals[expense.category] || 0) + expense.amount;
                typeSpending[expense.type] += expense.amount;
            });

            // Tạo phản hồi AI giả lập
            let aiAnalysis = '';
            
            if (input.toLowerCase().includes('phân tích') || input.toLowerCase().includes('tổng quan')) {
                aiAnalysis = `
                    <h4>📊 Phân tích chi tiêu của bạn:</h4>
                    <p><strong>Tổng chi tiêu:</strong> ¥${totalSpent.toLocaleString()} (${((totalSpent/280000)*100).toFixed(1)}% thu nhập)</p>
                    <p><strong>Danh mục chi nhiều nhất:</strong> ${Object.keys(categoryTotals).reduce((a, b) => categoryTotals[a] > categoryTotals[b] ? a : b, 'food')} - ¥${Math.max(...Object.values(categoryTotals)).toLocaleString()}</p>
                    <p><strong>Chi tiêu bắt buộc:</strong> ¥${typeSpending.mandatory.toLocaleString()}</p>
                    <p><strong>Chi tiêu linh hoạt:</strong> ¥${typeSpending.flexible.toLocaleString()}</p>
                `;
            } else if (input.toLowerCase().includes('tiết kiệm') || input.toLowerCase().includes('gợi ý')) {
                aiAnalysis = `
                    <h4>💡 Gợi ý tiết kiệm:</h4>
                    <p>• Hãy thử nấu ăn tại nhà nhiều hơn để giảm chi phí ăn uống</p>
                    <p>• Sử dụng phương tiện công cộng thay vì taxi</p>
                    <p>• Lập kế hoạch mua sắm trước khi đi siêu thị</p>
                    <p>• Thiết lập ngân sách hàng tuần cho mỗi danh mục</p>
                `;
            } else {
                aiAnalysis = `
                    <h4>🤖 Phân tích tùy chỉnh:</h4>
                    <p>Dựa trên dữ liệu chi tiêu của bạn, tôi thấy bạn có ${expenses.length} giao dịch với tổng giá trị ¥${totalSpent.toLocaleString()}.</p>
                    <p>Xu hướng chi tiêu của bạn cho thấy sự quản lý tài chính ${totalSpent < 140000 ? 'tốt' : 'cần cải thiện'}.</p>
                `;
            }

            response.innerHTML = aiAnalysis;
            response.style.display = 'block';
        }

        // Khởi tạo ứng dụng
        initApp();
    </script>
</body>
</html>
