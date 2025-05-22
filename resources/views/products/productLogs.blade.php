@extends('layouts.app')
@section('content')

<p class="display-6 text-center" style="padding-top: 15px">Lịch sử sản phẩm</p>
<div class="table-responsive card">
    <table class="table table-striped">
        <thead class="table-light">
            <tr>
                <th scope="col" class="text-center">Sản Phẩm</th>
                <th scope="col" class="text-center">Hành Động</th>
                <th scope="col" class="text-center">Thời Gian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $log)              
            <tr>
                <td class="text-center">{{ $log->name }}</td>
                <td class="text-center">{{ $log->action }}</td>
                <td class="text-center">{{ date('d/m/Y H:i', strtotime($log->performed_at)) }}</td>                
            </tr>               
            @endforeach
        </tbody>
    </table>
</div>

@endsection
