{{-- resources/views/frontend/partials/product-card.blade.php --}}
<div class="group relative rounded-xl overflow-hidden border bg-neutral-900 border-neutral-800 shadow-sm hover:shadow-lg hover:border-indigo-600 transition">
    {{-- Link tới trang chi tiết sản phẩm --}}
    <a href="{{ route('products.show', $product->slug) }}" class="block">
        {{-- Ảnh thumbnail --}}
        <div class="w-full h-56 bg-neutral-800 flex items-center justify-center">
            @php
            $thumb = $product->thumbnail;
            $imgPath = $thumb ? $thumb->image_path : ($product->images->first()?->image_path);
            @endphp

            @if($imgPath)
            <img
                src="{{ cloudinary_url($imgPath) }}"
                alt="{{ $product->name }}"
                class="w-full h-full object-cover">
            @else
            <span class="text-neutral-400">Chưa có ảnh</span>
            @endif

            {{-- Badge giảm giá (nếu có) --}}
            @if($product->sale_price && $product->sale_price < $product->regular_price)
                @php
                $discountPercentage = round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100);
                @endphp
                <span class="absolute top-2 right-2 rounded-md bg-red-600 text-white text-xs font-semibold px-2 py-1">
                    -{{ $discountPercentage }}%
                </span>
                @endif
        </div>
    </a>

    {{-- Nội dung --}}
    <div class="p-4">
        {{-- Category --}}
        @if($product->category)
        <p class="text-[12px] uppercase tracking-wide text-neutral-400 mb-1">
            {{ $product->category->name }}
        </p>
        @endif

        {{-- Tên sản phẩm --}}
        <a href="{{ route('products.show', $product->slug) }}">
            <h3 class="text-sm sm:text-base font-semibold text-neutral-100 mb-2 line-clamp-2 group-hover:text-indigo-400 transition-colors">
                {{ $product->name }}
            </h3>
        </a>

        {{-- Giá + Wishlist --}}
        <div class="flex items-center justify-between mb-2">
            @if($product->sale_price && $product->sale_price < $product->regular_price)
                <div class="flex flex-col">
                    <span class="text-lg font-bold text-red-500">
                        {{ number_format($product->sale_price, 0, ',', '.') }}₫
                    </span>
                    <span class="text-xs text-neutral-400 line-through">
                        {{ number_format($product->regular_price, 0, ',', '.') }}₫
                    </span>
                </div>
                @else
                <span class="text-lg font-bold text-indigo-400">
                    {{ number_format($product->regular_price, 0, ',', '.') }}₫
                </span>
                @endif

                {{-- Wishlist (Livewire) --}}
                <div class="shrink-0">
                    @livewire(
                    'frontend.wishlist-button',
                    ['productId' => $product->id],
                    key('card-wishlist-'.$product->id)
                    )
                </div>
        </div>

        {{-- Tồn kho --}}
        @if($product->stock_quantity > 0)
        <p class="text-sm text-emerald-400 mb-3">Còn {{ $product->stock_quantity }} sản phẩm</p>
        @else
        <p class="text-sm text-red-500 mb-3">Hết hàng</p>
        @endif

        {{-- Add to Cart --}}
        <div class="pt-1">
            @if($product->variants->isNotEmpty())
            {{-- Có variant: hiển thị gọn từng lựa chọn --}}
            <div class="space-y-2">
                @foreach($product->variants as $variant)
                <div class="flex justify-between items-center px-3 py-2 rounded-lg border border-neutral-700 bg-neutral-800">
                    <div class="text-xs sm:text-sm text-neutral-200">
                        @foreach($variant->options as $opt)
                        <span class="text-neutral-300">{{ $opt->attribute->name }}:</span> {{ $opt->value }}@if(!$loop->last), @endif
                        @endforeach
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-indigo-400">
                            {{ number_format($variant->specific_price, 0, ',', '.') }}₫
                        </span>
                        @livewire(
                        'frontend.product.add-to-cart-button',
                        ['product' => $product, 'variant' => $variant],
                        key('variant-card-cart-'.$variant->id)
                        )
                    </div>
                </div>
                @endforeach
            </div>
            @else
            {{-- Không có variant --}}
            @livewire(
            'frontend.product.add-to-cart-button',
            ['product' => $product],
            key('card-cart-'.$product->id)
            )
            @endif
        </div>
    </div>

    {{-- Quick action bar (ẩn/hiện khi hover, nền đen đặc) --}}
    <div class="pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity">
        <div class="absolute inset-x-0 top-0 p-3">
            <div class="rounded-lg bg-neutral-900 border border-neutral-800 shadow-lg">
                <div class="px-3 py-2 text-[12px] text-neutral-300">
                    Nhấn để xem chi tiết • Thêm vào giỏ • Yêu thích
                </div>
            </div>
        </div>
    </div>
</div>