@extends('layouts.app')

@section('title', 'Liên Hệ')

@push('styles')
<style>
    .card-dark {
        background: #0f172a;
        border: 1px solid #1f2937;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .35);
    }

    .muted {
        color: #94a3b8;
    }

    .input-dark {
        background: #0b1220;
        border: 1px solid #334155;
        color: #e5e7eb;
    }

    .input-dark::placeholder {
        color: #94a3b8;
    }

    .input-dark:focus {
        outline: 0;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, .35);
    }

    .btn-indigo {
        background: #4f46e5;
        color: #fff;
    }

    .btn-indigo:hover {
        background: #6366f1;
    }

    .alert-success {
        background: #052e1a;
        border: 1px solid #065f46;
        color: #a7f3d0;
    }

    .alert-error {
        color: #fecaca;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-12 text-slate-200">
    <h1 class="text-4xl font-extrabold text-center mb-10">Liên Hệ Với Chúng Tôi</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Contact Form --}}
        <section class="card-dark rounded-2xl p-6 md:p-8">
            <h2 class="text-2xl font-semibold mb-6">Gửi Tin Nhắn</h2>

            @if(session('success'))
            <div class="alert-success rounded-xl px-4 py-3 mb-5">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST" novalidate>
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium mb-1">Họ và Tên</label>
                    <input
                        type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full input-dark rounded-lg px-3 py-2 @error('name') border-red-500 @enderror"
                        placeholder="Nguyễn Văn A">
                    @error('name') <p class="alert-error text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input
                        type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full input-dark rounded-lg px-3 py-2 @error('email') border-red-500 @enderror"
                        placeholder="ban@domain.com">
                    @error('email') <p class="alert-error text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="subject" class="block text-sm font-medium mb-1">Tiêu Đề</label>
                    <input
                        type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                        class="w-full input-dark rounded-lg px-3 py-2 @error('subject') border-red-500 @enderror"
                        placeholder="Vấn đề bạn cần hỗ trợ">
                    @error('subject') <p class="alert-error text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label for="message" class="block text-sm font-medium mb-1">Nội Dung Tin Nhắn</label>
                    <textarea
                        name="message" id="message" rows="6" required
                        class="w-full input-dark rounded-lg px-3 py-2 @error('message') border-red-500 @enderror"
                        placeholder="Mô tả chi tiết vấn đề của bạn...">{{ old('message') }}</textarea>
                    @error('message') <p class="alert-error text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit"
                    class="btn-indigo w-full h-11 rounded-xl font-semibold transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-black">
                    Gửi Tin Nhắn
                </button>
            </form>
        </section>

        {{-- Contact Information --}}
        <aside class="space-y-6">
            <div class="card-dark rounded-2xl p-6 md:p-8">
                <h2 class="text-2xl font-semibold mb-4">Thông Tin Liên Hệ</h2>
                <ul class="space-y-2 text-slate-300">
                    <li><span class="muted">Địa chỉ:</span> 123 Đường ABC, Quận XYZ, TP. Hồ Chí Minh</li>
                    <li><span class="muted">Điện thoại:</span> (028) 3456 7890</li>
                    <li><span class="muted">Email:</span> support@ElectroShop.com.vn</li>
                    <li><span class="muted">Giờ làm việc:</span> Thứ 2 – Thứ 7: 8:00 – 18:00</li>
                </ul>
            </div>

            <div class="card-dark rounded-2xl overflow-hidden">
                {{-- Google Maps Embed --}}
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.447188203909!2d106.6296541758874!3d10.776999659244704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529dc1f951c87%3A0x8377d0e94e08ada!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBCw6FjaCBraG9hIC0gxJDhuqFpIGjhu41jIFF14buRYyBnaWEgVFAuSENN!5e0!3m2!1svi!2s!4v1700000000000!5m2!1svi!2s"
                    width="100%" height="300" style="border:0" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </aside>
    </div>
</div>
@endsection