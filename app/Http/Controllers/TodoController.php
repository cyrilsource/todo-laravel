<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Categorie;
use App\Http\Resources\Categorie as CategorieResource;
use App\Todo;
use App\Http\Resources\Todo as TodoResource;


class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $todos = Categorie::with('todos')->get();

        $categories_todos = Categorie::pluck('name', 'id');

        return TodoResource::collection($todos);

        return CategorieResource::collection($categories_todos);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $categorie_id, $val)
    {
        $todo = new Todo;

        $todo->id = $request->input('todo_id');
        $todo->name = $val;
        $todo->categorie_id = $categorie_id;

        if($todo->save()) {
            return new TodoResource($todo);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);

        if ($todo->delete()) {
            return new TodoResource($todo);
        }
    }
}
