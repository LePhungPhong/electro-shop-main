<footer class="bg-black text-neutral-300">
    <div class="container mx-auto px-4 pt-12 pb-8">
        {{-- Top: 4 cột nội dung --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-10">
            {{-- About --}}
            <div>
                <h5 class="text-base font-semibold text-white mb-4">Về ElectroShop</h5>
                <p class="text-sm leading-relaxed text-neutral-400">
                    ElectroShop là điểm đến tin cậy cho mọi nhu cầu về đồ điện tử,
                    mang đến sản phẩm chất lượng và dịch vụ tận tâm.
                </p>

                <div class="mt-5 flex items-center gap-3">
                    <a href="#"
                        class="inline-flex items-center justify-center w-9 h-9 rounded-md bg-neutral-900 border border-neutral-800 hover:border-indigo-600 hover:text-white transition"
                        aria-label="Facebook">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M22 12A10 10 0 1 0 10 21.95V14H7.5v-3H10V8.75C10 6.3 11.57 5 13.75 5c.9 0 1.86.16 1.86.16v2.5h-1.05c-1.04 0-1.36.65-1.36 1.31V11h2.32l-.37 3h-1.95v7A10 10 0 0 0 22 12Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#"
                        class="inline-flex items-center justify-center w-9 h-9 rounded-md bg-neutral-900 border border-neutral-800 hover:border-indigo-600 hover:text-white transition"
                        aria-label="Twitter">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.177-.005-.353-.013-.528A8.35 8.35 0 0 0 22 5.92a8.2 8.2 0 0 1-2.357.646 4.12 4.12 0 0 0 1.804-2.27 8.22 8.22 0 0 1-2.605.996 4.11 4.11 0 0 0-6.993 3.743A11.65 11.65 0 0 1 3.8 4.748a4.11 4.11 0 0 0 1.27 5.477 4.08 4.08 0 0 1-1.86-.514v.052a4.11 4.11 0 0 0 3.292 4.022 4.1 4.1 0 0 1-1.853.07 4.11 4.11 0 0 0 3.834 2.85A8.23 8.23 0 0 1 2 18.407a11.62 11.62 0 0 0 6.29 1.844" />
                        </svg>
                    </a>
                    <a href="#"
                        class="inline-flex items-center justify-center w-9 h-9 rounded-md bg-neutral-900 border border-neutral-800 hover:border-indigo-600 hover:text-white transition"
                        aria-label="Instagram">
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5Zm5 5.333a4.667 4.667 0 1 0 0 9.334 4.667 4.667 0 0 0 0-9.334Zm0 1.8a2.867 2.867 0 1 1 0 5.734 2.867 2.867 0 0 1 0-5.734Zm5.2-.866a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h5 class="text-base font-semibold text-white mb-4">Liên Kết Nhanh</h5>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-white transition">Về Chúng Tôi</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition">Liên Hệ</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-white transition">FAQ</a></li>
                    <li><a href="{{ route('blog.index') }}" class="hover:text-white transition">Blog</a></li>
                    <li><a href="#" class="hover:text-white transition">Chính Sách Bảo Hành</a></li>
                    <li><a href="#" class="hover:text-white transition">Điều Khoản Dịch Vụ</a></li>
                </ul>
            </div>

            {{-- Customer Service --}}
            <div>
                <h5 class="text-base font-semibold text-white mb-4">Chăm Sóc Khách Hàng</h5>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-white transition">Hướng Dẫn Mua Hàng</a></li>
                    <li><a href="#" class="hover:text-white transition">Chính Sách Đổi Trả</a></li>
                    <li><a href="#" class="hover:text-white transition">Theo Dõi Đơn Hàng</a></li>
                    <li><a href="{{ route('account.dashboard') }}" class="hover:text-white transition">Tài Khoản Của Tôi</a></li>
                </ul>
            </div>

            {{-- Newsletter --}}
            <div>
                <h5 class="text-base font-semibold text-white mb-4">Đăng Ký Nhận Tin</h5>
                <p class="text-sm text-neutral-400 mb-3">
                    Nhận thông tin về sản phẩm mới và khuyến mãi đặc biệt.
                </p>
                <form action="#" method="POST" class="mt-2">
                    @csrf
                    <div class="flex rounded-lg overflow-hidden border border-neutral-800 bg-neutral-900">
                        <input type="email" name="email" required
                            placeholder="Địa chỉ email của bạn"
                            class="w-full px-3 py-2 text-sm bg-neutral-900 placeholder-neutral-500 focus:outline-none">
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold">
                            Đăng Ký
                        </button>
                    </div>
                    {{-- thông báo nhỏ (tuỳ chọn) --}}
                    {{-- <p class="mt-2 text-xs text-neutral-500">Bạn có thể hủy đăng ký bất cứ lúc nào.</p> --}}
                </form>
            </div>
        </div>

        {{-- Middle: badge tin cậy / phương thức thanh toán (tuỳ chọn) --}}
        <div class="border-t border-neutral-800 pt-6 pb-2">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-md bg-neutral-900 border border-neutral-800 flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-400" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2 1 7l11 5 9-4.09V17h2V7L12 2Z" />
                            <path d="m1 9 11 5 9-4.09V13l-9 4L1 12V9Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-medium">Hàng chính hãng</p>
                        <p class="text-neutral-400 text-xs">Bảo hành chính hãng theo từng sản phẩm</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-md bg-neutral-900 border border-neutral-800 flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-400" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 1a9 9 0 1 0 9 9A9.01 9.01 0 0 0 12 1Zm1 14h-2v-2h2Zm0-4h-2V6h2Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-medium">Đổi trả 7 ngày</p>
                        <p class="text-neutral-400 text-xs">Hỗ trợ đổi trả theo chính sách cửa hàng</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-md bg-neutral-900 border border-neutral-800 flex items-center justify-center">
                        <svg class="w-5 h-5 text-indigo-400" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M2 7a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v3H2ZM2 12h20v5a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-white font-medium">Thanh toán an toàn</p>
                        <p class="text-neutral-400 text-xs">Hỗ trợ nhiều phương thức thanh toán</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom: bản quyền --}}
        <div class="border-t border-neutral-800 pt-6 text-center text-sm">
            <p class="text-neutral-400">
                © {{ date('Y') }} {{ config('app.name', 'ElectroShop') }}. Bảo lưu mọi quyền.
            </p>
            <p class="mt-1 text-neutral-500">
                Thiết kế & phát triển bởi <span class="text-neutral-300">[Tên của bạn/Công ty bạn]</span>
            </p>
        </div>
    </div>
</footer>