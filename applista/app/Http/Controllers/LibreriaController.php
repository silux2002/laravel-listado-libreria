<?php
namespace App\Http\Controllers;

use App\Models\Recurso;
use Illuminate\Http\Request;

class LibreriaController extends Controller
{
    function enlaces(){
        return '
        <a href="' . url('libros/index') . '">index</a>
        <a href="' . url('libros/create') . '">create</a>
        <a href="' . url('libros/store') . '">store</a>
        <a href="' . url('libros/show/1') . '">show</a>
        <a href="' . url('libros/{{$request}}/edit') . '">edit</a>
        <a href="' . url('libros/update/3') . '">update</a>
        <a href="' . url('libros/destroy/4') . '">destroy</a>';
    }
    
//--------------------------------------------------------------------    
    
    public function index(request $request)
    {
        $biblioteca = [];
        /*Esto sirve para si existe resource nos muestre el array de los elementos*/
        if($request->session()->exists('biblioteca')) {
            $biblioteca=$request->session()->get('biblioteca');/*Obtenemos el array de recursos*/
        }else{
             $biblioteca = [];
             $request->session()->put('biblioteca',$biblioteca);
        }
        $empresa= 'Libraria S.L';
            
        $zip=[];
        
        $zip['biblioteca'] = $biblioteca;
        $zip['empresa']= $empresa;
        if($request->session()->exists('biblioteca')) {
            $zip['alerta'] = $request->session()->get('alerta');
        return view('accion.lista', $zip);}
    }

//--------------------------------------------------------------------

    public function create(request $request){
        $empresa= 'Libraria S.L';
        
        $zip=[];
        
        $zip['empresa'] = $empresa;
        
        $biblioteca = [];
        //-------------------
        
        
        if($request->session()->exists('biblioteca')) {
            $biblioteca=$request->session()->get('biblioteca');/*Obtenemos el array de recursos*/
        }
        
        $indice = 0;
        
        if (count($biblioteca) >= 1){
            
            foreach ($biblioteca as $val) {
                if ($val['id'] > $indice) {
                    $indice = $val['id'];
                }
            }
        }
        
        $zip['id'] = $indice;
        
        
        
        
        return view('accion.create', $zip);
        
    } //create [C] , muestra el formulario {la veremos}
    
//--------------------------------------------------------------------
    
    public function store(Request $request){
        $id=$request->input('id');
        $name=$request->input('name');
        $precio=$request->input('precio');
        $id= $id + 1;
        
        
        $biblioteca = [];/*Declaramos el array vacio*/
        /*Comprobamos si la sesion existe para almacenar los datos en la ya creada o crear una nueva para almacenarlos*/
        if($request->session()->exists('biblioteca')) {
            $biblioteca=$request->session()->get('biblioteca');/*Obtenemos el array de recursos*/
        }
        $libro = ['id' => $id, 'name' => $name, 'precio' => $precio];/*Creamos un array de resource con los siguientes parametros*/
        /*Esto lo hacemos para ver si en la posición donde vamos a guardar el id existe ya otro id*/
        if(isset($biblioteca[$id])){
            return back()->withInput();/*Lo que hacemos es que si existe esa posoicon nos devuelva para atras, volvemos a cargar la pagina*/
        } else {
           $biblioteca[$id]=$libro;/*Aqui especificamos la posición en la que metemos el objeto dentro del array*/ 
        }
    
    
        $request->session()->put('biblioteca',$biblioteca);/*Metemos en la sesion el array de recursos*/
        return redirect('libros')->with('alerta', 'se ha insertado el elemento correctamente');
        
        //Validación
        return 'store: ' . $id . ' ' . $name;
    }
    public function edit(Request $request, $id)
    {
        if($request->session()->exists('biblioteca') && isset($request->session()->get('biblioteca')[$id])){
            $biblioteca = $request->session()->get('biblioteca')[$id];
            $zip['libro'] = $biblioteca;
            $zip['empresa'] = 'Libraria S.L';
            return view('accion.edit', $zip);
        }else{
            return redirect('404');
        }
    }
    
    public function update(Request $request, $id)
    {
        if($request->session()->exists('biblioteca')){
            $biblioteca = $request->session()->get('biblioteca');
            if(isset($biblioteca[$id])){
                $libro = $biblioteca[$id];
                $idInput=$request->input('id');
                $nameInput=$request->input('name');
                $precioInput=$request->input('precio');
                $libro['id'] = $idInput;
                $libro['name'] = $nameInput;
                $libro['precio'] = $precioInput;
                if(isset($biblioteca[$idInput]) && $id != $idInput){
                    return back()->withInput();
                    
                }
                unset($biblioteca[$id]);
                $biblioteca[$idInput] = $libro;
                $request->session()->put('biblioteca', $biblioteca);
                return redirect('libros')->with('alerta', 'se ha insertado el elemento correctamente');
            }
        }
        return back()->withInput();
    }
    public function destroy(request $request, $id){
        $alerta = 'No se ha borrado el elemento correctamente.';
        $type = 'danger';
        if($request->session()->exists('biblioteca')) {
            $biblioteca = $request->session()->get('biblioteca');
            if(isset($biblioteca[$id])){
                unset($biblioteca[$id]);
                $request->session()->put('biblioteca', $biblioteca);
                $alerta = 'se ha borrado el elemento correctamente.';
                $type = 'success';
            }
        }
        $zip= [];
        $zip['alerta'] = $alerta;
        $zip['type'] = $type;
        return redirect('libros')->with('alerta', $alerta);
    }
    public function error404() {
        return view('404');
    }
}