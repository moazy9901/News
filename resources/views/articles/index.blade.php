@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">

    <!-- Top Header -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">News Dashboard</h1>
                <p class="text-gray-500 mt-1">Manage and explore latest fetched articles</p>
            </div>

            <form action="{{ route('articles.fetch') }}" method="POST" class="mt-4 md:mt-0">
                @csrf
                <button 
                    type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl shadow-lg transition duration-300"
                >
                    Fetch Latest News
                </button>
            </form>
        </div>
    </div>

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-6 py-10">

        <!-- Success Alert -->
        @if(session('success'))
            <div class="mb-8 bg-green-100 border border-green-300 text-green-700 px-5 py-3 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($articles as $article)

                <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden flex flex-col">

                    <!-- Image Section -->
                <div class="relative h-56 w-full overflow-hidden bg-gray-200">
                    @if($article->image)
                        <img 
                            src="{{ $article->image }}"
                            alt="{{ $article->title }}"
                            loading="lazy"
                            class="w-full h-full object-cover transition duration-500 hover:scale-105"
                        >
                    @else
                        <!-- Placeholder Image -->
                        <div class="flex items-center justify-center h-full text-gray-400 text-sm">
                            No Image Available
                        </div>
                    @endif

                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                    <!-- Source Badge -->
                    <span class="absolute bottom-3 left-3 bg-white/90 text-gray-800 text-xs font-medium px-3 py-1 rounded-full shadow">
                        {{ $article->name ?? 'News Source' }}
                    </span>
                </div>


                    <!-- Content -->
                    <div class="p-6 flex flex-col flex-grow">

                        <!-- Title -->
                        <h2 class="text-lg font-semibold text-gray-800 mb-3 leading-snug line-clamp-2">
                            {{ $article->title }}
                        </h2>

                        <!-- Meta -->
                        <div class="text-sm text-gray-500 mb-3 space-y-1">
                            <p><span class="font-medium text-gray-600">Author:</span> {{ $article->author ?? 'Unknown' }}</p>
                            <p><span class="font-medium text-gray-600">Published:</span> 
                                {{ optional($article->published_at)->format('M d, Y H:i') }}
                            </p>
                        </div>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ $article->description }}
                        </p>

                        <!-- Content Preview -->
                        <p class="text-gray-500 text-xs mb-4 line-clamp-3">
                            {{ $article->content }}
                        </p>

                        <!-- Buttons -->
                        <div class="mt-auto flex items-center justify-between pt-4 border-t">
                            <a 
                                href="{{ $article->url }}" 
                                target="_blank"
                                class="text-indigo-600 hover:text-indigo-800 text-sm font-medium transition"
                            >
                                Read Full Article →
                            </a>

                            <span class="text-xs text-gray-400">
                                ID: {{ $article->id }}
                            </span>
                        </div>

                    </div>
                </div>

            @empty
                <div class="col-span-3 text-center py-20">
                    <h2 class="text-xl font-semibold text-gray-600 mb-2">No Articles Found</h2>
                    <p class="text-gray-400">Click "Fetch Latest News" to start importing data.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $articles->links() }}
        </div>

    </div>
</div>
@endsection
