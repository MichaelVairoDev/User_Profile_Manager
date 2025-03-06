<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Perfil de ') . $user->name }}
            </h2>
            <a href="{{ route('users.index') }}" class="text-[#3674B5] hover:text-[#578FCA]">
                ← Volver al listado
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Sección de perfil principal -->
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" class="h-24 w-24 rounded-full object-cover border-4 border-[#3674B5]">
                            @else
                                <div class="h-24 w-24 rounded-full bg-[#578FCA] flex items-center justify-center text-white text-2xl font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-[#3674B5]">{{ $user->name }}</h3>
                            @if($user->profession)
                                <p class="text-gray-600">{{ $user->profession }}</p>
                            @endif
                            @if($user->location)
                                <p class="text-gray-500"><i class="fas fa-map-marker-alt"></i> {{ $user->location }}</p>
                            @endif
                            <p class="text-gray-500 mt-1">{{ $user->email }}</p>
                        </div>
                    </div>

                    <!-- Grid de información -->
                    <div class="mt-8 grid md:grid-cols-3 gap-6">
                        <!-- Experiencia Profesional -->
                        <div class="bg-[#D1F8EF] p-6 rounded-lg">
                            <h4 class="font-semibold text-[#3674B5] mb-4">Experiencia Profesional</h4>
                            @if($currentJob)
                                <div class="mb-4">
                                    <p class="font-medium">Trabajo Actual:</p>
                                    <p class="text-gray-700">{{ $currentJob->position }} en {{ $currentJob->company_name }}</p>
                                    <p class="text-gray-600 text-sm">{{ $currentJob->duration }}</p>
                                </div>
                            @endif
                            <p class="text-gray-700">
                                <span class="font-medium">Años de experiencia total:</span>
                                {{ $yearsOfExperience }} años
                            </p>

                            @if($user->workExperiences->isNotEmpty())
                                <div class="mt-4 space-y-4">
                                    <h5 class="font-medium text-[#3674B5]">Historial Laboral:</h5>
                                    @foreach($user->workExperiences as $experience)
                                        <div class="text-sm">
                                            <p class="font-medium">{{ $experience->position }}</p>
                                            <p class="text-gray-600">{{ $experience->company_name }}</p>
                                            <p class="text-gray-500">{{ $experience->duration }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Habilidades -->
                        <div class="bg-[#D1F8EF] p-6 rounded-lg">
                            <h4 class="font-semibold text-[#3674B5] mb-4">Habilidades Principales</h4>
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
                            @else
                                <p class="text-gray-500">Este usuario no ha añadido habilidades aún.</p>
                            @endif
                        </div>

                        <!-- Información personal -->
                        <div class="bg-[#D1F8EF] p-6 rounded-lg">
                            <h4 class="font-semibold text-[#3674B5] mb-4">Información Personal</h4>
                            @if($user->bio)
                                <div class="mb-4">
                                    <p class="font-medium">Sobre mí:</p>
                                    <p class="text-gray-600">{{ $user->bio }}</p>
                                </div>
                            @endif
                            @if($user->birth_date)
                                <p class="text-gray-700">
                                    <span class="font-medium">Edad:</span>
                                    {{ $user->getAge() }} años
                                </p>
                            @endif
                            @if($user->phone)
                                <p class="text-gray-700 mt-2">
                                    <span class="font-medium">Contacto:</span>
                                    {{ $user->phone }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
