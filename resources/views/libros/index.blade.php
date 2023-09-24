<x-app-layout>
  <x-slot name="header" >
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Lista de Libros') }}
      </h2>

      @if (Auth::user()->name == 'admin')
        <a href="{{ route('libros.createView') }}" class="text-sm shadow border border-indigo-500 text-indigo-500 hover:text-white hover:bg-indigo-500 rounded-lg px-4 py-2.5 text-center">
          <i class="fa-solid fa-plus me-2"></i>
          Crear nuevo libro
        </a>
      @endif
    </div>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col">
          <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
              <div class="overflow-hidden">
                <table class="min-w-full">
                  <thead class="bg-gray-200 border-b">
                    <tr>
                      <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-left">
                        Título
                      </th>
                      <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4 text-center">
                        Disponible
                      </th>
                      <th scope="col" class="text-sm font-semibold text-gray-900 px-6 py-4">
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($libros as $libro)
                      <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                          {{ $libro->titulo }}
                        </td>
                        <td class="text-sm text-gray-900 font-light px-6 py-4 text-center whitespace-nowrap">
                          @if ($libro->disponible === 1) Sí @else No @endif
                        </td>
                        <td class="text-gray-900 font-light px-6 py-4 flex gap-x-3 justify-end items-center whitespace-nowrap">
                          <a href="{{ route('libros.get', ['id' => $libro->id]) }}" class="text-xs shadow text-white bg-yellow-500 hover:bg-yellow-600 font-medium rounded-lg px-5 py-2.5">
                            <i class="fa-regular fa-eye me-2"></i>
                            Ver detalles
                          </a>
                          @if (Auth::user()->name == 'admin')
                            <a href="{{ route('libros.updateView', ['id' => $libro->id]) }}" class="text-xs shadow text-white bg-indigo-500 hover:bg-indigo-600 font-medium rounded-lg px-5 py-2.5">
                              <i class="fa-regular fa-pen-to-square me-2"></i>
                              Editar
                            </a>
                            <a href="{{ route('libros.delete', ['id' => $libro->id]) }}" class="text-xs shadow text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg px-5 py-2.5">
                              <i class="fa-regular fa-pen-to-square me-2"></i>
                              Eliminar
                            </a>
                          @endif
                        </td>
                      </tr>
                    @empty
                      <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                        <td colspan="3" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                          No existe ningún libro
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</x-app-layout>