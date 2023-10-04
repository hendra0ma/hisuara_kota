<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register.saksi') }}">
            @csrf

            <div>
                <x-jet-label for="nik" value="{{ __('Nomor Induk Kependudukan') }}" />
                <x-jet-input id="nik" class="block mt-1 w-full" type="number" name="nik" :value="old('nik')" required autofocus autocomplete="nik" />
            </div>
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Nama') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="alamat" value="{{ __('Alamat') }}" />
                <x-jet-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')" required autofocus autocomplete="alamat" />
            </div>

            <div class="mt-4">
                <x-jet-label for="no_hp" value="{{ __('No Handphone') }}" />
                <x-jet-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp" :value="old('no_hp')" required autofocus autocomplete="no_hp" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
        
    {{-- Kecamatan --}}
  <script>
    $(document).ready(function() {
        $('#kota').on('change', function() {
            var categoryID = $(this).val();
            if (categoryID) {
                $.ajax({
                    url: '/getKecamatan/' + categoryID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('#kecamatan').empty();
                            $('#kecamatan').append('<option hidden>Choose Course</option>');
                            $.each(data, function(key, course) {
                                $('select[name="kecamatan"]').append('<option value="' + course.id + '">' + course.name + '</option>');
                            });
                        } else {
                            $('#kecamatan').empty();
                        }
                    }
                });
            } else {
                $('#kecamatan').empty();
            }
        });
    });
</script>
    {{-- Kecamatan --}}

    {{-- Kelurahan --}}
    <script>
        $(document).ready(function() {
            $('#kecamatan').on('change', function() {
                var categoryID = $(this).val();
                if (categoryID) {
                    $.ajax({
                        url: '/getKelurahan/' + categoryID,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#kelurahan').empty();
                                $('#kelurahan').append('<option hidden>Choose Course</option>');
                                $.each(data, function(key, course) {
                                    $('select[name="kelurahan"]').append('<option value="' + key + '">' + course.name + '</option>');
                                });
                            } else {
                                $('#kelurahan').empty();
                            }
                        }
                    });
                } else {
                    $('#kelurahan').empty();
                }
            });
        });
    </script>
    {{-- kelurahan --}}
    
    </x-jet-authentication-card>
</x-guest-layout>
