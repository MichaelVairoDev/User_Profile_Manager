<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Habilidad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('skills.update', $skill) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Información de la Habilidad -->
                        <div>
                            <h3 class="text-lg font-medium text-[#3674B5]">{{ $skill->name }}</h3>
                            <p class="text-gray-600">{{ __('Categoría:') }} {{ $skill->category }}</p>
                        </div>

                        <!-- Nivel -->
                        <div>
                            <x-input-label for="level" :value="__('Nivel de Dominio')" />
                            <div class="mt-2">
                                <div class="flex items-center space-x-4">
                                    @for($i = 1; $i <= 5; $i++)
                                        <div class="flex items-center">
                                            <input type="radio" id="level_{{ $i }}" name="level" value="{{ $i }}"
                                                   class="h-4 w-4 border-gray-300 text-[#3674B5] focus:ring-[#578FCA]"
                                                   {{ old('level', $level) == $i ? 'checked' : '' }}>
                                            <label for="level_{{ $i }}" class="ml-2 text-sm text-gray-600">
                                                {{ $i }}
                                            </label>
                                        </div>
                                    @endfor
                                </div>
                                <p class="mt-1 text-sm text-gray-500">1 = Básico, 5 = Experto</p>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('level')" />
                        </div>

                        <div class="flex justify-end gap-4">
                            <x-secondary-button onclick="window.history.back()">
                                {{ __('Cancelar') }}
                            </x-secondary-button>

                            <x-primary-button class="bg-[#3674B5] hover:bg-[#578FCA]">
                                {{ __('Actualizar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
