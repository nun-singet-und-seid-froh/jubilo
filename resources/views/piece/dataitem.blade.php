<div class=
    @if ( $level == 'top')
     "row micro-box micro-shadow">
        <div class="col-md-4 main-label">
    @else
        "row">
        <div class="col-md-4">
    @endif
        {{ $label }}</div>
        
    <div class="col-md-8">
        @if ( $type == 'input')        
            <input id="{{ $id }}"></input>

        @elseif ( $type == 'upload')
            <input id="{{ $id }}" type="file"></input>
        @endif
    </div>
</div>
