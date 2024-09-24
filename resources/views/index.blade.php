<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Check if the authenticated user has a google_id --}}
    @if(Auth::check() && Auth::user()->google_id)
        <center>Welcome New Google User</center>
    @elif(Auth::check() && Auth::user()->facebook_id)
        <center>Welcome New Facebook User</center>
    @else
        <center>Welcome New User</center>
    @endif

</x-app-layout>
