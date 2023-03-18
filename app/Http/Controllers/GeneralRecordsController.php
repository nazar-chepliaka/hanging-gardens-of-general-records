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

        return view('main_form', compact('general_records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    #[Route("/create", methods: ["GET"])]
    public function create()
    {
        //
    }
}
