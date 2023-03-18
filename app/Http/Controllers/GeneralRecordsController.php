<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\GeneralRecords\FormGeneralRecordsRequest;

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
        $general_records = GeneralRecord::all();

        return view('general_records.create', compact('general_records'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormGeneralRecordsRequest $request)
    {
        $general_record = GeneralRecord::create($request->only(GeneralRecord::getTableColumnsNames()));

        if ($request->filled('parent_general_records_ids')) {
            $general_record->parent_records()->sync($request->parent_general_records_ids);
        }

        return redirect()->route('general_records.index')->with('success', 'Запис успішно збережено');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $general_record = GeneralRecord::find($id);
        $general_records = GeneralRecord::whereNotIn('id',array_merge([$id], $general_record->children_records->pluck('id')->toArray()))->get();

        return view('general_records.edit', compact('general_record', 'general_records'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormGeneralRecordsRequest $request, string $id)
    {
        $general_record = GeneralRecord::find($id);

        $general_record->parent_records()->sync([]);

        $general_record->update($request->only(array_keys($general_record->getAttributes())));

        if ($request->filled('parent_general_records_ids')) {
            $general_record->parent_records()->sync($request->parent_general_records_ids);
        }

        return redirect()->route('general_records.index')->with('success', 'Запис успішно збережено');
    }
}
