<x-mail::message>
# Results

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean maximus, tellus a volutpat dapibus, neque mauris hendrerit lectus, id iaculis neque lacus sit amet enim.
<br>
<br>

@foreach($data as $type => $info)
@if(count($info) > 0)

## {{ ucfirst($type) }}

<x-mail::table>
| Name       | Value|
| ------------------- |:---------:|
@foreach($info as $datum)
    @if(is_bool($datum['value']))
    | {{ $datum['label'] }}      | {{ $datum['value'] ? 'Yes' : 'No' }}
    @elseif(is_array($datum['value']))
    | {{ $datum['label'] }}      | {{ implode(' / ', $datum['value']) }}
    @elseif(is_string($datum['value']) || is_int($datum['value']) || is_float($datum['value']))
    | {{ $datum['label'] }}      | {{ $datum['value'] }}
    @endif
@endforeach
</x-mail::table>
@endif
@endforeach

<x-mail::button :url="$url">
View results
</x-mail::button>

</x-mail::message>
