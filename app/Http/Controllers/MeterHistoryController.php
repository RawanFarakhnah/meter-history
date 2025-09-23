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

        // Optional search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('status', 'like', "%{$search}%")
                  ->orWhere('reason', 'like', "%{$search}%");
        }

        $meterHistories = $query->latest()->paginate(20);
        return view('meter_histories.index', compact('meterHistories'));
    }

    // Show edit form
    public function edit(MeterHistory $meter_history)
    {
        return view('meter_histories.edit', compact('meter_history'));
    }

    // Update a record
    public function update(Request $request, MeterHistory $meter_history)
    {
        $request->validate([
            'status' => 'nullable|string',
            'reason' => 'nullable|string',
            'changed_date' => 'nullable|date',
            // Add other fields if needed
        ]);

        $meter_history->update($request->all());

        return redirect()->route('meter_histories.index')->with('success', 'Record updated successfully.');
    }

    // Delete a record
    public function destroy(MeterHistory $meter_history)
    {
        $meter_history->delete();
        return redirect()->route('meter_histories.index')->with('success', 'Record deleted successfully.');
    }

    // Show import form
    public function create()
    {
        return view('meter_histories.import'); // optional if using modal
    }

    // Handle import POST
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        $file = $request->file('file');

        if (!$file->isValid()) {
            return back()->withErrors(['file' => 'Invalid file upload']);
        }

        try {
            Excel::import(new MeterHistoriesImport, $file);
        } catch (\Exception $e) {
            return back()->with('message', 'Import failed: ' . $e->getMessage());
        }

        return back()->with('success', 'File imported successfully.');
    }

    // Download CSV of errors
    public function downloadErrorFile($file)
    {
        return response()->download(storage_path('app/' . $file));
    }
}
