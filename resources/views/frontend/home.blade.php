{{-- resources/views/frontend/home.blade.php (Redesigned “Neo-Glass” UI) --}}
@extends('layouts.app')

@section('title', 'Trang Chủ')

@push('styles')
<style>
    /* Decorative gradient background */
    .hero-bg::before {
        content: "";
        position: absolute;
        inset: -10% -20% auto -20%;
        height: 60vh;
        z-index: -1;
        background: radial-gradient(45% 60% at 20% 40%, rgba(99, 102, 241, .35) 0%, rgba(99, 102, 241, 0) 60%),
            radial-gradient(35% 50% at 80% 20%, rgba(16, 185, 129, .35) 0%, rgba(16, 185, 129, 0) 60%),
            radial-gradient(60% 60% at 50% 80%, rgba(245, 158, 11, .25) 0%, rgba(245, 158, 11, 0) 60%);
        filter: blur(48px);
    }

    /* Glass card */
    .glass {
        @apply bg-white/70 dark:bg-white/10 backdrop-blur-xl border border-white/20 dark:border-white/10 shadow-[0_8px_40px_-10px_rgba(0, 0, 0, .25)];
    }

    /* Soft underline */
    .section-title {
        @apply inline-block relative;
    }

    .section-title::after {
        content: "";
        @apply absolute left-1/2 -translate-x-1/2 -bottom-2 w-20 h-1 rounded-full bg-gradient-to-r from-indigo-500 via-fuchsia-500 to-emerald-500;
    }

    /* Ken Burns for hero */
    .kenburns {
        animation: ken 12s ease-in-out infinite;
        transform-origin: center;
    }

    @keyframes ken {

        0%,
        100% {
            transform: scale(1)
        }

        50% {
            transform: scale(1.06)
        }
    }

    /* Fancy focus ring */
    .focus-ring:focus-visible {
        outline: none;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, .35)
    }
</style>
@endpush

@section('content')
{{-- ===================== 1) HERO / BANNERS ===================== --}}
@if($homeBanners->isNotEmpty())
<section class="relative mb-16 md:mb-20 hero-bg">
    <div
        x-data="heroSlider({ slides: {{ $homeBanners->count() }} })"
        x-init="init()"
        @keydown.left.prevent="prev()"
        @keydown.right.prevent="next()"
        tabindex="0"
        class="relative container mx-auto px-4 outline-none focus-ring">
        <div class="relative overflow-hidden rounded-3xl glass">
            {{-- Slides --}}
            <template x-for="i in slides" :key="i">
                <div
                    x-show="active === i"
                    x-transition.opacity.scale.origin.center
                    class="relative aspect-[16/7] md:aspect-[21/9]">
                    @foreach($homeBanners as $index => $banner)
                    <div x-show="active === {{ $index + 1 }}" class="absolute inset-0">
                        <a href="{{ $banner->link_url ?? '#' }}" class="block h-full">
                            <img
                                src="{{ cloudinary_url($banner->image_url_desktop) }}"
                                alt="{{ $banner->title }}"
                                class="w-full h-full object-cover kenburns"
                                loading="eager">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent"></div>

                            {{-- Caption --}}
                            <div class="absolute bottom-0 left-0 right-0 p-6 md:p-10">
                                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/80 dark:bg-black/40 backdrop-blur text-xs md:text-sm text-gray-900 dark:text-white">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    {{ $banner->title }}
                                </div>
                                @if(!empty($banner->subtitle))
                                <p class="mt-3 md:mt-4 max-w-2xl text-white/90 text-sm md:text-base">
                                    {{ $banner->subtitle }}
                                </p>
                                @endif
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </template>

            {{-- Controls --}}
            @if($homeBanners->count() > 1)
            <div class="absolute inset-0 flex items-center justify-between p-3 md:p-4">
                <button @click="prev()"
                    class="glass w-10 h-10 md:w-11 md:h-11 grid place-items-center rounded-full text-gray-700 dark:text-gray-200 hover:-translate-x-0.5 transition"
                    aria-label="Slide trước">‹</button>
                <button @click="next()"
                    class="glass w-10 h-10 md:w-11 md:h-11 grid place-items-center rounded-full text-gray-700 dark:text-gray-200 hover:translate-x-0.5 transition"
                    aria-label="Slide sau">›</button>
            </div>

            {{-- Dots + Autoplay --}}
            <div class="absolute bottom-3 md:bottom-5 left-0 right-0 flex items-center justify-center gap-2 md:gap-3">
                <template x-for="i in slides" :key="'dot-'+i">
                    <button
                        @click="go(i)"
                        :class="active===i ? 'w-6 bg-white' : 'w-2.5 bg-white/60 hover:bg-white/80'"
                        class="h-2 rounded-full transition-all"
                        :aria-label="`Chuyển đến banner ${i}`"></button>
                </template>

                <button @click="toggle()"
                    class="ml-3 text-white/80 hover:text-white text-xs px-2 py-1 rounded-full bg-black/30 backdrop-blur"
                    x-text="playing ? 'Tạm dừng' : 'Tự chạy'"></button>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

{{-- ===================== 2) PROMO COUNTDOWN ===================== --}}
@if($featuredPromotion)
<section class="relative mb-16 md:mb-20">
    <div class="container mx-auto px-4">
        <div class="relative overflow-hidden rounded-3xl glass">
            <div
                class="absolute -top-24 -right-16 w-72 h-72 bg-gradient-to-br from-yellow-400/30 via-pink-400/20 to-orange-400/20 rounded-full blur-3xl pointer-events-none"></div>
            <div
                class="relative z-10 py-10 md:py-14 text-center"
                x-data="countdown('{{ $featuredPromotion->end_date->toIso8601String() }}')"
                x-init="init()">
                <h2 class="text-3xl md:text-4xl font-black tracking-tight text-gray-900 dark:text-white">
                    {{ $featuredPromotion->name }}
                </h2>
                <p class="mt-2 text-base md:text-lg text-amber-600 dark:text-amber-400">Ưu đãi sẽ kết thúc trong…</p>

                {{-- Timer --}}
                <div class="mt-6 md:mt-8 flex items-center justify-center gap-4 md:gap-6">
                    <template x-for="b in [
                {k:'days',    l:'Ngày'},
                {k:'hours',   l:'Giờ'},
                {k:'minutes', l:'Phút'},
                {k:'seconds', l:'Giây'}]">
                        <div class="w-24 md:w-28 aspect-[5/4] grid place-items-center rounded-2xl bg-gradient-to-b from-white/70 to-white/40 dark:from-white/10 dark:to-white/5 border border-white/30 dark:border-white/10 backdrop-blur">
                            <div class="text-3xl md:text-4xl font-extrabold tabular-nums" x-text="window[b.k] || '00'">00</div>
                            <div class="text-xs mt-1 text-gray-600 dark:text-gray-300" x-text="b.l">Ngày</div>
                        </div>
                    </template>
                </div>

                {{-- Coupon + CTA --}}
                <div class="mt-8 md:mt-10 flex flex-col items-center gap-4">
                    <div x-data="{copied:false}" class="inline-flex items-center glass rounded-xl px-3 py-2">
                        <span class="font-mono text-lg md:text-xl text-amber-600 dark:text-amber-400 mr-3">{{ $featuredPromotion->code }}</span>
                        <button
                            @click="navigator.clipboard.writeText('{{ $featuredPromotion->code }}'); copied=true; setTimeout(()=>copied=false,1500)"
                            class="px-3 py-1.5 rounded-lg bg-gray-900 text-white text-xs md:text-sm hover:opacity-90 transition focus-ring">
                            <span x-show="!copied">Sao chép</span>
                            <span x-show="copied" class="text-emerald-400">Đã chép!</span>
                        </button>
                    </div>

                    <a href="{{ route('products.index') }}"
                        class="group relative inline-flex items-center gap-2 px-6 md:px-8 py-3 md:py-3.5 rounded-xl text-gray-900 bg-gradient-to-r from-amber-400 to-yellow-300 font-semibold hover:from-amber-300 hover:to-yellow-200 transition focus-ring">
                        <span>Mua sắm ngay</span>
                        <svg class="w-4 h-4 transition -translate-x-0.5 group-hover:translate-x-0" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l5 5a1
                  1 0 010 1.414l-5 5a1 1 0 11-1.414-1.414L13.586 10H4a1 1 0
                  110-2h9.586l-3.293-3.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function countdown(endDate) {
        return {
            endDate: new Date(endDate),
            days: '00',
            hours: '00',
            minutes: '00',
            seconds: '00',
            _t: null,
            init() {
                this.tick();
                this._t = setInterval(() => this.tick(), 1000)
            },
            pad(n) {
                return String(n).padStart(2, '0')
            },
            tick() {
                const diff = +this.endDate - +new Date();
                if (diff <= 0) {
                    clearInterval(this._t);
                    this.days = this.hours = this.minutes = this.seconds = '00';
                    return;
                }
                this.days = this.pad(Math.floor(diff / 86400000));
                this.hours = this.pad(Math.floor(diff % 86400000 / 3600000));
                this.minutes = this.pad(Math.floor(diff % 3600000 / 60000));
                this.seconds = this.pad(Math.floor(diff % 60000 / 1000));
                // Expose to DOM-less blocks above (nice for templating)
                window.days = this.days;
                window.hours = this.hours;
                window.minutes = this.minutes;
                window.seconds = this.seconds;
            }
        }
    }
</script>
@endpush
@endif

<div class="container mx-auto px-4">
    {{-- ===================== 3) CATEGORIES ===================== --}}
    @if(isset($categoriesForHome) && $categoriesForHome->isNotEmpty())
    <section class="mb-16 md:mb-20">
        <div class="flex items-end justify-between mb-6">
            <h2 class="text-2xl md:text-3xl font-bold section-title text-gray-900 dark:text-white">Khám Phá Danh Mục</h2>
            <a href="{{ route('products.index') }}"
                class="text-sm md:text-base text-indigo-600 hover:text-indigo-500 font-medium">Xem tất cả →</a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-5 md:gap-6">
            @foreach($categoriesForHome as $category)
            <a href="{{ route('products.category', $category->slug) }}"
                class="group relative rounded-2xl overflow-hidden glass hover:-translate-y-0.5 hover:shadow-2xl transition">
                <div class="relative h-40 md:h-44 overflow-hidden">
                    @if(isset($category->image_path) && $category->image_path)
                    <img src="{{ cloudinary_url($category->image_path) }}"
                        alt="{{ $category->name }}"
                        class="w-full h-full object-cover transition duration-500 group-hover:scale-110"
                        loading="lazy">
                    @else
                    <div class="w-full h-full grid place-items-center bg-gradient-to-br from-gray-100 to-gray-50 dark:from-gray-800 dark:to-gray-700">
                        <span class="text-gray-400">Chưa có ảnh</span>
                    </div>
                    @endif
                    <span class="absolute inset-0 bg-gradient-to-t from-black/40 via-black/10 to-transparent opacity-80"></span>
                </div>
                <div class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-white/80 backdrop-blur text-gray-900">
                    Danh mục
                </div>
                <div class="p-4 text-center">
                    <h3 class="text-base md:text-lg font-semibold text-gray-900 dark:text-white group-hover:text-indigo-600 transition-colors">
                        {{ $category->name }}
                    </h3>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ===================== 4) BRANDS ===================== --}}
    @if(isset($brandsForHome) && $brandsForHome->isNotEmpty())
    <section class="mb-16 md:mb-20">
        <div class="flex items-end justify-between mb-6">
            <h2 class="text-2xl md:text-3xl font-bold section-title text-gray-900 dark:text-white">Thương Hiệu Nổi Bật</h2>
            <a href="{{ route('products.index') }}"
                class="text-sm md:text-base text-indigo-600 hover:text-indigo-500 font-medium">Khám phá →</a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5 md:gap-6">
            @foreach($brandsForHome as $brand)
            <a href="{{ route('products.index', ['brand' => $brand->slug]) }}"
                class="group rounded-2xl px-4 py-6 glass hover:-translate-y-0.5 hover:shadow-2xl transition flex items-center justify-center">
                <div class="w-full h-20 md:h-16 flex items-center justify-center">
                    @if($brand->logo)
                    <img src="{{ cloudinary_url($brand->logo) }}"
                        alt="{{ $brand->name }}"
                        class="max-h-12 md:max-h-10 object-contain transition duration-300 group-hover:scale-105"
                        loading="lazy">
                    @else
                    <span class="text-gray-400">Chưa có logo</span>
                    @endif
                </div>
                <div class="mt-3 text-center">
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-200 group-hover:text-indigo-600 transition-colors">
                        {{ $brand->name }}
                    </h3>
                </div>
            </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ===================== 5) FEATURED PRODUCTS ===================== --}}
    @if($featuredProducts->isNotEmpty())
    <section class="mb-16 md:mb-20">
        <div class="flex items-end justify-between mb-6">
            <h2 class="text-2xl md:text-3xl font-bold section-title text-gray-900 dark:text-white">Sản Phẩm Nổi Bật</h2>
            <a href="{{ route('products.index') }}"
                class="text-sm md:text-base text-indigo-600 hover:text-indigo-500 font-medium">Xem thêm →</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 md:gap-6">
            @foreach($featuredProducts as $product)
            <div class="rounded-2xl glass hover:-translate-y-0.5 hover:shadow-2xl transition">
                @include('frontend.partials.product-card', ['product' => $product])
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ===================== 6) NEW PRODUCTS ===================== --}}
    @if($newProducts->isNotEmpty())
    <section class="mb-8 md:mb-12">
        <div class="flex items-end justify-between mb-6">
            <h2 class="text-2xl md:text-3xl font-bold section-title text-gray-900 dark:text-white">Hàng Mới Về</h2>
            <a href="{{ route('products.index') }}"
                class="text-sm md:text-base text-indigo-600 hover:text-indigo-500 font-medium">Mua ngay →</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5 md:gap-6">
            @foreach($newProducts as $product)
            <div class="rounded-2xl glass hover:-translate-y-0.5 hover:shadow-2xl transition">
                @include('frontend.partials.product-card', ['product' => $product])
            </div>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Minimal Alpine-less slider controller in case Alpine is missing
    // (but we’ll use Alpine API if available)
    function heroSlider({
        slides = 1,
        interval = 5000
    } = {}) {
        return {
            slides,
            active: 1,
            timer: null,
            playing: true,
            init() {
                this.play()
            },
            go(i) {
                this.active = i
            },
            next() {
                this.active = this.active === this.slides ? 1 : this.active + 1
            },
            prev() {
                this.active = this.active === 1 ? this.slides : this.active - 1
            },
            play() {
                if (this.timer) clearInterval(this.timer);
                if (this.playing) {
                    this.timer = setInterval(() => this.next(), interval);
                }
            },
            toggle() {
                this.playing = !this.playing;
                this.play()
            }
        }
    }
</script>
@endpush