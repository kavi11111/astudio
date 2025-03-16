<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timesheet;
use Illuminate\Http\JsonResponse;

class TimesheetController extends Controller
{

    public function index(): JsonResponse
    {
        $timesheets = Timesheet::with(['user', 'project'])->get();
        return response()->json($timesheets);
    }

    public function show(Timesheet $timesheet): JsonResponse
    {
        return response()->json($timesheet->load(['user', 'project']));
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'task_name' => 'required|string',
            'date' => 'required|date',
            'hours' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
        ]);

        $timesheet = Timesheet::create($request->only([
            'task_name',
            'date',
            'hours',
            'user_id',
            'project_id',
        ]));

        return response()->json($timesheet->load(['user', 'project']), 201);
    }

    public function update(Request $request, Timesheet $timesheet): JsonResponse
    {
        $request->validate([
            'task_name' => 'sometimes|string',
            'date' => 'sometimes|date',
            'hours' => 'sometimes|numeric',
            'user_id' => 'sometimes|exists:users,id',
            'project_id' => 'sometimes|exists:projects,id',
        ]);

        $timesheet->update($request->only([
            'task_name',
            'date',
            'hours',
            'user_id',
            'project_id',
        ]));

        return response()->json($timesheet->load(['user', 'project']));
    }

    public function destroy(Timesheet $timesheet): JsonResponse
    {
        $timesheet->delete();
        return response()->json(['message' => 'Timesheet deleted successfully']);
    }

}
