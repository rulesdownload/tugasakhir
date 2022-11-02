<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Laporan') }}
        </h2>
    </x-slot>

		<div class="container mt-2">
			<div class="row justify-content-center">
				<div class="col-md-12">

					<div class="card">
						<div class="card-header">
							<h5 class="card-title pt-3">Buat Laporan</h5>
						</div>

						<div class="card-body form-group">
							<form method="POST" action="">
							@livewire('address-select')
						</div>
					</div>
				</div>
			</div>
		</div>
</x-app-layout>