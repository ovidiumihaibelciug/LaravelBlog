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