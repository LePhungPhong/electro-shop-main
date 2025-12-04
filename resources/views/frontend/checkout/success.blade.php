@extends('layouts.app')

@section('title', 'Đặt Hàng Thành Công')

@push('styles')
<style>
    .card-dark {
        background: #0f172a;
        border: 1px solid #1f2937;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .35);
    }

    .muted {
        color: #94a3b8
    }

    .btn-indigo {
        background: #4f46e5;
        color: #fff
    }

    .btn-indigo:hover {
        background: #6366f1
    }

    .ring-focus:focus {
        outline: 0;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, .35)
    }

    .ok {
        color: #22c55e
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-16 text-slate-200">
    <div class="max-w-xl mx-auto card-dark rounded-2xl p-8 text-center">
        {{-- Icon success --}}
        <div class="w-20 h-20 mx-auto mb-6 rounded-full grid place-items-center" style="background:#052e1a;border:1px solid #065f46">
            <svg class="w-12 h-12 ok" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0" />
            </svg>
        </div>

        <h1 class="text-3xl font-extrabold mb-2">Đặt Hàng Thành Công!</h1>
        <p class="muted">Cảm ơn bạn đã mua sắm tại ElectroShop.</p>

        @if(isset($orderNumber) && $orderNumber)
        <p class="mt-4">
            Mã đơn hàng của bạn là
            <span class="font-semibold text-indigo-300 tracking-wide">{{ $orderNumber }}</span>.
        </p>
        <p class="muted mt-2">
            Chúng tôi sẽ sớm liên hệ để xác nhận và giao hàng. Bạn có thể theo dõi trong
            <a href="{{ route('account.orders') }}" class="text-indigo-300 hover:text-indigo-200 font-semibold underline underline-offset-4">
                lịch sử đơn hàng
            </a>.
        </p>
        @else
        <p class="muted mt-4">
            Chúng tôi sẽ sớm xử lý đơn của bạn. Theo dõi trong
            <a href="{{ route('account.orders') }}" class="text-indigo-300 hover:text-indigo-200 font-semibold underline underline-offset-4">
                lịch sử đơn hàng
            </a>.
        </p>
        @endif

        {{-- Actions --}}
        <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('products.index') }}"
                class="btn-indigo ring-focus px-6 py-3 rounded-xl font-semibold inline-flex items-center justify-center">
                Tiếp Tục Mua Sắm
            </a>
            <a href="{{ route('account.orders') }}"
                class="px-6 py-3 rounded-xl font-semibold inline-flex items-center justify-center border border-slate-600 hover:border-slate-400 text-slate-200 ring-focus">
                Xem Đơn Hàng
            </a>
        </div>

        <p class="mt-6 text-sm muted">
            Cần hỗ trợ? Hãy
            <a href="{{ route('contact') }}" class="text-indigo-300 hover:text-indigo-200 underline underline-offset-4">
                liên hệ với chúng tôi
            </a>.
        </p>
    </div>
</div>
@endsection