@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bitcoin News</h1>
    <div class="list-group">
        @foreach($news as $item)
            <a href="{{ $item->url }}" target="_blank" class="list-group-item list-group-item-action">
                <h5>{{ $item->title }}</h5>
                <p>{{ $item->description }}</p>
                <small>Source: {{ $item->source_name }} | {{ $item->published_at }}</small>
            </a>
        @endforeach
    </div>
    <div class="mt-3">{{ $news->links() }}</div>
</div>
@endsection
