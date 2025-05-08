<?php

namespace App\Http\Controllers;

use App\Models\Istilah;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class IstilahController extends Controller
{
    /**
     * POST /istilah
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kata' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        $istilah = Istilah::create([
            'id' => Str::uuid(),
            'kata' => $validatedData['kata'],
            'deskripsi' => $validatedData['deskripsi']
        ]);

        return response()->json($istilah, 201);
    }

    /**
     * GET /istilah/{id}
     */
    public function show(string $id)
    {
        $istilah = Istilah::find($id);

        if (!$istilah) {
            return response()->json(['message' => 'Istilah not found'], 404);
        }

        return response()->json($istilah);
    }

    /**
     * PUT /istilah/{id}
     */
    public function update(Request $request, string $id)
    {
        $istilah = Istilah::find($id);

        if (!$istilah) {
            return response()->json(['message' => 'Istilah not found'], 404);
        }

        $validatedData = $request->validate([
            'kata' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        $istilah->update($validatedData);

        return response()->json($istilah);
    }

    /**
     * DELETE /istilah/{id}
     */
    public function destroy(string $id)
    {
        $istilah = Istilah::find($id);

        if (!$istilah) {
            return response()->json(['message' => 'Istilah not found'], 404);
        }

        $istilah->delete();
        return response()->json(['message' => 'Istilah deleted successfully']);
    }
}
