<?php

namespace App\Http\Controllers;

use App\Ingredients;
use App\Http\Requests;
use App\Http\Resources\Ingredients as IngredientsResource;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('jwt.auth');
    }

    public function index()
    {
        $ingredients = Ingredients::orderBy('name', 'ASC')->get();

        return new IngredientsResource($ingredients);
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
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required|unique:ingredients'
        ]);

        $ingredient = Ingredients::create($validation);

        return new IngredientsResource($ingredient);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ingredients  $ingredients
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredients $ingredients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ingredients  $ingredients
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredients $ingredients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ingredients  $ingredients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ingredient = Ingredients::findOrFail($id);

        $ingredient->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ingredients  $ingredients
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Ingredients $ingredients)
    {
        $ingredient = Ingredients::findOrFail($id);

        if ($ingredient->delete()) {
            return new IngredientsResource($ingredient);
        }
    }
}
