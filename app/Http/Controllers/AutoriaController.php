<?php

namespace App\Http\Controllers;

use App\Models\Autoria;
use Illuminate\Http\Request;

class AutoriaController extends Controller
{
    public function __construct(Autoria $autoria){
        $this->autoria = $autoria;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autorias = $this->autoria->all();
        
        return $autorias;
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $autoria = $this->autoria->create($request->all());
        return $autoria;
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $autoria = $this->autoria->find($id);
        return $autoria;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   Illuminate\Http\Request 
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $autoria = $this->autoria->find($id);
        $autoria->update($request->all());
        return $autoria;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $autoria = $this->autoria->find($id);
        $autoria->delete();

        return ['msg' => 'Livro deletado'];
    }
}
