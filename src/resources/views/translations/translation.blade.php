{{-- regular object attribute --}}
@php
	$value = data_get($entry, $column['name']);

	if (is_array($value)) {
		$value = json_encode($value);
	}

@endphp

<div>
	<a href="{{ backpack_url('translation', ['id' => $entry->id]) }}/edit?locale={{ $column['lang'] }}"><small><i class="la la-edit"></i>Редактировать</small></a>
	<div style="max-width: 400px; white-space: normal;">
		{{ (array_key_exists('prefix', $column) ? $column['prefix'] : '').Str::limit(strip_tags($value), array_key_exists('limit', $column) ? $column['limit'] : 40, "[...]").(array_key_exists('suffix', $column) ? $column['suffix'] : '') }}
	</div>
</div>
