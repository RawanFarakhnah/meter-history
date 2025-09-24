<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MeterHistory;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MeterHistoriesImport;

class MeterHistoryController extends Controller
{
    // List all meter histories
   public function index(Request $request)
    {
        $query = MeterHistory::query();
        
        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('meter_number', 'like', "%{$search}%")
                  ->orWhere('community', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhere('reason', 'like', "%{$search}%");
            });
        }
        
        // Status filter
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Date filter
        if ($request->has('changed_date') && $request->changed_date != '') {
            $query->where('changed_date', $request->changed_date);
        }
        
        // Community filter
        if ($request->has('community') && $request->community != '') {
            $query->where('community', 'like', "%{$request->community}%");
        }
        
        // Meter number filter
        if ($request->has('meter_number') && $request->meter_number != '') {
            $query->where('meter_number', 'like', "%{$request->meter_number}%");
        }
        
        // Reason filter
        if ($request->has('reason') && $request->reason != '') {
            $query->where('reason', 'like', "%{$request->reason}%");
        }
        
        // Sorting
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');
        
        if (in_array($sort, ['id', 'meter_number', 'community', 'status', 'reason', 'changed_date'])) {
            $query->orderBy($sort, $direction);
        }
        
        $meterHistories = $query->paginate(10);
        
        return view('meter_histories.index', compact('meterHistories'));
    }

    // Show create form
    public function create()
    {
        return view('meter_histories.create');
    }

    // Store new record
    public function store(Request $request)
    {
        $request->validate([
            'meter_number' => 'required',
            'status' => 'required',
            'changed_date' => 'required|date',
        ]);

        MeterHistory::create($request->all());

        return redirect()->route('meter_histories.index')
            ->with('success', 'Meter history record created successfully.');
    }

    // Show single record
    public function show(MeterHistory $meterHistory)
    {
        return view('meter_histories.show', compact('meterHistory'));
    }

    // Show edit form
    public function edit(MeterHistory $meterHistory)
    {
        return view('meter_histories.edit', compact('meterHistory'));
    }

    // Update record
    public function update(Request $request, MeterHistory $meterHistory)
    {
        $request->validate([
            'meter_number' => 'required',
            'status' => 'required',
            'changed_date' => 'required|date',
        ]);

        $meterHistory->update($request->all());

        return redirect()->route('meter_histories.index')
            ->with('success', 'Meter history record updated successfully.');
    }

    // Delete record
    public function destroy(MeterHistory $meterHistory)
    {
        $meterHistory->delete();

        return redirect()->route('meter_histories.index')
            ->with('success', 'Meter history record deleted successfully.');
    }

    // Import records from Excel/CSV
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240', // 10MB max
        ]);
    
        try {
            $import = new MeterHistoriesImport();
            
            Excel::import($import, $request->file('file'));
            
            $importedCount = $import->getRowCount();
    
            return redirect()->route('meter_histories.index')
                ->with('success', "Successfully imported {$importedCount} records.");
                
        } catch (\Exception $e) {
            return redirect()->route('meter_histories.index')
                ->with('error', 'Error importing file: ' . $e->getMessage());
        }
    }
    
    // Download sample template
    public function downloadSample()
    {
        $filePath = storage_path('app/samples/meter_history_template.xlsx');
    
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'Sample file not found.');
        }
    
        return response()->download($filePath, 'meter_history_template.xlsx');
    }
}
