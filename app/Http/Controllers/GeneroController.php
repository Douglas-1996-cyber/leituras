<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Models\Livro;
use Illuminate\Http\Request;
use App\Repositories\GeneroRepository;
use App\Services\PayUService\Exception;


class GeneroController extends Controller
{

    public function __construct(Genero $genero){
        $this->genero = $genero;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $generos = $this->genero->where('user_id',$user_id)->get();
        $generoRepository = new GeneroRepository($this->genero);
        if(isset($request->pesquisar)){
            $generos = $generoRepository->buscar('nome',$request->pesquisar,$user_id);
           }

        $result = $generoRepository->verificarSolicitacao($request->codigo);
        if(sizeof($request->all()) == 0){
            $result[0] = '';
            $result[1] = '';
        }

        return view('genero.index',['generos'=>$generos,'msg'=>$result[0],'classe'=>$result[1]]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $codigo = 1;
        $query = $this->genero->where('nome',$request->nome)->where('user_id',$user_id)->get(); 
     
        if(sizeof($query) == 0 ){
            $this->genero->nome = $request->nome;
            $this->genero->user_id = $user_id;
         try{   
         $genero = $this->genero->save();
         }catch(\Exception $e){
            if($request->rota == 1){
                return redirect()->route('genero.index',['codigo'=>7]);
            }else if($request->rota == 2){
                return redirect()->route('livro.create',['codigo'=>7]);
            } 
         }
         $codigo= 0;
         if($request->rota == 1){
            return redirect()->route('genero.index',['codigo'=>$codigo]);
        }else if($request->rota == 2){
            return redirect()->route('livro.create',['codigo'=>$codigo]);
        }
         
        }
            return redirect()->route('genero.index',['codigo'=>$codigo]);
        if($request->rota == 2){
            return redirect()->route('livro.create',['codigo'=>$codigo]);
        }
   
        
    }

  /**
     * Display the specified resource.
     *
     * @param  Genero genero
     * @return \Illuminate\Http\Response
     */
    public function show( Genero $genero)
    {
       
    }


   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Genero $genero)
    {
    
        $user_id = auth()->user()->id;
      
        $query = $this->genero->where('nome',$request->nome)->get(); 
        if(sizeof($query) == 0 ){
            $genero->nome = $request->nome;
            $genero->user_id = $user_id;
            try{
            $genero->save(); 
            }catch(\Exception $e){
                return redirect()->route('genero.index',['codigo'=>2]);    
            }
          
            return redirect()->route('genero.index',['codigo'=>0]);
        }
        return redirect()->route('genero.index',['codigo'=>2]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genero  $genero
     * @return \Illuminate\Http\Response
     */
    public function destroy( Genero $genero)
    {
        $user_id = auth()->user()->id;
        $livro = Livro::where('genero_id',$genero->id)->where('user_id',$user_id)->get();
       
        if(sizeof($livro) == 0){
        $genero->delete();
        return redirect()->route('genero.index',['codigo'=>3]);
        }else{
         return redirect()->route('genero.index',['codigo'=>5]);
        }
    }
}
