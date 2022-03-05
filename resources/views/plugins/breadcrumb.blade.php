<nav aria-label="breadcrumb" class="custom-breadcrumb">
    <ol class="breadcrumb">
        @if (count($breadcrumbs) == 1)
            <li class="breadcrumb-item active align-items-center">
			<span>
				<i class="fas fa-angle-left mr-1"></i>
				{{ $breadcrumbs[0]['label'] }}
			</span>
            </li>
        @elseif(count($breadcrumbs) == 2)
            <li class="breadcrumb-item">
                <a href="{{ $breadcrumbs[0]['url'] }}">
                    <i class="breadcrumb-icon fas fa-angle-left mr-2"></i>{{ $breadcrumbs[0]['label'] }}
                </a>
            </li>
            <li class="breadcrumb-item active">{{ $breadcrumbs[1]['label'] }}</li>
        @else
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($loop->first)
                    <li class="breadcrumb-item">
                        <a href="{{ $breadcrumb['url'] }}">
                            <i class="breadcrumb-icon fas fa-angle-left mr-2"></i>{{ $breadcrumb['label'] }}
                        </a>
                    </li>
                @elseif ($loop->last)
                    <li class="breadcrumb-item active">{{ $breadcrumb['label'] }}</li>
                @else
                    <li class="breadcrumb-item">
                        @if(isset($breadcrumb['url']))
                            <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
                        @else
                            <a href="javascript:void(0);">{{ $breadcrumb['label'] }}</a>
                        @endif
                    </li>
                @endif
            @endforeach
        @endif
    </ol>
</nav>
