<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GeneralRecord;

class GeneralRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $general_records = GeneralRecord::doesntHave('parent_records')->get();

        return view('general_records.index', compact('general_records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('general_records.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $general_record = GeneralRecord::create($request->only(GeneralRecord::getTableColumnsNames()));

        return redirect()->route('general_records.index')->with('success', 'Запис успішно збережено');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $general_record = GeneralRecord::find($id);

        return view('general_records.edit', compact('general_record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $general_record = GeneralRecord::find($id);

        $general_record->update($request->only(array_keys($general_record->getAttributes())));

        return redirect()->route('general_records.index')->with('success', 'Запис успішно збережено');
    }
}
