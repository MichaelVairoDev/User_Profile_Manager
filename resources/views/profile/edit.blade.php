<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Perfil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Información del Perfil') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Actualiza la información de tu perfil y tu cuenta.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="space-y-4">
                                <!-- Avatar -->
                                <div>
                                    <x-input-label for="avatar" :value="__('Foto de Perfil')" />
                                    @if($user->avatar)
                                        <div class="mt-2 mb-4">
                                            <img src="{{ Storage::url($user->avatar) }}" alt="Current avatar" class="w-24 h-24 rounded-full object-cover">
                                        </div>
                                    @endif
                                    <input type="file" id="avatar" name="avatar" class="mt-1 block w-full" accept="image/*">
                                </div>

                                <!-- Name -->
                                <div>
                                    <x-input-label for="name" :value="__('Nombre')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <!-- Email -->
                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>

                                <!-- Bio -->
                                <div>
                                    <x-input-label for="bio" :value="__('Biografía')" />
                                    <textarea id="bio" name="bio" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4">{{ old('bio', $user->bio) }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                                </div>

                                <!-- Location -->
                                <div>
                                    <x-input-label for="location" :value="__('Ubicación')" />
                                    <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', $user->location)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('location')" />
                                </div>

                                <!-- Birth Date -->
                                <div>
                                    <x-input-label for="birth_date" :value="__('Fecha de Nacimiento')" />
                                    <x-text-input id="birth_date" name="birth_date" type="date" class="mt-1 block w-full" :value="old('birth_date', $user->birth_date?->format('Y-m-d'))" />
                                    <x-input-error class="mt-2" :messages="$errors->get('birth_date')" />
                                </div>

                                <!-- Phone -->
                                <div>
                                    <x-input-label for="phone" :value="__('Teléfono')" />
                                    <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone', $user->phone)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                                </div>

                                <!-- Profession -->
                                <div>
                                    <x-input-label for="profession" :value="__('Profesión')" />
                                    <x-text-input id="profession" name="profession" type="text" class="mt-1 block w-full" :value="old('profession', $user->profession)" />
                                    <x-input-error class="mt-2" :messages="$errors->get('profession')" />
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button class="bg-[#3674B5] hover:bg-[#578FCA]">{{ __('Guardar') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Guardado.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section class="space-y-6">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Eliminar Cuenta') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Una vez que tu cuenta sea eliminada, todos tus recursos e información serán permanentemente borrados.') }}
                            </p>
                        </header>

                        <x-danger-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                        >{{ __('Eliminar Cuenta') }}</x-danger-button>

                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('¿Estás seguro de que quieres eliminar tu cuenta?') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Una vez que tu cuenta sea eliminada, todos tus recursos e información serán permanentemente borrados.') }}
                                </p>

                                <div class="mt-6">
                                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                                    <x-text-input
                                        id="password"
                                        name="password"
                                        type="password"
                                        class="mt-1 block w-3/4"
                                        placeholder="{{ __('Contraseña') }}"
                                    />

                                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                </div>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancelar') }}
                                    </x-secondary-button>

                                    <x-danger-button class="ml-3">
                                        {{ __('Eliminar Cuenta') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
