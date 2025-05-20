@extends('layouts.app')

@section('content')
<div class="container">
    <h4 style="text-align: center; padding: 15px 0px 15px 0px; " >Nhật ký đăng nhập & đăng xuất</h4>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>IP</th>
                <!-- <th>Thiết bị</th> -->
                <th>Sự kiện</th>
                <th>Thời gian</th>
            </tr>
            </thead>
        <tbody>
            @foreach ($logs as $log)
            <tr>
                <td>{{ $log->user_name }}</td>
                <td>{{ $log->ip_address }}</td>
                <!-- <td>{{ $log->user_agent }}</td> -->
                <td>{{ $log->event }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>

     
</div>
@endsection
