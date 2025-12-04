@extends('layouts.app')

@section('title', 'Tin Tức & Blog')

@push('styles')
<style>
    /* Card tối, nền đặc */
    .card-dark {
        background-color: #0f172a;
        border: 1px solid #1f2937;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .35);
    }

    .chip {
        background-color: #111827;
        border: 1px solid #1f2937;
    }

    .chip-active {
        background-color: #1f2937;
        border: 1px solid #334155;
        color: #e5e7eb;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .prose-dark p,
    .prose-dark li,
    .prose-dark {
        color: #cbd5e1;
    }

    .btn-indigo {
        background-color: #4f46e5;
        color: #fff;
    }

    .btn-indigo:hover {
        background-color: #6366f1;
    }

    .input-dark {
        background: #0b1220;
        border: 1px solid #334155;
        color: #e5e7eb;
    }

    .input-dark::placeholder {
        color: #94a3b8;
    }

    .link {
        color: #e5e7eb;
    }

    .link:hover {
        color: #a5b4fc;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-12 text-slate-200">
    <h1 class="text-4xl md:text-5xl font-extrabold text-center mb-10">
        Tin Tức & Bài Viết
    </h1>

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Blog Posts -->
        <main class="w-full md:w-2/3 lg:w-3/4 space-y-8">
            @forelse($posts as $post)
            <article class="card-dark rounded-2xl overflow-hidden">
                @if($post->featured_image)
                <a href="{{ route('blog.show', $post->slug) }}" class="block group">
                    <div class="relative aspect-[16/9] bg-black">
                        <img
                            src="{{ cloudinary_url($post->featured_image) }}"
                            alt="{{ $post->title }}"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-[1.02]">
                        @if($post->categories->isNotEmpty())
                        <div class="absolute left-4 top-4 flex flex-wrap gap-2">
                            @foreach($post->categories->take(3) as $cat)
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full chip">
                                {{ $cat->name }}
                            </span>
                            @endforeach
                            @if($post->categories->count() > 3)
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full chip">+{{ $post->categories->count() - 3 }}</span>
                            @endif
                        </div>
                        @endif
                    </div>
                </a>
                @endif

                <div class="p-6 md:p-7">
                    <h2 class="text-2xl font-bold leading-snug mb-2">
                        <a href="{{ route('blog.show', $post->slug) }}" class="link">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <div class="text-sm text-slate-400 mb-4 flex flex-wrap gap-x-2 gap-y-1">
                        <span>Đăng bởi <span class="text-slate-200 font-medium">{{ $post->author->name }}</span></span>
                        <span>•</span>
                        <span>{{ $post->published_at ? $post->published_at->format('d/m/Y') : $post->created_at->format('d/m/Y') }}</span>
                    </div>

                    <div class="prose-dark text-slate-300 leading-relaxed line-clamp-3">
                        {!! Str::limit(strip_tags($post->excerpt ?: $post->content), 280) !!}
                    </div>

                    <div class="mt-5">
                        <a href="{{ route('blog.show', $post->slug) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl btn-indigo font-semibold">
                            Đọc thêm
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <div class="card-dark rounded-2xl p-12 text-center">
                <p class="text-slate-400">Không tìm thấy bài viết nào.</p>
            </div>
            @endforelse

            <div class="mt-8">
                {{ $posts->links() }}
            </div>
        </main>

        <!-- Blog Sidebar -->
        <aside class="w-full md:w-1/3 lg:w-1/4">
            <div class="card-dark rounded-2xl p-6 md:sticky md:top-8">
                <h3 class="text-xl font-semibold mb-4">Tìm kiếm</h3>
                <form action="{{ route('blog.index') }}" method="GET" class="space-y-2">
                    <input
                        type="text"
                        name="search"
                        placeholder="Tìm bài viết..."
                        value="{{ request('search') }}"
                        class="w-full px-3 py-2 rounded-xl input-dark focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <button type="submit"
                        class="w-full px-4 py-2 rounded-xl btn-indigo font-semibold">
                        Tìm
                    </button>
                </form>

                <h3 class="text-xl font-semibold mt-8 mb-4">Danh mục</h3>
                @if($categories->isNotEmpty())
                <ul class="flex flex-wrap gap-2">
                    <li class="mt-2">
                        <a href="{{ route('blog.index') }}"
                            class="px-3 py-1.5 rounded-full text-sm
                                      {{ !request('category') ? 'chip-active' : 'chip' }}">
                            Tất cả
                        </a>
                    </li>
                    @foreach($categories as $category)
                    <li class="mt-2">
                        <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                            class="px-3 py-1.5 rounded-full text-sm
                                          {{ request('category') == $category->slug ? 'chip-active' : 'chip' }}">
                            {{ $category->name }} ({{ $category->posts_count }})
                        </a>
                    </li>
                    @endforeach
                </ul>
                @else
                <p class="text-sm text-slate-400">Không có danh mục nào.</p>
                @endif

                {{-- Có thể thêm: Bài viết mới, Thẻ (tags), Bài nổi bật... --}}
            </div>
        </aside>
    </div>
</div>
@endsection