<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Livro;
use App\Models\Autoria;
use App\Models\Autor;
use App\Models\Genero;
use App\Repositories\LivroRepository;
use Illuminate\Http\Request;
use App\Services\PayUService\Exception;

class LivroController extends Controller
{

    public function __construct(Livro $livro){
        $this->livro = $livro;
      
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
        $user_id = auth()->user()->id;
        $livroRepository = new LivroRepository($this->livro);
        $livros = $this->livro->where('user_id',$user_id)->orderBy('created_at','desc')->paginate(3);
      
       if(isset($request->pesquisar)){
        $livros = $livroRepository->buscar('titulo',$request->pesquisar,$user_id);
        
       }
       
        
        $result = $livroRepository->verificarSolicitacao($request->codigo);
        if(sizeof($request->all()) == 0){
            $result[0] = '';
            $result[1] = '';  
        }
      
       
       
        return view('livro.index',['livros'=>$livros,'resquest'=>$request->all(), 'msg'=>$result[0],'classe'=>$result[1]]);
    }


 public function create(Request $request){
    $user_id = auth()->user()->id;
    $autores = Autor::where('user_id',$user_id)->orderBy('nome')->get();
    $generos = Genero::where('user_id',$user_id)->orderBy('nome')->get();
    $livroRepository = new LivroRepository($this->livro);
    $result = $livroRepository->verificarSolicitacao($request->codigo);
    if(sizeof($request->all()) == 0){
        $result[0] = '';
        $result[1] = '';
    }
    return view('livro.create',['autores'=>$autores,'generos'=>$generos,'msg'=>$result[0],'classe'=>$result[1]]);
 }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
       
        if(isset($request->capa)){
            $capa = $request->file('capa');
            $capa_urn = $capa->store('imagens/capa','public');
            $this->livro->capa = $capa_urn; 
            $request->validate($this->livro->rules(),$this->livro->feedback());  
        }
        if($request->lido){
        $this->livro->situacao = "Concluido" ;
        $this->livro->num_pags_lidos = $request->num_pags;
        $this->livro->progresso = 100;
        }
        $this->livro->titulo = $request->titulo;
        $this->livro->num_pags = $request->num_pags;
       
        $this->livro->genero_id = $request->genero_id;
        $this->livro->user_id = $user_id ;
        try{
        $livro = $this->livro->save(); 
        $autoria = Autoria::create(
        [
        'autor_id' => $request->autor_id,
        'livro_id' => $this->livro->id
        ]
        );
        $codigo= 0;
        }catch(\Exception $e){
            $codigo= 7;  
        }

       
        
        return redirect()->route('livro.index',['codigo'=>$codigo]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Livro $livro
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Livro $livro)
    {
        $user_id = auth()->user()->id;
        if($livro->user_id != $user_id){
        return redirect()->route('livro.index',['codigo'=>6]); 
        }
        $livroRepository = new LivroRepository($this->livro);
        $result = $livroRepository->verificarSolicitacao($request->codigo);
        if(sizeof($request->all()) == 0){
            $result[0] = '';
            $result[1] = '';
        }
        return view('livro.show',['livro'=>$livro,'msg'=>$result[0],'classe'=>$result[1]]);
    }
    public function update(Request $request, Livro $livro){
      if(isset($request->capa)){
        $capa = $request->file('capa');
        $capa_urn = $capa->store('imagens/capa','public');
        Storage::disk('public')->delete($livro->capa);
        $livro->capa = $capa_urn; 
        $request->validate($this->livro->rules(),$this->livro->feedback());  
      }
      $livro->titulo = $request->titulo;
      $livro->save();
      return redirect()->route('livro.index',['codigo'=>0]);

    }

    public function destroy(Livro $livro)
    {
       
        $autoria = Autoria::where('livro_id',$livro->id)->get(); 
        foreach($autoria as $c){
           $c->delete();
        }
        Storage::disk('public')->delete($livro->capa);
        try{
        $livro->delete();
        $codigo = 3;
        }catch(\Exception $e){
            $codigo = 6;  
        }
        
        return redirect()->route('livro.index',['codigo'=>$codigo]);
    }

    public function addPaginas(Request $request, Livro $livro){
       if($request->numPaginas > $livro->num_pags ||  $livro->num_pags_lidos + $request->numPaginas > $livro->num_pags || $livro->situacao=="Concluido" ){
        $codigo= 4;
        
        return redirect()->route('livro.show',['livro'=>$livro->id,'codigo'=>$codigo]);
       }

       $livro->num_pags_lidos += $request->numPaginas;
       if( $livro->num_pags == $livro->num_pags_lidos ){
        $livro->situacao = "Concluido";
        $livro->dt_final = date('Y-m-d');
       }
       $calc = ($livro->num_pags_lidos * 100)/$livro->num_pags;
       $livro->progresso = $calc;
       
       $livro->save();
       return redirect()->route('livro.show',['livro'=>$livro->id]);
    }

    public function iniciar(Livro $livro){
        if($livro->situacao == "Abandonado"){
         $livro->dt_final = null;
        }
         $livro->situacao = "Iniciado";
         $livro->dt_inicial = date('Y-m-d');
         try{
         $livro->save();
         $codigo= 0;
         
            }catch(\Exception $e){
                $codigo = 6;  
            }
         
         return redirect()->route('livro.show',['livro'=>$livro,'codigo'=>$codigo]);
    }

    public function desistir(Livro $livro){
        $livro->situacao = "Abandonado";
        $livro->dt_final = date('Y-m-d');
        try{
        $livro->save();
        $codigo= 0;
        }catch(\Exception $e){
         $codigo = 6;  
        }
        
        return redirect()->route('livro.show',['livro'=>$livro,'codigo'=>$codigo]);
    }

    public function reler(Livro $livro){
        $livro->situacao = "Iniciado";
        $livro->dt_inicial = date('Y-m-d');
        $livro->dt_final = null;
        $livro->num_pags_lidos = 0;
        $livro->progresso = 0.0;
        try{
        $livro->save();
        $codigo= 0;
        }catch(\Exception $e){
            $codigo = 6;  
        }
       
        return redirect()->route('livro.show',['livro'=>$livro,'codigo'=>$codigo]);
    }


    
}
