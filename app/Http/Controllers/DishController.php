<?php

namespace App\Http\Controllers;

use App\Dish;
use App\Ingredients; 
use App\Http\Requests;
use App\Http\Resources\Dish as DishResource;
use Illuminate\Http\Request;

class DishController extends Controller
{

    public function __construct(){
        $this->middleware('jwt.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $dish = Dish::orderBy('name', 'ASC')->get();

        $dishes = Dish::orderBy('name', 'ASC')->with('ingredients')->get();

        return new DishResource($dishes);

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
        // validate inputs

        $validation = $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);

        // save data to db
        Dish::create($validation);

        // get id of dish item
        $dish = Dish::where('name', $request->name)->value('id');

        // set array of checkbox inputs
        $ingredients = $request->input('ingredient');

        // set dish item based on id
        $dish_item = Dish::findOrFail($dish);

        // attach ingredinet in db to dish item using belongsToMany eloquent relationship in Dish model
        $dish_item->ingredients()->attach($ingredients);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);

        $dish = Dish::findOrFail($id);

        $dish->update($request->all());

        // get id of dish item
        $dish = Dish::where('name', $request->name)->value('id');

        // set array of checkbox inputs
        $ingredients = $request->input('ingredient');

        // set dish item based on id
        $dish_item = Dish::findOrFail($id);

        // attach ingredinet in db to dish item using belongsToMany eloquent relationship in Dish model
        $dish_item->ingredients()->sync($ingredients);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // find dish based on id
        $dish = Dish::findOrFail($id);
 
        // delete dish with ingredient in pivot table dish_ingredients
        $dish->ingredients()->detach();

        // delete dish
        if ($dish->delete()) {
            return new DishResource($dish);
        }
    }
}
