<x-app-layout>
    <x-prestamo-form method="create" 
                  :actionRoute="route('prestamos.create')" 
                  titulo="Crear nuevo préstamo"
                  :users="$users"
                  :libros="$libros">
    </x-prestamo-form>
</x-app-layout>