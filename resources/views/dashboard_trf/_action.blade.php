
<ul class="icons-list">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="icon-menu9"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-right">
            @if (isset($detil))
                <li><a href="{!! $detil !!}"><i class="icon-search4"></i> Detail</a></li>
            @endif
            @if (isset($approval))
                <li><a href="{!! $approval !!}"><i class="icon-search4"></i> Approval</a></li>
            @endif
            @if (isset($reject))
                <li><a href="{!! $reject !!}"><i class="icon-search4"></i> Reject</a></li>
            @endif


        </ul>
    </li>
</ul>
