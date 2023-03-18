<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GeneralRecord;

class GeneralRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[Route("/", methods: ["GET"])]
    public function index()
    {
        $general_records = GeneralRecord::doesntHave('parent_records')->get();

        return view('general_records.index', compact('general_records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    #[Route("/create", methods: ["GET"])]
    public function create()
    {
        return view('general_records.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    #[Route("/", methods: ["POST"])]
    public function store(Request $request)
    {
        $general_record = GeneralRecord::create($request->only(GeneralRecord::getTableColumnsNames()));

        return redirect()->route('general_records.index')->with('success', 'Запис успішно збережено');
    }
}
