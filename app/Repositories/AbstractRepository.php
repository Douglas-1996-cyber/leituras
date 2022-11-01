<?php 
namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository{
    public function __construct(Model $model){
        $this->model = $model;
    }

    public function verificarSolicitacao($codigo){
        
        $respostas = [
            0 => [
                'Sucesso',
                'alert-success'
            ], 
             1 => [
                'Já existe',
                'alert-danger'
             ],
             2 =>[
                'Não é possivel alterar',
                'alert-danger'
             ],
             3=>[
                'Dado excluido',
                'alert-success'
             ],
             4=> [
                'Numero de paginas maior do que o cadastrado ou o livro já foi concluido',
             'alert-danger'
            ],

             5=>[
                'Não foi possivel realizar a exclusão',
                 'alert-danger'
             ],
             6=>[
               'Erro na requisição',
                'alert-danger'
            ],
            7=>[
               'Não foi possivel Cadastrar',
               'alert-danger'
            ],
            ];
        try{
           return [$respostas[$codigo][0],$respostas[$codigo][1]]; 
        }catch(\ErrorException $e){
           return ['',''];
         }
         
        
    }
    public function buscar($campo,$pesquisa,$user_id){
      $busca = $this->model->where($campo,'like','%'.$pesquisa.'%')->where('user_id',$user_id)->paginate(2);
      return $busca; 
   }
}


?>