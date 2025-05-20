<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'service_used' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
        }

        $customer = Customer::findOrFail($id);

        // Kiểm tra số điện thoại đã tồn tại cho khách khác chưa
        $existingCustomer = Customer::withTrashed()
                                    ->where('phone', $request->phone)
                                    ->where('id', '!=', $id)
                                    ->first();

        if ($existingCustomer) {
            return redirect()->back()
                            ->withErrors(['phone' => 'Số điện thoại đã tồn tại!(Có thể trùng với khách đã bị softDelete)'])
                            ->withInput();
        }

        $customer->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'service_used' => $request->service_used,
            'price' => $request->price,
        ]);

        return redirect()->route('dashboard')->with('success', 'Thông tin khách hàng đã được cập nhật!');
    }

  

        public function updateMultiple(Request $request)
        {
            $changes = $request->input('changes', []);

            foreach ($changes as $id => $fields) {
                $customer = Customer::find($id);
                if ($customer) {
                    foreach ($fields as $field => $value) {
                        $customer->$field = $value;
                    }
                    $customer->save();
                }
            }

            return response()->json(['success' => true]);
        }



        // soft delete
        public function destroy($id)
        {
            $customer = Customer::findOrFail($id);
            $customer->delete(); // Lúc này Laravel sẽ gán giá trị vào cột deleted_at, không xóa khỏi DB
            return redirect()->back()->with('success', 'Đã xóa (tạm thời) khách hàng.');
        }

        // khoi phuc
        public function index()
        {
            $customers = Customer::withTrashed()->get(); // Lấy cả bị xóa
            return view('customers.index', compact('customers'));
        }



        // new+
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'gender' => 'required|in:Nam,Nữ,Khác',
                'service_used' => 'nullable|string|max:255',
                'price' => 'required|numeric|min:0',
            ]);

            $existingCustomer = Customer::where('phone', $request->phone)->first();

            if ($existingCustomer) {
                return redirect()->back()->withErrors(['phone' => 'Số điện thoại đã tồn tại!']);
            }

            Customer::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'service_used' => $request->service_used,
                'price' => $request->price,
            ]);

            return redirect()->route('dashboard')->with('success', 'Khách hàng đã được thêm!');
        }
            


}

