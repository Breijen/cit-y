@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Cit-Y')
<h1>Cit-Y</h1>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
