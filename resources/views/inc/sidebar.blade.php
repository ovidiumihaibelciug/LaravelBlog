<div class="well">
    <h3>Tags</h3>
    <ul>
        @foreach($tags as $tag)
            <li>
                <a href="/posts/tags/{{ $tag }}"> {{ $tag }} </a>
            </li>
        @endforeach
    </ul>
</div>

<div class="well">
    <h3>Archives</h3>
    <ul>
        @foreach($archives as $stats)
            <li>
                <a href="/posts?month={{ $stats['month'] }}&year={{ $stats['year'] }}"> {{ $stats['month'] . ' ' . $stats['year'] }} </a>
            </li>
        @endforeach
    </ul>
</div>

