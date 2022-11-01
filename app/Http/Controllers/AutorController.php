<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Autoria;
use App\Models\Livro;
use Illuminate\Http\Request;
use App\Repositories\AutorRepository;

class AutorController extends Controller
{
       public function __construct(Autor $autor){
        $this->autor = $autor;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $autores = $this->autor->where('user_id',$user_id)->get();
        $autorRepository = new AutorRepository($this->autor);
        if(isset($request->pesquisar)){
            $autores = $autorRepository->buscar('nome',$request->pesquisar,$user_id);
           }
        
        $result = $autorRepository->verificarSolicitacao($request->codigo);
        if(sizeof($request->all()) == 0){
            $result[0] = '';
            $result[1] = '';
        }
        
        return view('autor.index',['autores'=>$autores,'msg'=>$result[0],'classe'=>$result[1]]);
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
       $query = $this->autor->where('nome',$request->nome)->where('user_id',$user_id)->get(); 
       if(sizeof($query) == 0 ){
        $this->autor->nome = $request->nome;
        $this->autor->user_id = $user_id;
        try{
        $autor = $this->autor->save();
        }catch(\Exception $e){
        if($request->rota == 1){
          return redirect()->route('autor.index',['codigo'=>7]);
        }else if($request->rota == 2){
        return redirect()->route('livro.create',['codigo'=>7]);
        }  
        }
        $codigo= 0;
        if($request->rota == 1){
            return redirect()->route('autor.index',['codigo'=>$codigo]);
        }else if($request->rota == 2){
            return redirect()->route('livro.create',['codigo'=>$codigo]);
        }
        
       }
        return redirect()->route('autor.index',['codigo'=>$codigo]);
       if($request->rota == 2){
        return redirect()->route('livro.create',['codigo'=>$codigo]);
       }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  Autor
     * @return \Illuminate\Http\Response
     */
    public function show(Autor $autor)
    {
        $user_id = auth()->user()->id;
        if($autor->user_id != $user_id){
        return redirect()->route('autor.index',['codigo'=>6]); 
        }
        return view('autor.show',['autor'=>$autor]);
        
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Autor $autor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Autor $autor)
    {
        $user_id = auth()->user()->id;
        $codigo = 2;
        $query = $this->autor->where('nome',$request->nome)->where('user_id',$user_id)->get(); 
        if(sizeof($query) == 0 ){
            $this->autor->nome = $request->nome;
            $this->autor->user_id = $user_id;
            try{
            $autor->save(); 
           }catch(\Exception $e){
            return redirect()->route('autor.index',['codigo'=>$codigo]);
           }
            $codigo= 0;
            return redirect()->route('autor.index',['codigo'=>$codigo]);
        }
        return redirect()->route('autor.index',['codigo'=>$codigo]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Autor $autor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autor $autor)
    {
        $user_id = auth()->user()->id;
        //Verificar se há algum livro com o status Concluido ou Iniciado
        $autoria = Autoria::where('autor_id',$autor->id)->get(); 
        foreach($autoria as $a){
           $livros = Livro::where('id',$a->livro_id)->where('user_id',$user_id)->get();
            foreach($livros as $l){
           if($l->situacao == "Concluido" || $l->situacao == "Iniciado"){
            return redirect()->route('autor.index',['codigo'=>5]);
         }

        }
    }
     //Deletar
        foreach($autoria as $a){
            $livros = Livro::where('id',$a->livro_id)->where('user_id',$user_id)->get();
            foreach($livros as $l){
               $a->delete(); 
               $l->delete();
            }
           
        }

    
        $autor->delete();
        
        return redirect()->route('autor.index',['codigo'=>3]);
    }

}
