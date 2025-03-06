<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Añadir Experiencia Laboral') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('work-experiences.store') }}" class="space-y-6">
                        @csrf

                        <!-- Empresa -->
                        <div>
                            <x-input-label for="company_name" :value="__('Nombre de la Empresa')" />
                            <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full" :value="old('company_name')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
                        </div>

                        <!-- Cargo -->
                        <div>
                            <x-input-label for="position" :value="__('Cargo')" />
                            <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" :value="old('position')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('position')" />
                        </div>

                        <!-- Descripción -->
                        <div>
                            <x-input-label for="description" :value="__('Descripción de tus responsabilidades')" />
                            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <!-- Ubicación -->
                        <div>
                            <x-input-label for="location" :value="__('Ubicación')" />
                            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location')" />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>

                        <!-- Sitio Web de la Empresa -->
                        <div>
                            <x-input-label for="company_website" :value="__('Sitio Web de la Empresa')" />
                            <x-text-input id="company_website" name="company_website" type="url" class="mt-1 block w-full" :value="old('company_website')" placeholder="https://" />
                            <x-input-error class="mt-2" :messages="$errors->get('company_website')" />
                        </div>

                        <!-- Fechas -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="start_date" :value="__('Fecha de Inicio')" />
                                <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="old('start_date')" required />
                                <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                            </div>

                            <div>
                                <x-input-label for="end_date" :value="__('Fecha de Finalización')" />
                                <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" :value="old('end_date')" :disabled="old('current_job', false)" />
                                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                            </div>
                        </div>

                        <!-- Trabajo Actual -->
                        <div class="flex items-center">
                            <input id="current_job" name="current_job" type="checkbox" class="rounded border-gray-300 text-[#3674B5] shadow-sm focus:ring-[#578FCA]" @checked(old('current_job', false)) onchange="document.getElementById('end_date').disabled = this.checked">
                            <label for="current_job" class="ml-2 text-sm text-gray-600">
                                {{ __('Este es mi trabajo actual') }}
                            </label>
                        </div>

                        <div class="flex justify-end gap-4">
                            <x-secondary-button onclick="window.history.back()">
                                {{ __('Cancelar') }}
                            </x-secondary-button>

                            <x-primary-button class="bg-[#3674B5] hover:bg-[#578FCA]">
                                {{ __('Guardar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
