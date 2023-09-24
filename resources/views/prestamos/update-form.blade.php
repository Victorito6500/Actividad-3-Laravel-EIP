<x-app-layout>
    <x-prestamo-form method="update" 
                  :actionRoute="route('prestamos.update')" 
                  titulo="Editar préstamo"
                  :prestamo="$prestamo"
                  :users="$users"
                  :libros="$libros">
    </x-prestamo-form>
</x-app-layout>