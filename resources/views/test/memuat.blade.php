<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">

        </x-slot>

        <x-jet-validation-errors class="mb-4" />
        <center>Memuat Data</center>
        <br>
        {{ $role = Auth::user()->role; }}
        <center><img src="assets/img/ajax-loader.gif" alt=""></center>

        @can("update-data")

        role id ini bisa update data

        @endcan

        {{-- Kecamatan --}}

        {{-- kelurahan --}}

    </x-jet-authentication-card>
</x-guest-layout>