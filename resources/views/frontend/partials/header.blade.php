@php
use App\Models\Category;
$allCategories = Category::whereNull('parent_id')
->where('is_active', true)
->with('children')
->orderBy('name')
->get();
@endphp

<header x-data="{ openUser:false, openMobile:false, openProducts:false }"
    class="sticky top-0 z-40 bg-black text-gray-100 border-b border-neutral-800">

    {{-- Top bar (tùy chọn) --}}
    <div class="hidden md:block border-b border-neutral-800">
        <div class="container mx-auto px-4 py-2 text-xs flex items-center justify-between">
            <div class="space-x-3">
                <span>Freeship đơn từ 499k</span><span class="text-neutral-400">•</span><span>Đổi trả 7 ngày</span>
            </div>
            <a href="{{ route('faq') }}" class="text-indigo-400 hover:text-indigo-300">Hỗ trợ & FAQ →</a>
        </div>
    </div>

    {{-- Main row --}}
    <div class="container mx-auto px-4 py-3">
        <div class="flex items-center gap-3">
            {{-- Burger (mobile) --}}
            <button @click="openMobile=true" class="md:hidden p-2 rounded-lg hover:bg-neutral-900" aria-label="Mở menu">
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M3 6h18v2H3zM3 11h18v2H3zM3 16h18v2H3z" />
                </svg>
            </button>

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="text-2xl font-extrabold tracking-tight">
                <span class="text-white">Electro</span><span class="text-indigo-400">Shop</span>
            </a>

            {{-- Search (desktop) --}}
            <div class="hidden md:flex flex-1 max-w-2xl mx-3">
                <form action="{{ route('products.index') }}" method="GET"
                    class="w-full flex overflow-hidden rounded-lg border border-neutral-700 bg-neutral-900">
                    <select name="category"
                        class="hidden lg:block w-48 px-3 text-sm bg-neutral-900">
                        <option value="">Tất cả danh mục</option>
                        @foreach($allCategories as $cat)
                        <option value="{{ $cat->slug }}" @selected(request('category')===$cat->slug)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="q" value="{{ request('q') }}"
                        placeholder="Tìm sản phẩm, thương hiệu…"
                        class="flex-1 px-3 py-2.5 bg-neutral-900 placeholder-neutral-400 focus:outline-none">
                    <button type="submit" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="#fff">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                    </button>
                </form>
            </div>

            {{-- Right actions --}}
            <div class="ml-auto flex items-center gap-2">
                @guest
                <a href="{{ route('login') }}" class="px-3 py-2 rounded-lg hover:bg-neutral-900 text-sm">Đăng nhập</a>
                <a href="{{ route('register') }}" class="px-3 py-2 rounded-lg text-sm font-semibold bg-indigo-600 hover:bg-indigo-500">Đăng ký</a>
                @else
                <a href="{{ route('account.wishlist') }}" class="p-2 rounded-lg hover:bg-neutral-900" title="Yêu thích">
                    @livewire('frontend.wishlist-count')
                </a>
                <div class="relative">
                    @livewire('frontend.cart.shopping-cart-dropdown')
                </div>

                <div class="relative">
                    <button @click="openUser=!openUser" class="flex items-center gap-2 px-2 py-1.5 rounded-lg hover:bg-neutral-900">
                        @if(Auth::user()->avatar)
                        <img src="{{ cloudinary_url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full object-cover">
                        @else
                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-neutral-200 text-neutral-800">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                        @endif
                        <span class="hidden sm:inline text-sm">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-neutral-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M7 7l3 3 3-3 1 1-4 4-4-4 1-1z" />
                        </svg>
                    </button>

                    <div x-show="openUser" @click.away="openUser=false" x-transition
                        class="absolute right-0 mt-2 w-56 rounded-lg overflow-hidden bg-neutral-900 border border-neutral-700 shadow-xl z-50">
                        <a href="{{ route('account.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-neutral-800">Tài khoản</a>
                        <a href="{{ route('account.orders') }}" class="block px-4 py-2 text-sm hover:bg-neutral-800">Đơn hàng</a>
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm hover:bg-neutral-800">Dashboard</a>
                        @if(Auth::user()->is_admin)
                        <a href="{{ route('filament.admin.pages.dashboard') }}" target="_blank" class="block px-4 py-2 text-sm hover:bg-neutral-800">Trang quản trị</a>
                        @endif
                        <div class="border-t border-neutral-800"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-neutral-800">Đăng xuất</button>
                        </form>
                    </div>
                </div>
                @endguest
            </div>
        </div>

        {{-- Mobile search --}}
        <div class="md:hidden mt-2">
            <form action="{{ route('products.index') }}" method="GET"
                class="w-full flex overflow-hidden rounded-lg border border-neutral-700 bg-neutral-900">
                <input type="text" name="q" value="{{ request('q') }}"
                    placeholder="Tìm kiếm sản phẩm…"
                    class="flex-1 px-3 py-2.5 bg-neutral-900 placeholder-neutral-400 focus:outline-none">
                <button type="submit" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="#fff">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    {{-- Nav --}}
    <nav class="border-t border-neutral-800">
        <div class="container mx-auto px-4">
            <ul class="flex items-center justify-center gap-6 h-12 text-sm">
                <li>
                    <a href="{{ route('home') }}"
                        class="px-2 py-1.5 rounded-md hover:bg-neutral-900 {{ request()->routeIs('home') ? 'text-indigo-400 font-semibold' : '' }}">
                        Trang Chủ
                    </a>
                </li>

                {{-- Sản phẩm (mega menu đơn giản, nền đen đặc) --}}
                <li class="relative" x-data @mouseenter="openProducts=true" @mouseleave="openProducts=false">
                    <button class="px-2 py-1.5 rounded-md hover:bg-neutral-900 flex items-center gap-1
            {{ request()->routeIs('products.index') || request()->routeIs('products.category') ? 'text-indigo-400 font-semibold' : '' }}">
                        Sản Phẩm
                        <svg class="w-4 h-4 text-neutral-400" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7 10l5 5 5-5z" />
                        </svg>
                    </button>

                    <div x-show="openProducts" x-transition
                        class="absolute left-1/2 -translate-x-1/2 w-[min(92vw,900px)]
                      rounded-lg bg-neutral-900 border border-neutral-700 shadow-2xl p-4 z-50">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <a href="{{ route('products.index') }}"
                                    class="inline-flex items-center px-3 py-2 rounded-md bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold">
                                    Tất Cả Sản Phẩm →
                                </a>
                                <p class="mt-2 text-xs text-neutral-400">Lọc theo thương hiệu, giá, đánh giá…</p>
                            </div>

                            <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($allCategories->take(8) as $cat)
                                <div class="rounded-md p-2 hover:bg-neutral-800">
                                    <a href="{{ route('products.category', $cat->slug) }}" class="font-medium text-sm">{{ $cat->name }}</a>
                                    @if($cat->children->isNotEmpty())
                                    <ul class="mt-1 space-y-1 text-[13px] text-neutral-300">
                                        @foreach($cat->children->take(5) as $child)
                                        <li><a href="{{ route('products.category', $child->slug) }}" class="hover:text-indigo-400">{{ $child->name }}</a></li>
                                        @endforeach
                                        @if($cat->children->count() > 5)
                                        <li><a href="{{ route('products.category', $cat->slug) }}" class="text-indigo-400">Xem thêm…</a></li>
                                        @endif
                                    </ul>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </li>

                <li><a href="{{ route('blog.index') }}" class="px-2 py-1.5 rounded-md hover:bg-neutral-900 {{ request()->routeIs('blog.*') ? 'text-indigo-400 font-semibold' : '' }}">Tin Tức</a></li>
                <li><a href="{{ route('contact') }}" class="px-2 py-1.5 rounded-md hover:bg-neutral-900 {{ request()->routeIs('contact') ? 'text-indigo-400 font-semibold' : '' }}">Liên Hệ</a></li>
                <li><a href="{{ route('faq') }}" class="px-2 py-1.5 rounded-md hover:bg-neutral-900 {{ request()->routeIs('faq') ? 'text-indigo-400 font-semibold' : '' }}">FAQ</a></li>
            </ul>
        </div>
    </nav>

    {{-- Mobile drawer (nền đen, không trong suốt) --}}
    <div x-show="openMobile" x-transition class="fixed inset-0 z-50 md:hidden">
        <div @click="openMobile=false" class="absolute inset-0 bg-black"></div>
        <div class="absolute left-0 top-0 h-full w-[86vw] max-w-sm bg-neutral-900 border-r border-neutral-700 p-4 overflow-y-auto">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="text-xl font-bold">Electro<span class="text-indigo-400">Shop</span></a>
                <button @click="openMobile=false" class="p-2 rounded-lg hover:bg-neutral-800">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="#e5e7eb">
                        <path d="M18.3 5.71L12 12.01l-6.29-6.3-1.41 1.42L10.59 13.4l-6.3 6.3 1.42 1.41 6.29-6.29 6.29 6.29 1.41-1.41-6.3-6.3 6.3-6.29z" />
                    </svg>
                </button>
            </div>

            <form action="{{ route('products.index') }}" method="GET"
                class="mt-4 w-full flex overflow-hidden rounded-lg border border-neutral-700 bg-neutral-900">
                <input type="text" name="q" value="{{ request('q') }}"
                    placeholder="Tìm kiếm sản phẩm…"
                    class="flex-1 px-3 py-2.5 bg-neutral-900 placeholder-neutral-400 focus:outline-none">
                <button type="submit" class="px-4 py-2.5 bg-indigo-600 hover:bg-indigo-500">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="#fff">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>
                </button>
            </form>

            <nav class="mt-4 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md hover:bg-neutral-800 {{ request()->routeIs('home') ? 'text-indigo-400 font-semibold' : '' }}">Trang Chủ</a>

                <details class="rounded-md overflow-hidden">
                    <summary class="px-3 py-2 cursor-pointer hover:bg-neutral-800">Sản Phẩm</summary>
                    <div class="p-2 space-y-1">
                        <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-md bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-sm">Tất Cả Sản Phẩm</a>
                        @foreach($allCategories as $cat)
                        <div>
                            <a href="{{ route('products.category', $cat->slug) }}" class="block px-3 py-2 rounded-md hover:bg-neutral-800">{{ $cat->name }}</a>
                            @if($cat->children->isNotEmpty())
                            <div class="pl-3">
                                @foreach($cat->children as $child)
                                <a href="{{ route('products.category', $child->slug) }}" class="block px-3 py-1.5 rounded-md text-sm text-neutral-300 hover:bg-neutral-800">{{ $child->name }}</a>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </details>

                <a href="{{ route('blog.index') }}" class="block px-3 py-2 rounded-md hover:bg-neutral-800 {{ request()->routeIs('blog.*') ? 'text-indigo-400 font-semibold' : '' }}">Tin Tức</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md hover:bg-neutral-800 {{ request()->routeIs('contact') ? 'text-indigo-400 font-semibold' : '' }}">Liên Hệ</a>
                <a href="{{ route('faq') }}" class="block px-3 py-2 rounded-md hover:bg-neutral-800 {{ request()->routeIs('faq') ? 'text-indigo-400 font-semibold' : '' }}">FAQ</a>
            </nav>

            @auth
            <div class="mt-4 border-t border-neutral-800 pt-2 space-y-1 text-sm">
                <a href="{{ route('account.dashboard') }}" class="block px-3 py-2 rounded-md hover:bg-neutral-800">Tài khoản</a>
                <a href="{{ route('account.orders') }}" class="block px-3 py-2 rounded-md hover:bg-neutral-800">Đơn hàng</a>
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md hover:bg-neutral-800">Dashboard</a>
                @if(Auth::user()->is_admin)
                <a href="{{ route('filament.admin.pages.dashboard') }}" target="_blank" class="block px-3 py-2 rounded-md hover:bg-neutral-800">Trang quản trị</a>
                @endif
                <form class="px-3 pt-1" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full px-3 py-2 rounded-md hover:bg-neutral-800 text-left">Đăng xuất</button>
                </form>
            </div>
            @endauth
        </div>
    </div>
</header>