<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Sección de perfil principal -->
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            @if(auth()->user()->avatar)
                                <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="Avatar" class="h-24 w-24 rounded-full object-cover border-4 border-[#3674B5]">
                            @else
                                <div class="h-24 w-24 rounded-full bg-[#578FCA] flex items-center justify-center text-white text-2xl font-bold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-[#3674B5]">{{ auth()->user()->name }}</h3>
                            @if(auth()->user()->profession)
                                <p class="text-gray-600">{{ auth()->user()->profession }}</p>
                            @endif
                            @if(auth()->user()->location)
                                <p class="text-gray-500"><i class="fas fa-map-marker-alt"></i> {{ auth()->user()->location }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Grid de información -->
                    <div class="mt-8 grid md:grid-cols-3 gap-6">
                        <!-- Experiencia Profesional -->
                        <div class="bg-[#D1F8EF] p-6 rounded-lg">
                            <h4 class="font-semibold text-[#3674B5] mb-4">Experiencia Profesional</h4>
                            @if($currentJob = auth()->user()->getCurrentJob())
                                <div class="mb-4">
                                    <p class="font-medium">Trabajo Actual:</p>
                                    <p class="text-gray-700">{{ $currentJob->position }} en {{ $currentJob->company_name }}</p>
                                    <p class="text-gray-600 text-sm">{{ $currentJob->duration }}</p>
                                </div>
                            @endif
                            <p class="text-gray-700">
                                <span class="font-medium">Años de experiencia total:</span>
                                {{ auth()->user()->getYearsOfExperience() }} años
                            </p>
                            <div class="mt-4">
                                <a href="{{ route('work-experiences.index') }}" class="text-[#3674B5] hover:text-[#578FCA]">
                                    Ver historial completo →
                                </a>
                            </div>
                        </div>

                        <!-- Habilidades Principales -->
                        <div class="bg-[#D1F8EF] p-6 rounded-lg">
                            <h4 class="font-semibold text-[#3674B5] mb-4">Habilidades Principales</h4>
                            @php
                                $topSkills = auth()->user()->getTopSkills(5);
                            @endphp
                            @if(count($topSkills) > 0)
                                <div class="space-y-4">
                                    @foreach($topSkills as $skill)
                                        <div>
                                            <div class="flex justify-between">
                                                <span class="font-medium">{{ $skill['name'] }}</span>
                                                <span class="text-sm text-gray-600">Nivel {{ $skill['level'] }}/5</span>
                                            </div>
                                            <div class="mt-1 flex space-x-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <div class="w-full h-1.5 rounded-full {{ $i <= $skill['level'] ? 'bg-[#3674B5]' : 'bg-gray-200' }}"></div>
                                                @endfor
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('skills.index') }}" class="text-[#3674B5] hover:text-[#578FCA]">
                                        Ver todas las habilidades →
                                    </a>
                                </div>
                            @else
                                <p class="text-gray-500">No has añadido habilidades aún.</p>
                                <a href="{{ route('skills.create') }}" class="mt-2 inline-block text-[#3674B5] hover:text-[#578FCA]">
                                    Añadir habilidades →
                                </a>
                            @endif
                        </div>

                        <!-- Información personal -->
                        <div class="bg-[#D1F8EF] p-6 rounded-lg">
                            <h4 class="font-semibold text-[#3674B5] mb-4">Información Personal</h4>
                            @if(auth()->user()->bio)
                                <div class="mb-4">
                                    <p class="font-medium">Sobre mí:</p>
                                    <p class="text-gray-600">{{ auth()->user()->bio }}</p>
                                </div>
                            @endif
                            @if(auth()->user()->birth_date)
                                <p class="text-gray-700">
                                    <span class="font-medium">Edad:</span>
                                    {{ auth()->user()->getAge() }} años
                                </p>
                            @endif
                            @if(auth()->user()->phone)
                                <p class="text-gray-700 mt-2">
                                    <span class="font-medium">Contacto:</span>
                                    {{ auth()->user()->phone }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <a href="{{ route('work-experiences.create') }}" class="bg-[#578FCA] hover:bg-[#3674B5] text-white px-4 py-2 rounded-lg transition-colors">
                            Añadir Experiencia
                        </a>
                        <a href="{{ route('skills.create') }}" class="bg-[#578FCA] hover:bg-[#3674B5] text-white px-4 py-2 rounded-lg transition-colors">
                            Añadir Habilidad
                        </a>
                        <a href="{{ route('profile.edit') }}" class="bg-[#3674B5] hover:bg-[#578FCA] text-white px-4 py-2 rounded-lg transition-colors">
                            Editar Perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
