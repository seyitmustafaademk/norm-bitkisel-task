<div class="sidebar">
    <div class="sidebar__item">
        <h4>Kategoriler</h4>
        <ul>
            <li><a href="{{ route('front.homepage') }}">Hepsini Göster</a></li>
            @foreach($categories as $category)
                <li><a href="{{ route('front.homepage', $category->slug) }}" data-id="{{ $category->id }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
