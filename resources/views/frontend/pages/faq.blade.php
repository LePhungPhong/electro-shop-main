@extends('layouts.app')

@section('title', 'Câu Hỏi Thường Gặp')

@push('styles')
<style>
    /* Card & nền tối đồng bộ */
    .card-dark {
        background: #0f172a;
        border: 1px solid #1f2937;
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .35)
    }

    .btn-row {
        background: #111827;
        border-top: 1px solid #1f2937
    }

    .btn-row:first-child {
        border-top: none
    }

    .btn-hover:hover {
        background: #1f2937
    }

    .muted {
        color: #94a3b8
    }

    .answer {
        background: #0b1220;
        border-top: 1px solid #1f2937
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-12 text-slate-200">
    <h1 class="text-4xl font-extrabold text-center mb-8">Câu Hỏi Thường Gặp (FAQ)</h1>

    @if($faqs->isNotEmpty())
    <div class="max-w-3xl mx-auto card-dark overflow-hidden">
        @foreach($faqs as $faq)
        <div x-data="{ open:false }" class="btn-row">
            <button
                @click="open = !open"
                class="w-full px-5 py-4 flex items-start sm:items-center justify-between gap-4 text-left btn-hover transition"
                :aria-expanded="open.toString()">
                <div class="flex-1">
                    <h2 class="text-base sm:text-lg font-semibold leading-snug">{{ $faq->question }}</h2>
                    <p class="hidden sm:block muted text-sm mt-1">Nhấn để xem câu trả lời</p>
                </div>
                <span class="shrink-0 grid place-items-center w-9 h-9 rounded-lg border border-slate-600"
                    :class="open ? 'bg-indigo-600 border-indigo-600' : 'bg-transparent'">
                    <svg class="w-5 h-5" viewBox="0 0 24 24"
                        :fill="open ? '#ffffff' : 'none'" :stroke="open ? '#ffffff' : '#cbd5e1'">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 5v14M5 12h14" />
                    </svg>
                </span>
            </button>

            <div x-show="open" x-transition
                class="answer px-5 py-5">
                <div class="prose prose-invert max-w-none">
                    {!! $faq->answer !!}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p class="text-center muted">Hiện chưa có câu hỏi thường gặp nào.</p>
    @endif
</div>
@endsection

@push('scripts')
{{-- Nếu layout chưa nhúng Alpine v3, bỏ comment dòng dưới --}}
{{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
@endpush