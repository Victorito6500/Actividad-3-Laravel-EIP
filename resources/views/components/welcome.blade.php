<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
  <div class="flex items-center gap-x-6">
    <x-application-logo class="block h-12 w-auto" />

    <h1 class="text-2xl font-medium text-gray-900">
      ¡ Bienvenido a la Biblioteca Online !
    </h1>
  </div>  

  <p class="mt-6 text-gray-500 leading-relaxed">
    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repudiandae eveniet minima vero temporibus harum. Amet atque nemo illo vero magni unde qui eius dolor libero nam, doloribus placeat a quisquam dignissimos, tenetur similique eum et architecto exercitationem? Fugit quaerat est, quam, assumenda totam optio repudiandae, quod vero cumque velit quasi. Placeat qui praesentium nulla dicta magni eveniet sed porro sit?
  </p>
</div>


<div class="bg-gray-200 bg-opacity-25 p-6 lg:p-8">
  <div class="flex items-center justify-center gap-x-5">
    @guest
      <a href="{{ route('login') }}" class="text-sm shadow border border-indigo-600 text-indigo-600 hover:text-white hover:bg-indigo-600 rounded-lg px-5 py-2.5 text-center mr-2 mb-2">
        Iniciar Sesión
      </a>
      <a href="{{ route('register') }}" class="text-sm shadow border border-indigo-600 text-indigo-600 hover:text-white hover:bg-indigo-600 rounded-lg px-5 py-2.5 text-center mr-2 mb-2">
        Registrarse
      </a>
    @endguest
    @auth
      <a href="{{ route('prestamos.index') }}" class="text-sm shadow border border-indigo-600 text-indigo-600 hover:text-white hover:bg-indigo-600 rounded-lg px-5 py-2.5 text-center mr-2 mb-2">
        @if (Auth::user()->name == 'admin')
          Ver Préstamos
        @else
          Ver mis Préstamos
        @endif
      </a>
      <a href="{{ route('libros.index') }}" class="text-sm shadow border border-indigo-600 text-indigo-600 hover:text-white hover:bg-indigo-600 rounded-lg px-5 py-2.5 text-center mr-2 mb-2">
        Ver Libros
      </a>
    @endauth
  </div>
</div>