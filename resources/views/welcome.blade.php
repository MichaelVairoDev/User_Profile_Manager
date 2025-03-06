<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="min-h-screen bg-gradient-to-b from-[#D1F8EF] to-white">
            <!-- Navegación -->
            <nav class="bg-[#3674B5] p-4 fixed w-full z-10">
                <div class="container mx-auto flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <x-application-logo class="w-8 h-8 text-white" />
                        <h1 class="text-2xl font-bold text-white">{{ config('app.name') }}</h1>
                    </div>
                    <div class="space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-white hover:text-[#A1E3F9]">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-white hover:text-[#A1E3F9]">Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-white text-[#3674B5] px-4 py-2 rounded-lg hover:bg-[#A1E3F9] transition-colors">Registro</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <div class="pt-32 pb-16 text-center px-4">
                <h2 class="text-5xl font-bold text-[#3674B5] mb-6">Gestiona tu Perfil Profesional</h2>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">Una plataforma completa para mostrar tus habilidades, experiencia y logros profesionales en un solo lugar.</p>
                @guest
                    <a href="{{ route('register') }}" class="bg-[#3674B5] text-white px-8 py-3 rounded-lg text-lg hover:bg-[#578FCA] transition-colors inline-block">
                        Comienza Ahora
                    </a>
                @endguest
            </div>

            <!-- Características -->
            <div class="container mx-auto px-4 py-16">
                <h3 class="text-3xl font-bold text-center text-[#3674B5] mb-12">¿Por qué elegirnos?</h3>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition-shadow">
                        <div class="text-[#3674B5] text-4xl mb-4 flex justify-center">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <h4 class="text-xl font-semibold text-[#578FCA] mb-4 text-center">Perfil Completo</h4>
                        <p class="text-gray-600 text-center">Crea un perfil profesional detallado con toda tu información relevante en un formato atractivo y fácil de leer.</p>
                    </div>
                    <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition-shadow">
                        <div class="text-[#3674B5] text-4xl mb-4 flex justify-center">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h4 class="text-xl font-semibold text-[#578FCA] mb-4 text-center">Experiencia Laboral</h4>
                        <p class="text-gray-600 text-center">Organiza y presenta tu historial laboral de manera profesional, destacando tus logros y responsabilidades.</p>
                    </div>
                    <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition-shadow">
                        <div class="text-[#3674B5] text-4xl mb-4 flex justify-center">
                            <i class="fas fa-star"></i>
                        </div>
                        <h4 class="text-xl font-semibold text-[#578FCA] mb-4 text-center">Habilidades</h4>
                        <p class="text-gray-600 text-center">Muestra tus habilidades técnicas y blandas con un sistema intuitivo de niveles y categorías.</p>
                    </div>
                </div>
            </div>

            <!-- Cómo Funciona -->
            <div class="bg-[#F0F9FF] py-16">
                <div class="container mx-auto px-4">
                    <h3 class="text-3xl font-bold text-center text-[#3674B5] mb-12">Cómo Funciona</h3>
                    <div class="grid md:grid-cols-4 gap-8">
                        <div class="text-center">
                            <div class="bg-[#3674B5] w-12 h-12 rounded-full flex items-center justify-center text-white text-xl font-bold mx-auto mb-4">1</div>
                            <h5 class="font-semibold mb-2">Regístrate</h5>
                            <p class="text-gray-600">Crea tu cuenta en segundos</p>
                        </div>
                        <div class="text-center">
                            <div class="bg-[#3674B5] w-12 h-12 rounded-full flex items-center justify-center text-white text-xl font-bold mx-auto mb-4">2</div>
                            <h5 class="font-semibold mb-2">Completa tu Perfil</h5>
                            <p class="text-gray-600">Añade tu información personal</p>
                        </div>
                        <div class="text-center">
                            <div class="bg-[#3674B5] w-12 h-12 rounded-full flex items-center justify-center text-white text-xl font-bold mx-auto mb-4">3</div>
                            <h5 class="font-semibold mb-2">Agrega Experiencia</h5>
                            <p class="text-gray-600">Documenta tu trayectoria</p>
                        </div>
                        <div class="text-center">
                            <div class="bg-[#3674B5] w-12 h-12 rounded-full flex items-center justify-center text-white text-xl font-bold mx-auto mb-4">4</div>
                            <h5 class="font-semibold mb-2">Destaca tus Habilidades</h5>
                            <p class="text-gray-600">Muestra tus competencias</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="container mx-auto px-4 py-16 text-center">
                <h3 class="text-3xl font-bold text-[#3674B5] mb-6">¿Listo para Comenzar?</h3>
                <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">Únete a nuestra comunidad y crea tu perfil profesional hoy mismo.</p>
                @guest
                    <div class="space-x-4">
                        <a href="{{ route('register') }}" class="bg-[#3674B5] text-white px-8 py-3 rounded-lg text-lg hover:bg-[#578FCA] transition-colors inline-block">Registrarse</a>
                        <a href="{{ route('login') }}" class="border-2 border-[#3674B5] text-[#3674B5] px-8 py-3 rounded-lg text-lg hover:bg-[#3674B5] hover:text-white transition-colors inline-block">Iniciar Sesión</a>
                    </div>
                @endguest
            </div>

            <!-- Footer -->
            <footer class="bg-[#3674B5] text-white py-12">
                <div class="container mx-auto px-4">
                    <div class="grid md:grid-cols-3 gap-8 mb-8">
                        <div>
                            <div class="flex items-center space-x-2 mb-4">
                                <x-application-logo class="w-8 h-8 text-white" />
                                <h4 class="text-xl font-bold">{{ config('app.name') }}</h4>
                            </div>
                            <p class="text-[#A1E3F9]">Tu plataforma personal para gestionar y mostrar tu perfil profesional.</p>
                        </div>
                        <div>
                            <h5 class="font-semibold mb-4">Enlaces Rápidos</h5>
                            <ul class="space-y-2">
                                <li><a href="{{ route('login') }}" class="text-[#A1E3F9] hover:text-white transition-colors">Iniciar Sesión</a></li>
                                <li><a href="{{ route('register') }}" class="text-[#A1E3F9] hover:text-white transition-colors">Registrarse</a></li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="font-semibold mb-4">Contáctanos</h5>
                            <p class="text-[#A1E3F9]">¿Tienes preguntas? Escríbenos a:</p>
                            <a href="mailto:info@userprofilemanager.com" class="text-white hover:text-[#A1E3F9] transition-colors">info@userprofilemanager.com</a>
                        </div>
                    </div>
                    <div class="border-t border-[#578FCA] pt-8 text-center">
                        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
