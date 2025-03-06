<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Añadir Habilidad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('skills.store') }}" class="space-y-6">
                        @csrf

                        <!-- Habilidad Existente -->
                        <div>
                            <x-input-label for="skill_id" :value="__('Seleccionar Habilidad Existente')" />
                            <select id="skill_id" name="skill_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">{{ __('Seleccionar una habilidad...') }}</option>
                                @foreach($existingSkills as $skill)
                                    <option value="{{ $skill->id }}" {{ old('skill_id') == $skill->id ? 'selected' : '' }}>
                                        {{ $skill->name }} ({{ $skill->category }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center text-gray-500 my-4">- O -</div>

                        <!-- Nueva Habilidad -->
                        <div>
                            <x-input-label for="name" :value="__('Nueva Habilidad')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <!-- Categoría -->
                        <div>
                            <x-input-label for="category" :value="__('Categoría')" />
                            <select id="category" name="category" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">{{ __('Seleccionar categoría...') }}</option>
                                @foreach($categories as $key => $category)
                                    <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('category')" />
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
                                                   {{ old('level', 3) == $i ? 'checked' : '' }}>
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
                                {{ __('Guardar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const skillSelect = document.getElementById('skill_id');
        const nameInput = document.getElementById('name');
        const categorySelect = document.getElementById('category');

        skillSelect.addEventListener('change', function() {
            const isExistingSkill = this.value !== '';
            nameInput.disabled = isExistingSkill;
            categorySelect.disabled = isExistingSkill;
        });

        // Inicializar estado
        skillSelect.dispatchEvent(new Event('change'));
    </script>
    @endpush
</x-app-layout>
