@extends('layouts.admin')

@section('title','操作记录')

@section('scripts')
    <script>
        {{-- 如果有的话，在此输出前端立即需要的数据 --}}
        window.USERS = {!! \WoXuanWang\User\Models\User::select('id','name as text')->get() !!};
    </script>
    @dist('vendor')
    @dist('WoXuanWang.actionlog.list')
@endsection
