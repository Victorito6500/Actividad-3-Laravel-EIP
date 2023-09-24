<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLibroRequest;
use App\Http\Requests\UpdateLibroRequest;
use App\Models\Libro;
use Illuminate\Support\Facades\Session;

class LibroController extends Controller
{
  public function index(){
    $libros = Libro::all();

    return view('libros.index', ['libros' => $libros]);
  }

  public function get($id){
    $libro = Libro::find($id);
    
    return view('libros.libro', ['libro' => $libro]);
  }

  public function createView(){
    return view('libros.create-form');
  }

  public function create(CreateLibroRequest $request){
    $libro = Libro::create([
      'titulo'           => $request->titulo,
      'autor'            => $request->autor,
      'descripcion'      => $request->descripcion,
      'anio_publicacion' => $request->anio_publicacion,
      'genero'           => $request->genero,
      'disponible'       => $request->disponible
    ]);

    return redirect()->route('libros.index');
  }

  public function updateView($id){
    $libro = Libro::find($id);

    Session::put('id', $id);

    return view('libros.update-form', ['libro' => $libro]);
  }

  public function update(UpdateLibroRequest $request){
    $id = Session::pull('id');
    $libro = Libro::find($id);

    $libro->update([
      'titulo'           => $request->titulo,
      'autor'            => $request->autor,
      'descripcion'      => $request->descripcion,
      'anio_publicacion' => $request->anio_publicacion,
      'genero'           => $request->genero,
      'disponible'       => $request->disponible
    ]);

    return redirect()->route('libros.index');
  }

  public function delete($id){
    $libro = Libro::destroy($id);

    return redirect()->route('libros.index');
  }
}
