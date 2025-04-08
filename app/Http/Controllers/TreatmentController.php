<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexClients()
    {
        $treatments = Treatment::all();
        return view('clients.services')->with(['treats'=> $treatments]);

    }

    public function index()
    {
        $treatments = Treatment::all();
        return view('treatment.index', compact('treatments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('treatment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'price' => 'required|numeric',
            'pic' => 'required|image|mimes:jpg,jpeg,png,webp',
        ]);

        $data = $request->only(['description', 'price']);
        //dd($request->hasFile('pic'), $request->file('pic'));

            $file = $request->file('pic');
            $filename = time() . '-' . $file->getClientOriginalName();
            // Mover la imagen directamente a la carpeta public/storage/img_treat
            $file->move(public_path('storage/img_treat'), $filename);
            // Guardamos el nombre del archivo en la base de datos
            $data['pic'] = 'img_treat/' . $filename; // Ruta accesible desde la vista

            if(Treatment::create($data)){
                return redirect()->route('treatment.index')->with('createSuccess', 'Tratamiento creado correctamente.');

            }else{
                return redirect()->route('treatment.index')->with('createError', 'Error al crear el tratamiento');
            }
          }

    /**
     * Display the specified resource.
     */
    public function show(Treatment $treatment)
    {
        return view('treatment.show', compact('treatment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Treatment $treatment)
    {
        return view('treatment.edit', compact('treatment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Treatment $treatment)
    {
        $request->validate([
            'description' => 'required|string',
            'price' => 'required|numeric',
            'pic' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $data = $request->only(['description', 'price']);

        if ($request->hasFile('pic')) {
            $file = $request->file('pic');
            $filename = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('storage/img_treat'), $filename);

            $data['pic'] = 'img_treat/' . $filename;
        }

        $treatment->update($data);

        return redirect()->route('treatment.index')->with('UpdateSuccess', 'Tratamiento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return redirect()->route('treatment.index')->with('success', 'Tratamiento eliminado correctamente.');
    }
}
