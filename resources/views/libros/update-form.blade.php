<x-app-layout>
    <x-libro-form method="update" 
                  :actionRoute="route('libros.update')" 
                  titulo="Editar libro"
                  :libro="$libro">
    </x-libro-form>
</x-app-layout>