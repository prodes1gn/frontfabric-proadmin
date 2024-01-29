@if(count(config('translatable.locales')) > 1)
<td class="text-center">
    @foreach(config('translatable.locales') as $locale)
    @if($locale != config('translatable.locale'))
    <a href="{{ route('admin.roles.edit', $row->id) }}?lang={{ $locale }}" data-toggle="tooltip" data-theme="dark" title="{{ strtoupper($locale) }}" class="btn btn-icon btn-light btn-hover-secondary btn-sm {{ ($row->hasTranslation($locale)) ? 'has' : '' }}">
        <img src="{{ asset('uploads/settings/languages/' . mb_strtolower($locale, 'UTF-8') . '.png') }}" class="h-20px w-20px {{ (!$row->hasTranslation($locale)) ? 'grayscale' : '' }}" alt="{{ strtoupper($locale) }}" />
    </a>
    @endif
    @endforeach
</td>
@endif