@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('photos/logo.jpg') }}" class="logo" alt="Royal Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
