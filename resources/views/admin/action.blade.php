<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard admin') }}
        </h2>
    </x-slot>

                        <div class="card-body form-group">

                            @livewire('action')
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-admin-layout>
