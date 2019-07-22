@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', ['modalClass' => 'flash-modal', 'title' => $message['title'], 'body' => $message['message']])
    @else
        <div class="alert border-0 shadow-sm alert-{{ $message['level'] }} {{ $message['important'] ? 'alert-important' : '' }}" role="alert">
            @if ($message['important'])
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif

            <span class="font-weight-bold mr-2">
                 @switch($message['level'])
                    @case('success') <i class="fe fe-check mr-1"></i> Succes: @break;
                    @default <i class="fe fe-info mr-1"></i> Info:
                @endswitch
            </span>

            {!! $message['message'] !!}
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
