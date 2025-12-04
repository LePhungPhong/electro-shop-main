{{-- resources/views/livewire/frontend/product/product-list.blade.php --}}
<div class="flex flex-col md:flex-row gap-6">
    {{-- SIDEBAR FILTERS (dark, solid) --}}
    <aside class="w-full md:w-1/4 lg:w-1/5">
        <div class="rounded-2xl border border-neutral-800 bg-neutral-900 p-4 md:p-5 shadow-2xl space-y-6">
            <h3 class="text-lg font-semibold text-white">Bộ lọc</h3>

            {{-- 1) Search --}}
            <div>
                <label for="searchQuery" class="text-sm font-medium text-neutral-300">Tìm kiếm</label>
                <input
                    type="text"
                    id="searchQuery"
                    wire:model.debounce.500ms="searchQuery"
                    placeholder="Từ khóa…"
                    class="mt-1 w-full h-10 rounded-xl px-3
                           bg-neutral-900 text-neutral-100 placeholder-neutral-500
                           border border-neutral-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            {{-- 2) Danh mục con (nếu có) --}}
            @if($categorySlug)
            @php
            $currentCategory = \App\Models\Category::where('slug', $categorySlug)->with('children')->first();
            @endphp
            @if($currentCategory && $currentCategory->children->isNotEmpty())
            <div>
                <p class="text-sm font-medium text-neutral-300 mb-2">Danh mục con</p>
                <ul class="space-y-1.5 max-h-40 overflow-y-auto pr-1 filter-scroll-dark">
                    @foreach($currentCategory->children as $sub)
                    <li class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            wire:model="categoryIds"
                            value="{{ $sub->id }}"
                            id="subcat-{{ $sub->id }}"
                            class="h-4 w-4 rounded border-neutral-600 bg-neutral-900
                                               accent-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0">
                        <label for="subcat-{{ $sub->id }}" class="text-sm text-neutral-200 hover:text-white">
                            {{ $sub->name }}
                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            @endif

            {{-- 3) Thương hiệu --}}
            @if($brandsForFilter->isNotEmpty())
            <div>
                <p class="text-sm font-medium text-neutral-300 mb-2">Thương hiệu</p>
                <ul class="space-y-1.5 max-h-32 overflow-y-auto pr-1 filter-scroll-dark">
                    @foreach($brandsForFilter as $brand)
                    <li class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            wire:model="brandSlugs"
                            value="{{ $brand->slug }}"
                            id="brand-{{ $brand->slug }}"
                            class="h-4 w-4 rounded border-neutral-600 bg-neutral-900
                                           accent-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0">
                        <label for="brand-{{ $brand->slug }}" class="text-sm text-neutral-200 hover:text-white">
                            {{ $brand->name }}
                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- 4) Khoảng giá --}}
            <div>
                <p class="text-sm font-medium text-neutral-300 mb-2">Giá (₫)</p>
                <div class="flex items-center gap-2">
                    <input
                        type="number"
                        wire:model.defer="priceRange.min"
                        min="{{ $priceRangeAll['min'] }}"
                        max="{{ $priceRangeAll['max'] }}"
                        placeholder="{{ number_format($priceRangeAll['min']) }}"
                        class="w-1/2 h-10 rounded-xl px-3
                               bg-neutral-900 text-neutral-100 placeholder-neutral-500
                               border border-neutral-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <span class="text-neutral-500">–</span>
                    <input
                        type="number"
                        wire:model.defer="priceRange.max"
                        min="{{ $priceRangeAll['min'] }}"
                        max="{{ $priceRangeAll['max'] }}"
                        placeholder="{{ number_format($priceRangeAll['max']) }}"
                        class="w-1/2 h-10 rounded-xl px-3
                               bg-neutral-900 text-neutral-100 placeholder-neutral-500
                               border border-neutral-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <p class="mt-1 text-xs text-neutral-400">
                    Khoảng: {{ number_format($priceRangeAll['min']) }}₫ – {{ number_format($priceRangeAll['max']) }}₫
                </p>
            </div>

            {{-- 5) Thuộc tính động --}}
            @if($attributesForFilter->isNotEmpty())
            @foreach($attributesForFilter as $attribute)
            @if($attribute->values->isNotEmpty())
            <div>
                <p class="text-sm font-medium text-neutral-300 mb-2">{{ $attribute->name }}</p>
                <ul class="space-y-1.5 max-h-32 overflow-y-auto pr-1 filter-scroll-dark">
                    @foreach($attribute->values as $val)
                    <li class="flex items-center gap-2">
                        <input
                            type="checkbox"
                            wire:model="selectedAttributes.{{ $attribute->slug }}"
                            value="{{ $val->slug }}"
                            id="attr-{{ $attribute->slug }}-{{ $val->slug }}"
                            class="h-4 w-4 rounded border-neutral-600 bg-neutral-900
                                                   accent-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0">
                        <label for="attr-{{ $attribute->slug }}-{{ $val->slug }}" class="text-sm text-neutral-200 hover:text-white">
                            {{ $val->name }}
                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            @endforeach
            @endif

            {{-- 6) Actions --}}
            <div class="grid grid-cols-2 gap-2 pt-2">
                <button
                    wire:click.prevent="applyFilter"
                    wire:loading.attr="disabled"
                    wire:target="applyFilter"
                    class="inline-flex items-center justify-center h-10 rounded-xl
                           bg-indigo-600 text-white text-sm font-semibold
                           hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500
                           disabled:opacity-60 disabled:cursor-not-allowed transition">
                    <span wire:loading.remove wire:target="applyFilter">Áp dụng</span>
                    <span wire:loading wire:target="applyFilter" class="inline-flex items-center gap-2">
                        <svg class="w-4 h-4 animate-spin" viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="12" cy="12" r="10" stroke="#93c5fd" stroke-width="4" fill="none" opacity="0.35" />
                            <path d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" fill="#60a5fa" />
                        </svg>
                        Đang lọc…
                    </span>
                </button>

                <button
                    wire:click.prevent="resetFilters"
                    class="inline-flex items-center justify-center h-10 rounded-xl
                           bg-neutral-800 border border-neutral-700 text-neutral-200 text-sm font-medium
                           hover:border-indigo-600 hover:text-white transition">
                    Đặt lại
                </button>
            </div>
        </div>
    </aside>

    {{-- MAIN (title + sort + grid) --}}
    <main class="w-full md:w-3/4 lg:w-4/5">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <div class="w-full sm:w-auto">
                @if($categorySlug)
                @php $cat = \App\Models\Category::where('slug', $categorySlug)->first(); @endphp
                <h1 class="text-2xl md:text-3xl font-bold text-white">{{ $cat->name }}</h1>
                @else
                <h1 class="text-2xl md:text-3xl font-bold text-white">Tất Cả Sản Phẩm</h1>
                @endif
            </div>

            {{-- Sort --}}
            <div class="w-full sm:w-auto inline-flex items-center gap-2">
                <label for="sortBy" class="text-sm font-medium text-neutral-300">Sắp xếp</label>
                <select
                    id="sortBy"
                    wire:model="sortBy"
                    class="h-10 rounded-xl px-3 text-sm
                           bg-neutral-900 border border-neutral-700 text-neutral-200
                           focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="created_at">Mới nhất</option>
                    <option value="regular_price">Giá: Thấp → Cao</option>
                    <option value="-regular_price">Giá: Cao → Thấp</option>
                </select>
            </div>
        </div>

        {{-- Grid sản phẩm --}}
        @if($products->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
            @include('frontend.partials.product-card', ['product' => $product])
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $products->links() }}
        </div>
        @else
        <div class="text-center py-20 rounded-2xl border border-neutral-800 bg-neutral-900">
            <p class="text-neutral-400">Không tìm thấy sản phẩm nào.</p>
        </div>
        @endif
    </main>
</div>

@push('styles')
<style>
    /* Scrollbar tối đồng bộ */
    .filter-scroll-dark::-webkit-scrollbar {
        width: 8px;
        height: 8px
    }

    .filter-scroll-dark::-webkit-scrollbar-track {
        background: #0b0f19;
        border-radius: 8px
    }

    .filter-scroll-dark::-webkit-scrollbar-thumb {
        background: #3f3f46;
        border-radius: 8px
    }

    .filter-scroll-dark::-webkit-scrollbar-thumb:hover {
        background: #52525b
    }
</style>
@endpush