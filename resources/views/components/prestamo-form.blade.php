@props(['method', 'actionRoute', 'titulo', 'prestamo', 'users', 'libros'])

<div class="min-h-screen flex flex-col sm:justify-start items-center pt-0 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <section class="mb-5">
            <a href="{{ route('prestamos.index') }}" class="inline-flex items-center justify-start text-sm font-medium text-gray-500 rounded-lg hover:text-gray-600 hover:underline">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Volver
            </a>
        </section>

        <h1 class="text-xl font-bold mb-5">{{ $titulo }}</h1>

        <form method="POST" action="{{ $actionRoute }}">
            @csrf

            @if (Auth::user()->name == 'admin')
                <div class="mb-3">
                    <x-label for="user_id" value="{{ __('Usuario') }}" />
                    <select id="user_id" name="user_id" class="block mt-1 p-2 text-sm w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @if ($method == 'update')
                            @foreach ($users as $user)
                                <option @if ($prestamo->user_id == $user->id) selected @endif
                                        value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        @elseif ($method == 'create')
                            <option @if (old('user_id') == "") selected @endif value="">
                                Selecciona un usuario
                            </option>
                            @foreach ($users as $user)
                                <option @if (old('user_id') == $user->id) selected @endif
                                        value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        @endif    
                    </select>

                    @error('user_id')
                        <div class="p-4 mt-4 text-sm font-medium text-red-800 rounded-lg bg-red-50" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @else
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            @endif

            <div class="mb-3">
                <x-label for="libro_id" value="{{ __('Libro') }}" />
                <select id="libro_id" name="libro_id" class="block mt-1 p-2 text-sm w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @if ($method == 'update')
                        @foreach ($libros as $libro)
                            <option @if ($prestamo->libro_id == $libro->id) selected @endif
                                    value="{{ $libro->id }}">
                                {{ $libro->titulo }}
                                @if ($libro->id != $prestamo->libro_id && !$libro->disponible)
                                    - No disponible
                                @endif
                            </option>
                        @endforeach
                    @elseif ($method == 'create')
                        <option @if (old('libro_id') == "") selected @endif value="">
                            Selecciona un libro
                        </option>
                        @foreach ($libros as $libro)
                            <option @if (old('libro_id') == $libro->id) selected @endif
                                    value="{{ $libro->id }}">
                                {{ $libro->titulo }}
                                @if (!$libro->disponible)
                                    - No disponible
                                @endif
                            </option>
                        @endforeach
                    @endif    
                </select>

                @error('libro_id')
                    <div class="p-4 mt-4 text-sm font-medium text-red-800 rounded-lg bg-red-50" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <x-label for="fecha_prestamo" value="{{ __('Fecha préstamo') }}" />
                @if ($method == 'update')
                    <input class="block mt-1 p-2 text-sm w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                           type="date"
                           name="fecha_prestamo"
                           id="fecha_prestamo"
                           value="{{ $prestamo->fecha_prestamo }}">
                @elseif ($method == 'create')
                    <input class="block mt-1 p-2 text-sm w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                           type="date"
                           name="fecha_prestamo"
                           id="fecha_prestamo"
                           value="{{ old('fecha_prestamo') }}">
                @endif

                @error('fecha_prestamo')
                    <div class="p-4 mt-4 text-sm font-medium text-red-800 rounded-lg bg-red-50" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <x-label for="fecha_devolucion_estimada" value="{{ __('Fecha devolución estimada') }}" />
                @if ($method == 'update')
                    <input class="block mt-1 p-2 text-sm w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                           type="date"
                           name="fecha_devolucion_estimada"
                           id="fecha_devolucion_estimada"
                           value="{{ $prestamo->fecha_devolucion_estimada }}">
                @elseif ($method == 'create')
                    <input class="block mt-1 p-2 text-sm w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                           type="date"
                           name="fecha_devolucion_estimada"
                           id="fecha_devolucion_estimada"
                           value="{{ old('fecha_devolucion_estimada') }}">
                @endif

                @error('fecha_devolucion_estimada')
                    <div class="p-4 mt-4 text-sm font-medium text-red-800 rounded-lg bg-red-50" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="flex flex-col mb-3">
                <x-label class="mb-2" value="{{ __('Entregado') }}" />
                <div class="flex items-center mb-3 gap-x-3">
                    @if ($method == 'update')
                        <input class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:ring-2"
                               type="radio"
                               name="entregado"
                               id="entregado-si"
                               value="1"
                               @if ($prestamo->entregado) checked @endif />
                    @elseif ($method == 'create')
                        <input class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:ring-2"
                               type="radio"
                               name="entregado"
                               id="entregado-si"
                               value="1"
                               @if (old('entregado')) checked @endif />
                    @endif
                    <x-label for="entregado-si" value="{{ __('Sí') }}" />
                </div>
                <div class="flex items-center gap-x-3">
                    @if ($method == 'update')
                        <input class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:ring-2"
                               type="radio"
                               name="entregado"
                               id="entregado-no"
                               value="0"
                               @if (!$prestamo->entregado) checked @endif />
                    @elseif ($method == 'create')
                        <input class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:ring-2"
                               type="radio"
                               name="entregado"
                               id="entregado-no"
                               value="0"
                               @if (!old('entregado')) checked @endif />
                    @endif
                    <x-label for="entregado-si" value="{{ __('No') }}" />
                </div>

                @error('entregado')
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