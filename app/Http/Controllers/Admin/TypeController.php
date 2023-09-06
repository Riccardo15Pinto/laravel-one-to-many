<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.type.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $type = new Type();
        return view('admin.type.create', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data_new_type = $request->all();
        // dd($data_new_type);
        $request->validate(
            [
                'label' => 'required|string|max:30',
                'color' => 'nullable|regex:/^[0-9A-Fa-f]{6}$/',
            ],
            [
                'label.required' => 'Il nome della tipologia è obbligatorio',
                'label.max' => 'Il nome della tipologia è troppo lungo',
                'color.hex' => 'Il colore inserito non è un colore',
            ]
        );

        $type = new Type();
        $type->fill($data_new_type);
        $type->save();

        return to_route('admin.type.show', $type)->with('alert-type', 'success')->with('alert-message', "$type->label creato con successo");
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('admin.type.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.type.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        //
    }
}
