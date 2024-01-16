<?php

namespace App\Http\Controllers;

use App\Models\kost;
use Illuminate\Http\Request;

class KostController extends Controller
{
    public function index()
    {
        $kosts = Kost::all();
        return response()->json($kosts, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $kost = Kost::create([
            'name' => $request->name,
            'type' => $request->type,
            'photo' => $request->photo,
            'location' => $request->location,
            'price' => $request->price,
            'facilities' => $request->facilities,
        ]);

        return response()->json($kost, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kost  $kost
     * @return \Illuminate\Http\Response
     */
    public function show(kost $kost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kost  $kost
     * @return \Illuminate\Http\Response
     */
    public function edit(kost $kost)
    {
        //
    }

    public function update(Request $request)
    {
        
        $kost = Kost::find($request->id);

        if (!$kost) {
            return response()->json(['message' => 'Kost not found'], 404);
        }

        $kost->update([
            'name' => $request->name,
            'type' => $request->type,
            'photo' => $request->photo,
            'location' => $request->location,
            'price' => $request->price,
            'facilities' => $request->facilities,
        ]);

        return response()->json($kost, 200);
    }


    public function destroy(Request $request)
{
    if ($request->user()) {
        $id = $request->json()->get('id');
        $kost = Kost::find($id);

        if ($kost) {
            $kost->delete();
            return response()->json(["message" => "Data Kost Berhasil Dihapus!", "id" => $id], 200);
        } else {
            return response()->json(["message" => "Data Kost Tidak Ditemukan! id : $id"], 404);
        }
    } else {
        return response()->json(["message" => "Unauthorized"], 401);
    }
}

}
