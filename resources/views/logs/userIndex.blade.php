@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h4 class="text-center py-3">Lịch Sử Tạo & Cập Nhật Tài Khoản</h4>
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle text-nowrap">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Phone</th>
                            <th>Avatar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userlogs as $log)
                        <tr>
                            <td>{{ $log->name }}</td>
                            <td style="max-width: 200px;">{{ $log->email }}</td>
                            <td>{{ $log->created_at }}</td>
                            <td>{{ $log->updated_at }}</td>
                            <td>{{ $log->phone }}</td>
                            <td>
                                <img src="{{ asset("storage/{$log->avatar}") }}" alt="Avatar" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
