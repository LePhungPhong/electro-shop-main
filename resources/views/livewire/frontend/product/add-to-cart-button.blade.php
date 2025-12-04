<div class="flex items-center gap-3">
    @if(!$variantId)
    {{-- Quantity control (màu cố định) --}}
    <div class="inline-flex items-center rounded-xl border border-neutral-700 bg-neutral-900">
        <button
            type="button"
            aria-label="Giảm số lượng"
            wire:click="$set('quantity', {{ max(1, $quantity - 1) }})"
            @if($quantity <=1) disabled @endif
            class="w-10 h-10 grid place-items-center rounded-l-xl text-neutral-200 hover:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed">
            {{-- icon trừ: màu xám nhạt cố định --}}
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="#e5e7eb" aria-hidden="true">
                <rect x="5" y="11" width="14" height="2" rx="1" ry="1"></rect>
            </svg>
        </button>

        <input
            type="text"
            inputmode="numeric"
            min="1"
            step="1"
            wire:model.lazy="quantity"
            class="w-14 text-center text-neutral-100 bg-neutral-900 focus:outline-none" />

        <button
            type="button"
            aria-label="Tăng số lượng"
            wire:click="$set('quantity', {{ $quantity + 1 }})"
            class="w-10 h-10 grid place-items-center rounded-r-xl text-neutral-200 hover:bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            {{-- icon cộng: màu xám nhạt cố định --}}
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="#e5e7eb" aria-hidden="true">
                <rect x="11" y="5" width="2" height="14" rx="1" ry="1"></rect>
                <rect x="5" y="11" width="14" height="2" rx="1" ry="1"></rect>
            </svg>
        </button>
    </div>
    @endif

    {{-- Add to cart (màu cố định, có loading) --}}
    <button
        type="button"
        wire:click="addToCart"
        wire:loading.attr="disabled"
        wire:target="addToCart"
        class="flex-1 inline-flex items-center justify-center gap-2 px-5 h-12 rounded-xl
               bg-indigo-600 text-white font-semibold
               hover:bg-indigo-500
               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-black
               disabled:opacity-60 disabled:cursor-not-allowed transition">
        {{-- Normal state --}}
        <span class="inline-flex items-center gap-2" wire:loading.remove wire:target="addToCart">
            {{-- icon cart: stroke trắng cố định --}}
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="#ffffff" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-2.3 2.3c-.63.63-.18 1.7.7 1.7H17m0 0a2 2 0 100 4 2 2 0 000-4m-8 2a2 2 0 11-4 0 2 2 0 014 0" />
            </svg>
        </span>

        {{-- Loading state --}}
        <span class="inline-flex items-center gap-2" wire:loading wire:target="addToCart">
            {{-- spinner: stroke indigo-300, fill indigo-500 cố định --}}
            <svg class="w-5 h-5 animate-spin" viewBox="0 0 24 24" aria-hidden="true">
                <circle cx="12" cy="12" r="10" stroke="#93c5fd" stroke-width="4" fill="none" opacity="0.35" />
                <path d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" fill="#60a5fa" />
            </svg>
        </span>
    </button>
</div>