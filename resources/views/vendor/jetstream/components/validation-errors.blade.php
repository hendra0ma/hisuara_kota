@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <div {{ $attributes }}>
        <div class="font-medium">{{ __('Whoops! Something went wrong.') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  </div>
    
@endif
