<x-app-layout>
  <div class="min-h-screen flex flex-col sm:justify-start items-center pt-0 sm:pt-0 bg-gray-100">
      <div class="block w-auto my-6 p-6 bg-white border border-gray-200 rounded-lg shadow"> 
          <section class="mb-4">
              <a href="{{ route('prestamos.index') }}" class="inline-flex items-center justify-start text-sm font-medium text-gray-500 rounded-lg hover:text-gray-600 hover:underline">
                  <i class="fa-solid fa-arrow-left me-2"></i>
                  Volver
              </a>
          </section>

          @if ($prestamo != null)
            <h1 class="text-xl font-bold">Préstamo <span class="font-gray-300 italic">#{{ $prestamo->id }}</span></h1>

            <section class="mt-4 px-2 d-flex flex-column gap-4">
                <article class="mb-3">
                    <h2 class="text-semibold mb-1">Usuario</h2>
                    <p class="text-sm text-gray-500">{{ $prestamo->name }} <b class="font-gray-300 italic">#{{ $prestamo->user_id }}</b></p>
                </article>

                <article class="mb-3">
                    <h2 class="text-semibold mb-1">Libro</h2>
                    <p class="text-sm text-gray-500">{{ $prestamo->titulo }} <b class="font-gray-300 italic">#{{ $prestamo->libro_id }}</b></p>
                </article>

                <article class="mb-3">
                    <h2 class="text-semibold mb-1">Fecha préstamo</h2>
                    <p class="text-sm text-gray-500 max-w-md">{{ date('d-m-Y', strtotime($prestamo->fecha_prestamo)) }}</p>
                </article>

                <article class="mb-3">
                    <h2 class="text-semibold mb-1">Fecha devolución estimada</h2>
                    <p class="text-sm text-gray-500">{{ date('d-m-Y', strtotime($prestamo->fecha_devolucion_estimada)) }}</p>
                </article>

                @if ($prestamo->fecha_devolucion != null)
                  <article class="mb-3">
                    <h2 class="text-semibold mb-1">Fecha devolución</h2>
                    <p class="text-sm text-gray-500">{{ date('d-m-Y', strtotime($prestamo->fecha_devolucion)) }}</p>
                  </article>
                @endif

                <article>
                    <h2 class="text-semibold mb-1">Entregado</h2>
                    <p class="text-sm text-gray-500">@if ($prestamo->entregado == 1) Sí @else No @endif</p>
                </article>

                <article class="flex gap-x-4">
                  @if (Auth::user()->name == 'admin')  
                    <a href="{{ route('prestamos.updateView', ['id' => $prestamo->id]) }}" class="mt-6 shadow text-white bg-indigo-500 hover:bg-indigo-600 font-medium rounded-lg px-5 py-2.5">
                        <i class="fa-regular fa-pen-to-square me-2"></i>
                        Editar
                    </a>
                    <a href="{{ route('prestamos.delete', ['id' => $prestamo->id]) }}" class="mt-6 shadow text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg px-5 py-2.5">
                        <i class="fa-regular fa-pen-to-square me-2"></i>
                        Eliminar
                    </a>
                  @endif

                  @if (!$prestamo->entregado)
                    <a href="{{ route('prestamos.entregar', ['id' => $prestamo->id]) }}" class="mt-6 shadow text-white bg-green-500 hover:bg-green-600 font-medium rounded-lg px-5 py-2.5">
                      <i class="fa-regular fa-hand"></i>
                      Entregar
                    </a>
                  @endif
                </article>
            </section>
          @else
            <h1 class="text-xl font-bold">El préstamo no existe</h1>
          @endif
      </div>
  </div>
</x-app-layout>