<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mis Habilidades') }}
            </h2>
            <a href="{{ route('skills.create') }}" class="bg-[#3674B5] hover:bg-[#578FCA] text-white px-4 py-2 rounded-lg transition-colors">
                {{ __('Añadir Habilidad') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('status'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    @if(session('status') === 'skill-added')
                        {{ __('Habilidad agregada correctamente.') }}
                    @elseif(session('status') === 'skill-updated')
                        {{ __('Habilidad actualizada correctamente.') }}
                    @elseif(session('status') === 'skill-removed')
                        {{ __('Habilidad eliminada correctamente.') }}
                    @endif
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(empty($skillsByCategory))
                        <div class="text-center py-8">
                            <p class="text-gray-500">{{ __('No has agregado ninguna habilidad aún.') }}</p>
                            <a href="{{ route('skills.create') }}" class="mt-4 inline-block text-[#3674B5] hover:text-[#578FCA]">
                                {{ __('Agregar tu primera habilidad') }}
                            </a>
                        </div>
                    @else
                        <div class="space-y-8">
                            @foreach($categories as $categoryKey => $categoryName)
                                @if(isset($skillsByCategory[$categoryKey]))
                                    <div>
                                        <h3 class="text-lg font-semibold text-[#3674B5] mb-4">{{ $categoryName }}</h3>
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                            @foreach($skillsByCategory[$categoryKey] as $skillData)
                                                <div class="bg-[#D1F8EF] p-4 rounded-lg">
                                                    <div class="flex justify-between items-start">
                                                        <div>
                                                            <h4 class="font-medium">{{ $skillData['name'] }}</h4>
                                                            <div class="mt-2 flex space-x-1">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <div class="w-4 h-4 rounded-full {{ $i <= $skillData['pivot']['level'] ? 'bg-[#3674B5]' : 'bg-gray-200' }}"></div>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        <div class="flex space-x-2">
                                                            <a href="{{ route('skills.edit', $skillData['id']) }}" class="text-[#578FCA] hover:text-[#3674B5]">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('skills.destroy', $skillData['id']) }}" method="POST" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('¿Estás seguro de querer eliminar esta habilidad?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
