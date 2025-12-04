<div class="rounded-2xl border border-neutral-800 bg-neutral-900 p-4 md:p-5 shadow-2xl space-y-6">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-semibold text-white">Bộ lọc</h3>
        <button
            wire:click.prevent="resetFilters"
            class="text-xs md:text-sm px-3 h-9 rounded-xl
                   bg-neutral-800 border border-neutral-700 text-neutral-200
                   hover:border-indigo-600 hover:text-white transition">
            Đặt lại
        </button>
    </div>

    {{-- 1) Danh mục con --}}
    @if($subcategoryList->isNotEmpty())
    <div>
        <h4 class="text-sm font-medium text-neutral-300 mb-2">Danh mục con</h4>
        <ul class="space-y-1.5 max-h-40 overflow-y-auto pr-1 filter-scroll-dark">
            @foreach($subcategoryList as $sub)
            <li class="flex items-center gap-2">
                <input
                    type="checkbox"
                    wire:model="selectedSubcategories"
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

    {{-- 2) Thương hiệu --}}
    @if($brandList->isNotEmpty())
    <div>
        <h4 class="text-sm font-medium text-neutral-300 mb-2">Thương hiệu</h4>
        <ul class="space-y-1.5 max-h-32 overflow-y-auto pr-1 filter-scroll-dark">
            @foreach($brandList as $brand)
            <li class="flex items-center gap-2">
                <input
                    type="checkbox"
                    wire:model="selectedBrands"
                    value="{{ $brand->id }}"
                    id="brand-{{ $brand->id }}"
                    class="h-4 w-4 rounded border-neutral-600 bg-neutral-900
                                   accent-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-0">
                <label for="brand-{{ $brand->id }}" class="text-sm text-neutral-200 hover:text-white">
                    {{ $brand->name }}
                </label>
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- 3) Khoảng giá --}}
    <div>
        <h4 class="text-sm font-medium text-neutral-300 mb-2">Giá (₫)</h4>
        <div class="flex items-center gap-2">
            <div class="relative w-1/2">
                <input
                    type="number"
                    wire:model="minPrice"
                    min="{{ $priceRange['min'] }}"
                    max="{{ $priceRange['max'] }}"
                    placeholder="Thấp nhất"
                    class="w-full h-10 rounded-xl px-3 bg-neutral-900 text-neutral-100 placeholder-neutral-500
                           border border-neutral-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <span class="text-neutral-500">–</span>
            <div class="relative w-1/2">
                <input
                    type="number"
                    wire:model="maxPrice"
                    min="{{ $priceRange['min'] }}"
                    max="{{ $priceRange['max'] }}"
                    placeholder="Cao nhất"
                    class="w-full h-10 rounded-xl px-3 bg-neutral-900 text-neutral-100 placeholder-neutral-500
                           border border-neutral-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>
        <p class="mt-1 text-xs text-neutral-400">
            Khoảng: {{ number_format($priceRange['min']) }}₫ – {{ number_format($priceRange['max']) }}₫
        </p>
    </div>

    {{-- 4) Actions --}}
    <div class="grid grid-cols-2 gap-2">
        <button
            wire:click.prevent="applyFilters"
            wire:loading.attr="disabled"
            wire:target="applyFilters"
            class="inline-flex items-center justify-center gap-2 h-10 rounded-xl
                   bg-indigo-600 text-white text-sm font-semibold
                   hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500
                   disabled:opacity-60 disabled:cursor-not-allowed transition">
            <span wire:loading.remove wire:target="applyFilters">Áp dụng</span>
            <span wire:loading wire:target="applyFilters" class="inline-flex items-center gap-2">
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