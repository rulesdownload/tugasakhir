    <x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard admin') }}
        </h2>
    </x-slot>


        <div class="container mt-2">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title pt-3">Chart Laporan</h5>
                        </div>

                        <div class="card-body form-group">
                            @livewire('show-data')
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-admin-layout>
