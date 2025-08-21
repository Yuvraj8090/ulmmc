<div class="news-bar">
    <div class="news-label">Latest News</div>
    <div class="news-marquee">
        <span>
            @foreach($allNews as $news)
                🚨 <a href="{{ route('news.show', $news->slug) }}" class="text-decoration-none text-white">
                    {{ $news->title }}
                </a> •
            @endforeach
        </span>
    </div>
</div>
