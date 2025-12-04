{{-- resources/views/frontend/blog/show.blade.php --}}
@extends('layouts.app')

@section('title', $post->title)

@push('styles')
<style>
    .card-dark {
        background-color: #0f172a;
        border: 1px solid #1f2937;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .35);
    }

    .chip {
        background-color: #111827;
        border: 1px solid #1f2937;
        color: #e5e7eb;
    }

    .chip a {
        color: #c7d2fe;
    }

    .chip a:hover {
        color: #a5b4fc;
        text-decoration: underline;
    }

    .link {
        color: #e5e7eb;
    }

    .link:hover {
        color: #a5b4fc;
    }

    .muted {
        color: #94a3b8;
    }

    .input-dark {
        background: #0b1220;
        border: 1px solid #334155;
        color: #e5e7eb;
    }

    .input-dark::placeholder {
        color: #94a3b8;
    }

    .btn-indigo {
        background: #4f46e5;
        color: #fff;
    }

    .btn-indigo:hover {
        background: #6366f1;
    }

    .prose-dark {
        color: #cbd5e1;
    }

    .prose-dark h1,
    .prose-dark h2,
    .prose-dark h3 {
        color: #e5e7eb;
    }

    .prose-dark a {
        color: #a5b4fc;
    }

    .prose-dark a:hover {
        color: #c7d2fe;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-12 text-slate-200">
    <div class="max-w-4xl mx-auto space-y-10">
        {{-- BREADCRUMB --}}
        <nav class="text-sm muted">
            <a href="{{ route('blog.index') }}" class="link">Blog</a>
            <span class="mx-2">/</span>
            @if($post->categories->isNotEmpty())
            <a href="{{ route('blog.index', ['category' => $post->categories->first()->slug]) }}" class="link">
                {{ $post->categories->first()->name }}
            </a>
            <span class="mx-2">/</span>
            @endif
            <span class="text-slate-400">{{ Str::limit($post->title, 60) }}</span>
        </nav>

        <article class="card-dark rounded-2xl overflow-hidden">
            @if($post->featured_image)
            <div class="relative bg-black">
                <img
                    src="{{ cloudinary_url($post->featured_image) }}"
                    alt="{{ $post->title }}"
                    class="w-full h-auto max-h-[520px] object-cover">
                @if($post->categories->isNotEmpty())
                <div class="absolute left-4 top-4 flex flex-wrap gap-2">
                    @foreach($post->categories->take(3) as $cat)
                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full chip">
                        <a href="{{ route('blog.index', ['category' => $cat->slug]) }}">{{ $cat->name }}</a>
                    </span>
                    @endforeach
                    @if($post->categories->count() > 3)
                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full chip">+{{ $post->categories->count()-3 }}</span>
                    @endif
                </div>
                @endif
            </div>
            @endif

            <div class="p-6 md:p-8">
                <h1 class="text-3xl md:text-4xl font-extrabold leading-tight mb-3 text-slate-50">
                    {{ $post->title }}
                </h1>

                <div class="text-sm muted mb-6 flex flex-wrap items-center gap-2 border-b border-slate-700 pb-4">
                    <span>Đăng bởi <span class="text-slate-200 font-medium">{{ $post->author->name }}</span></span>
                    <span>•</span>
                    <span>{{ $post->published_at ? $post->published_at->format('d F, Y') : $post->created_at->format('d F, Y') }}</span>
                    @if($post->categories->isNotEmpty())
                    <span>•</span>
                    <span>Chuyên mục:
                        @foreach($post->categories as $category)
                        <a href="{{ route('blog.index', ['category' => $category->slug]) }}" class="link">
                            {{ $category->name }}
                        </a>@if(!$loop->last), @endif
                        @endforeach
                    </span>
                    @endif
                </div>

                <div class="prose prose-invert prose-lg max-w-none prose-dark">
                    {!! $post->content !!}
                </div>

                {{-- Author Bio --}}
                <div class="mt-10 pt-6 border-t border-slate-700 flex items-center">
                    @if($post->author->avatar)
                    <img
                        src="{{ cloudinary_url($post->author->avatar) }}"
                        alt="{{ $post->author->name }}"
                        class="w-16 h-16 rounded-full mr-4 object-cover">
                    @else
                    <span class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-slate-200 text-slate-800 mr-4 text-xl">
                        {{ strtoupper(substr($post->author->name, 0, 1)) }}
                    </span>
                    @endif
                    <div>
                        <p class="font-semibold text-slate-100">{{ $post->author->name }}</p>
                        <p class="text-sm muted">Thông tin thêm về tác giả...</p>
                    </div>
                </div>

                {{-- Social Share Buttons --}}
                <div class="mt-8 pt-6 border-t border-slate-700">
                    <h3 class="text-md font-semibold mb-3 text-slate-100">Chia sẻ bài viết này:</h3>
                    <div class="flex flex-wrap gap-2">
                        <a
                            href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                            target="_blank"
                            class="px-3 py-2 rounded-xl bg-[#1877f2] text-white text-sm font-semibold hover:opacity-90">
                            Facebook
                        </a>
                        <a
                            href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}"
                            target="_blank"
                            class="px-3 py-2 rounded-xl bg-[#1d9bf0] text-white text-sm font-semibold hover:opacity-90">
                            Twitter/X
                        </a>
                        <a
                            href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($post->title) }}"
                            target="_blank"
                            class="px-3 py-2 rounded-xl bg-[#0a66c2] text-white text-sm font-semibold hover:opacity-90">
                            LinkedIn
                        </a>
                    </div>
                </div>
            </div>
        </article>

        {{-- Related Posts --}}
        @if($relatedPosts->isNotEmpty())
        <section class="space-y-4">
            <h2 class="text-2xl font-semibold">Bài viết liên quan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($relatedPosts as $relatedPost)
                <div class="card-dark rounded-2xl overflow-hidden">
                    @if($relatedPost->featured_image)
                    <a href="{{ route('blog.show', $relatedPost->slug) }}" class="block group">
                        <div class="relative aspect-[16/10] bg-black">
                            <img
                                src="{{ cloudinary_url($relatedPost->featured_image) }}"
                                alt="{{ $relatedPost->title }}"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-[1.02]">
                        </div>
                    </a>
                    @endif
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-1">
                            <a href="{{ route('blog.show', $relatedPost->slug) }}" class="link">
                                {{ $relatedPost->title }}
                            </a>
                        </h3>
                        <p class="text-xs muted mb-2">
                            {{ $relatedPost->published_at ? $relatedPost->published_at->format('d/m/Y') : '' }}
                        </p>
                        <p class="text-sm text-slate-300 leading-snug line-clamp-3">
                            {{ Str::limit(strip_tags($relatedPost->excerpt ?: $relatedPost->content), 140) }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        @endif

        {{-- Comments Section --}}
        <section class="space-y-4" id="comments">
            <h2 class="text-2xl font-semibold">Bình luận</h2>
            <div class="card-dark rounded-2xl p-6 text-center">
                <p class="muted">Hệ thống bình luận sẽ được tích hợp ở đây.</p>
            </div>
        </section>
    </div>
</div>
@endsection