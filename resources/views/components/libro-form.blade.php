@props(['method', 'actionRoute', 'titulo', 'libro'])

<div class="min-h-screen flex flex-col sm:justify-start items-center pt-0 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <section class="mb-5">
            <a href="{{ route('libros.index') }}" class="inline-flex items-center justify-start text-sm font-medium text-gray-500 rounded-lg hover:text-gray-600 hover:underline">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Volver
            </a>
        </section>

        <h1 class="text-xl font-bold mb-5">{{ $titulo }}</h1>

        <form method="POST" action="{{ $actionRoute }}">
            @csrf

            <div class="mb-3">
                <x-label for="titulo" value="{{ __('Título') }}" />
                @if ($method == 'update')
                    <x-input class="block mt-1 w-full" 
                            type="text" 
                            name="titulo"
                            id="titulo"
                            :value="$libro->titulo"
                            autofocus />
                @elseif ($method == 'create')
                    <x-input class="block mt-1 w-full" 
                            type="text" 
                            name="titulo"
                            id="titulo"
                            :value="old('titulo')"
                            autofocus />
                @endif

                @error('titulo')
                    <div class="p-4 mt-4 text-sm font-medium text-red-800 rounded-lg bg-red-50" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <x-label for="autor" value="{{ __('Autor') }}" />
                @if ($method == 'update')
                    <x-input class="block mt-1 w-full" 
                            type="text" 
                            name="autor"
                            id="autor"
                            :value="$libro->autor" />
                @elseif ($method == 'create')
                    <x-input class="block mt-1 w-full" 
                            type="text" 
                            name="autor"
                            id="autor"
                            :value="old('autor')" />
                @endif

                @error('autor')
                    <div class="p-4 mt-4 text-sm font-medium text-red-800 rounded-lg bg-red-50" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <x-label for="descripcion" value="{{ __('Descripción') }}" />
                @if ($method == 'update')
                    <textarea class="block mt-1 p-2 text-sm w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                              name="descripcion"
                              id="descripcion"
                              rows="6">{{ $libro->descripcion }}</textarea>
                @elseif ($method == 'create')
                    <textarea class="block mt-1 p-2 text-sm w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                              name="descripcion"
                              id="descripcion"
                              rows="6">{{ old('descripcion') }}</textarea>
                @endif

                @error('descripcion')
                    <div class="p-4 mt-4 text-sm font-medium text-red-800 rounded-lg bg-red-50" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <x-label for="anio_publicacion" value="{{ __('Año Publicación') }}" />
                @if ($method == 'update')
                    <x-input class="block mt-1 w-full" 
                            type="text" 
                            name="anio_publicacion"
                            id="anio_publicacion"
                            :value="$libro->anio_publicacion" />
                @elseif ($method == 'create')
                    <x-input class="block mt-1 w-full" 
                            type="text" 
                            name="anio_publicacion"
                            id="anio_publicacion"
                            :value="old('anio_publicacion')" />
                @endif

                @error('anio_publicacion')
                    <div class="p-4 mt-4 text-sm font-medium text-red-800 rounded-lg bg-red-50" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <x-label for="genero" value="{{ __('Género') }}" />
                @if ($method == 'update')
                    <x-input class="block mt-1 w-full" 
                         type="text" 
                         name="genero"
                         id="genero"
                         :value="$libro->genero" />
                @elseif ($method == 'create')    
                    <x-input class="block mt-1 w-full" 
                            type="text" 
                            name="genero"
                            id="genero"
                            :value="old('genero')" />
                @endif

                @error('genero')
                    <div class="p-4 mt-4 text-sm font-medium text-red-800 rounded-lg bg-red-50" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="flex flex-col mb-3">
                <x-label class="mb-2" value="{{ __('Disponible') }}" />
                <div class="flex items-center mb-3 gap-x-3">
                    <input class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:ring-2"
                           type="radio"
                           name="disponible"
                           id="disponible-si"
                           value="1"
                           @if (isset($libro) && $libro->disponible)
                              checked
                           @elseif($method == 'create' && old('disponible') )
                              checked
                           @endif>
                    <x-label for="disponible-si" value="{{ __('Sí') }}" />
                </div>
                <div class="flex items-center gap-x-3">
                    <input class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:ring-2"
                           type="radio"
                           name="disponible"
                           id="disponible-no"
                           value="1"
                           @if (isset($libro) && !$libro->disponible)
                              checked
                           @elseif($method == 'create' && !old('disponible') )
                              checked
                           @endif>
                    <x-label for="disponible-si" value="{{ __('No') }}" />
                </div>

                @error('disponible')
                    <div class="p-4 mt-4 text-sm font-medium text-red-800 rounded-lg bg-red-50" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-5">
                <x-button class="bg-indigo-600 hover:bg-indigo-800">
                    @if ($method == 'create')
                        {{ __('Crear') }}
                    @elseif ($method == 'update')
                        {{ __('Editar') }}
                    @endif
                </x-button>
            </div>
        </form>
    </div>
</div>