<li>
    <h4>@if (isset($location->name)) {{ $location->name }} @endif</h4>
    <dl class="dl-horizontal">
        <dt style="font-weight: bold;">{{ $location->locatable_type }}</dt>
        <dd>{{ $location->locatable_id }}</dd>
    </dl>

    @if (isset($locations[$location->id]))
        @include ('locations.list', ['collection' => $locations[$location->id]])
    @endif
</li>
