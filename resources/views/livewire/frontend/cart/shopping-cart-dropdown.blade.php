{{-- resources/views/livewire/frontend/cart/shopping-cart-dropdown.blade.php --}}
<div class="relative" x-data="{ open: false }" @keydown.escape.window="open=false">
    {{-- Trigger --}}
    <button
        @click="open = !open"
        class="relative inline-flex items-center justify-center w-10 h-10 rounded-xl
               bg-neutral-900 border border-neutral-800 text-neutral-300
               hover:text-white hover:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-black"
        aria-haspopup="true" :aria-expanded="open.toString()" title="Giỏ hàng">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="#e5e7eb" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-2.3 2.3c-.63.63-.18 1.7.7 1.7H17m0 0a2 2 0 100 4 2 2 0 000-4m-8 2a2 2 0 11-4 0 2 2 0 014 0" />
        </svg>

        @if($cartCount > 0)
        <span class="absolute -top-1.5 -right-1.5 min-w-[20px] h-5 px-1.5 rounded-full
                         bg-red-600 text-white text-[11px] font-semibold leading-5 text-center">
            {{ $cartCount }}
        </span>
        @endif
    </button>

    {{-- Panel --}}
    <div
        x-cloak
        x-show="open"
        @click.away="open=false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-1"
        class="absolute right-0 mt-2 w-[22rem] md:w-96 rounded-2xl overflow-hidden z-50
               bg-neutral-900 border border-neutral-800 shadow-2xl"
        role="dialog" aria-label="Giỏ hàng"
        style="display: none;">
        <div class="p-4">
            <h3 class="text-base font-semibold text-white mb-3">Giỏ Hàng Của Bạn</h3>

            @if($cartItems && count($cartItems) > 0)
            {{-- Danh sách item --}}
            <div class="max-h-64 overflow-y-auto space-y-3 mb-4 pr-1 custom-scrollbar-dark">
                @foreach($cartItems as $item)
                <div class="flex items-start gap-3" wire:key="cart-dropdown-{{ $item['rowId'] }}">
                    @php
                    $product = isset($item['options']['product_id_original'])
                    ? \App\Models\Product::find($item['options']['product_id_original'])
                    : null;

                    if ($product && $product->images->isNotEmpty()) {
                    $imgPath = $product->images->firstWhere('is_thumbnail', true)?->image_path
                    ?: $product->images->first()->image_path;
                    $imageUrl = cloudinary_url($imgPath);
                    } else {
                    $imageUrl = 'https://via.placeholder.com/64?text=No+Img';
                    }
                    @endphp

                    <img src="{{ $imageUrl }}" alt="{{ $item['name'] }}"
                        class="w-16 h-16 object-cover rounded-lg border border-neutral-800">

                    <div class="flex-grow min-w-0">
                        <a href="{{ $product ? route('products.show', $product->slug) : '#' }}"
                            class="text-sm font-medium text-neutral-100 hover:text-indigo-400 block truncate">
                            {{ $item['name'] }}
                        </a>

                        @if(count($item['options']) > 1)
                        <p class="text-[12px] text-neutral-400 mt-0.5 truncate">
                            @foreach($item['options'] as $key => $value)
                            @if($key !== 'product_id_original')
                            <span class="capitalize">{{ $key }}:</span> {{ $value }}@if(!$loop->last), @endif
                            @endif
                            @endforeach
                        </p>
                        @endif

                        <p class="text-xs text-neutral-400 mt-0.5">
                            {{ $item['qty'] }} ×
                            <span class="text-neutral-200 font-medium">
                                {{ number_format($item['price'], 0, ',', '.') }}₫
                            </span>
                        </p>
                    </div>

                    <button
                        wire:click="removeItem('{{ $item['rowId'] }}')"
                        wire:loading.attr="disabled"
                        wire:target="removeItem('{{ $item['rowId'] }}')"
                        class="p-2 rounded-lg text-neutral-400 hover:text-red-500 hover:bg-neutral-800
                                       focus:outline-none focus:ring-2 focus:ring-red-500"
                        aria-label="Xóa sản phẩm">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="#ef4444" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 
                                             1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 
                                             0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 
                                             0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 
                                             0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                @endforeach
            </div>

            {{-- Tóm tắt --}}
            <div class="border-t border-neutral-800 pt-3">
                <div class="flex justify-between items-center text-sm font-medium">
                    <span class="text-neutral-300">Tạm tính:</span>
                    <span class="text-white">{{ number_format($cartSubtotal, 0, ',', '.') }}₫</span>
                </div>

                @if($cartTax > 0)
                <div class="flex justify-between items-center text-sm font-medium mt-1">
                    <span class="text-neutral-300">Thuế:</span>
                    <span class="text-white">{{ number_format($cartTax, 0, ',', '.') }}₫</span>
                </div>
                @endif

                <div class="mt-4 grid grid-cols-2 gap-2">
                    <a href="{{ route('cart.index') }}"
                        class="inline-flex items-center justify-center h-10 rounded-xl
                                  bg-neutral-800 border border-neutral-700 text-neutral-200 text-sm font-medium
                                  hover:border-indigo-600 hover:text-white transition">
                        Xem Giỏ Hàng
                    </a>
                    <a href="{{ route('checkout.index') }}"
                        class="inline-flex items-center justify-center h-10 rounded-xl
                                  bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-500 transition">
                        Thanh Toán
                    </a>
                </div>
            </div>
            @else
            <div class="py-10 text-center">
                <p class="text-neutral-400">Giỏ hàng của bạn đang trống.</p>
            </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Scrollbar tối, màu cố định (không trong suốt) */
    .custom-scrollbar-dark::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .custom-scrollbar-dark::-webkit-scrollbar-track {
        background: #0b0f19;
        border-radius: 10px;
    }

    .custom-scrollbar-dark::-webkit-scrollbar-thumb {
        background: #3f3f46;
        border-radius: 10px;
    }

    .custom-scrollbar-dark::-webkit-scrollbar-thumb:hover {
        background: #52525b;
    }

    /* Ẩn phần tử khi x-cloak để tránh nháy */
    [x-cloak] {
        display: none !important;
    }
</style>
@endpush