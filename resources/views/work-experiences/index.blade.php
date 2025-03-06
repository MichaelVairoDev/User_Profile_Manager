<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Experiencia Laboral') }}
            </h2>
            <a href="{{ route('work-experiences.create') }}" class="bg-[#3674B5] hover:bg-[#578FCA] text-white px-4 py-2 rounded-lg transition-colors">
                {{ __('Añadir Experiencia') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('status'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    @if(session('status') === 'experience-created')
                        {{ __('Experiencia laboral agregada correctamente.') }}
                    @elseif(session('status') === 'experience-updated')
                        {{ __('Experiencia laboral actualizada correctamente.') }}
                    @elseif(session('status') === 'experience-deleted')
                        {{ __('Experiencia laboral eliminada correctamente.') }}
                    @endif
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($experiences->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500">{{ __('No has agregado ninguna experiencia laboral aún.') }}</p>
                            <a href="{{ route('work-experiences.create') }}" class="mt-4 inline-block text-[#3674B5] hover:text-[#578FCA]">
                                {{ __('Agregar tu primera experiencia') }}
                            </a>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($experiences as $experience)
                                <div class="border rounded-lg p-6 hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-xl font-semibold text-[#3674B5]">{{ $experience->position }}</h3>
                                            <p class="text-lg text-gray-700">{{ $experience->company_name }}</p>
                                            <p class="text-gray-600">{{ $experience->duration }}</p>

                                            @if($experience->location)
                                                <p class="text-gray-600 mt-2">
                                                    <i class="fas fa-map-marker-alt"></i> {{ $experience->location }}
                                                </p>
                                            @endif

                                            @if($experience->description)
                                                <p class="mt-4 text-gray-700">{{ $experience->description }}</p>
                                            @endif

                                            @if($experience->company_website)
                                                <a href="{{ $experience->company_website }}" target="_blank" class="text-[#578FCA] hover:text-[#3674B5] mt-2 inline-block">
                                                    <i class="fas fa-external-link-alt"></i> Sitio web de la empresa
                                                </a>
                                            @endif
                                        </div>

                                        <div class="flex space-x-2">
                                            <a href="{{ route('work-experiences.edit', $experience) }}" class="text-[#578FCA] hover:text-[#3674B5]">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('work-experiences.destroy', $experience) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('¿Estás seguro de querer eliminar esta experiencia?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
