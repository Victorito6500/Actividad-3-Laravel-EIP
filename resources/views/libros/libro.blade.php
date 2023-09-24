<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-start items-center pt-0 sm:pt-0 bg-gray-100">
        <div class="block w-auto my-6 p-6 bg-white border border-gray-200 rounded-lg shadow"> 
            <section class="mb-4">
                <a href="{{ route('libros.index') }}" class="inline-flex items-center justify-start text-sm font-medium text-gray-500 rounded-lg hover:text-gray-600 hover:underline">
                    <i class="fa-solid fa-arrow-left me-2"></i>
                    Volver
                </a>
            </section>

            @if ($libro != null)
                <h1 class="text-xl font-bold"><q>{{ $libro->titulo }}</q></h1>

                <section class="mt-4 px-2 d-flex flex-column gap-4">
                    @if (Auth::user()->name == 'admin')
                        <article class="mb-3">
                            <h2 class="text-semibold mb-1">ID</h2>
                            <p class="text-sm text-gray-500">{{ $libro->id }}</p>
                        </article>
                    @endif

                    <article class="mb-3">
                        <h2 class="text-semibold mb-1">Autor</h2>
                        <p class="text-sm text-gray-500">{{ $libro->autor }}</p>
                    </article>

                    <article class="mb-3">
                        <h2 class="text-semibold mb-1">Descripción</h2>
                        <p class="text-sm text-gray-500 max-w-md">{{ $libro->descripcion }}</p>
                    </article>

                    <article class="mb-3">
                        <h2 class="text-semibold mb-1">Año publicación</h2>
                        <p class="text-sm text-gray-500">{{ $libro->anio_publicacion }}</p>
                    </article>

                    <article class="mb-3">
                        <h2 class="text-semibold mb-1">Género</h2>
                        <p class="text-sm text-gray-500">{{ $libro->genero }}</p>
                    </article>

                    <article>
                        <h2 class="text-semibold mb-1">Disponible</h2>
                        <p class="text-sm text-gray-500">@if ($libro->disponible == 1) Sí @else No @endif</p>
                    </article>

                    @if (Auth::user()->name == 'admin')
                        <article class="flex gap-x-4 mt-6">
                            <a href="{{ route('libros.updateView', ['id' => $libro->id]) }}" class="shadow text-white bg-indigo-500 hover:bg-indigo-600 font-medium rounded-lg px-5 py-2.5">
                                <i class="fa-regular fa-pen-to-square me-2"></i>
                                Editar
                            </a>
                            <a href="{{ route('libros.delete', ['id' => $libro->id]) }}" class="shadow text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg px-5 py-2.5">
                                <i class="fa-regular fa-pen-to-square me-2"></i>
                                Eliminar
                            </a>
                        </article>
                    @endif
                </section>
            @else
                <h1 class="text-xl font-bold">El libro no existe</h1>
            @endif
        </div>
    </div>
</x-app-layout>