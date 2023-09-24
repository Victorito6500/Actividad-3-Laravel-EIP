<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePrestamoRequest;
use App\Http\Requests\UpdatePrestamoRequest;
use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\User;
use App\Rules\CheckLibroRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class PrestamoController extends Controller
{
  public function index(){
    if (Auth::user()->name == 'admin'){
      $prestamos = Prestamo::select('prestamos.*', 'users.name', 'libros.titulo')
                             ->join('users', 'prestamos.user_id', '=', 'users.id')
                             ->join('libros', 'prestamos.libro_id', '=', 'libros.id')
                             ->get();
    } else {
      $prestamos = Prestamo::select('prestamos.*', 'users.name', 'libros.titulo')
                             ->join('users', 'prestamos.user_id', '=', 'users.id')
                             ->join('libros', 'prestamos.libro_id', '=', 'libros.id')
                             ->where('users.id', '=', Auth::user()->id)
                             ->get();
    }

    return view('prestamos.index', ['prestamos' => $prestamos]);
  }

  public function get($id){
    if (Auth::user()->name == 'admin'){
      $prestamo = Prestamo::select('prestamos.*', 'users.name', 'libros.titulo')
                            ->join('users', 'prestamos.user_id', '=', 'users.id')
                            ->join('libros', 'prestamos.libro_id', '=', 'libros.id')
                            ->where('prestamos.id', '=', $id)
                            ->first();
    } else {
      $prestamo = Prestamo::select('prestamos.*', 'users.name', 'libros.titulo')
                             ->join('users', 'prestamos.user_id', '=', 'users.id')
                             ->join('libros', 'prestamos.libro_id', '=', 'libros.id')
                             ->where('prestamos.id', '=', $id)
                             ->where('users.id', '=', Auth::user()->id)
                             ->first();
    }
    
    return view('prestamos.prestamo', ['prestamo' => $prestamo]);
  }

  public function createView(){
    $users = User::all();
    $libros = Libro::all();

    return view('prestamos.create-form', ['users' => $users, 'libros' => $libros]);
  }

  public function create(CreatePrestamoRequest $request){
    $prestamo = Prestamo::create([
      'user_id'                   => $request->user_id,
      'libro_id'                  => $request->libro_id,
      'fecha_prestamo'            => $request->fecha_prestamo,
      'fecha_devolucion_estimada' => $request->fecha_devolucion_estimada,
      'entregado'                 => $request->entregado
    ]);

    if (!$prestamo->entregado){
      $libro = Libro::find($request->libro_id);
      $libro->update([
        'disponible' => 0
      ]);
    }else{
      $prestamo->update([
        'fecha_devolucion' => date('Y-m-d')
      ]);
    }

    return redirect()->route('prestamos.index');
  }

  public function updateView($id){
    $prestamo = Prestamo::find($id);
    $users = User::all();
    $libros = Libro::all();

    Session::put('id', $id);

    return view('prestamos.update-form', ['prestamo' => $prestamo, 'users' => $users, 'libros' => $libros]);
  }

  public function update(UpdatePrestamoRequest $request){
    $id = Session::pull('id');
    $prestamo = Prestamo::find($id);

    if ($request->libro_id != $prestamo->libro_id){
      $checkLibro = $request->validate([
        'libro_id' => [new CheckLibroRule]
      ]);
      
      $libro = Libro::find($prestamo->libro_id);
      $libro->update([
        'disponible' => 1
      ]);

      $libro = Libro::find($request->libro_id);
      $libro->update([
        'disponible' => 0
      ]);
    }

    $prestamo->update([
      'user_id'                   => $request->user_id,
      'libro_id'                  => $request->libro_id,
      'fecha_prestamo'            => $request->fecha_prestamo,
      'fecha_devolucion_estimada' => $request->fecha_devolucion_estimada,
      'entregado'                 => $request->entregado
    ]);

    if ($prestamo->entregado){
      $prestamo->update([
        'fecha_devolucion' => date('Y-m-d')
      ]);

      $libro = Libro::find($request->libro_id);
      $libro->update([
        'disponible' => 1
      ]);
    }else{
      $libro = Libro::find($request->libro_id);
      $libro->update([
        'disponible' => 0
      ]);
    }

    return redirect()->route('prestamos.index');
  }

  public function entregar($id){
    if (Auth::user()->name == 'admin'){
      $prestamo = Prestamo::find($id);
    } else {
      $prestamo = Prestamo::select('prestamos.*')
                            ->where('prestamos.id', '=', $id)
                            ->where('prestamos.user_id', '=', Auth::user()->id)
                            ->first();
    }

    if ($prestamo == null) {
      return redirect()->route('home');
    }

    $prestamo->update([
      'fecha_devolucion' => date('Y-m-d'),
      'entregado' => 1
    ]);

    $libro = Libro::find($prestamo->libro_id);
    $libro->update([
      'disponible' => 1
    ]);

    return redirect()->route('prestamos.index');
  }

  public function delete($id){
    $prestamo = Prestamo::destroy($id);

    return redirect()->route('prestamos.index');
  }

}
