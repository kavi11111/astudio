<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\AttributeValue;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{
    public function index(): JsonResponse
    {
        $projects = Project::with('attributeValues.attribute')->get();
        return response()->json($projects);
    }

    // create a new project with dynamic attributes
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
            'attributes' => 'sometimes|array',
            'attributes.*.attribute_id' => 'required|exists:attributes,id',
            'attributes.*.value' => 'required|string',
        ]);
    
        // Create the project
        $project = Project::create($request->only('name', 'status'));

        if ($request->has('attributes')) {
            $attributes = $request->input('attributes', []);
    
            foreach ($attributes as $attribute) {
                AttributeValue::create([
                    'attribute_id' => $attribute['attribute_id'],
                    'entity_id' => $project->id,
                    'value' => $attribute['value'],
                ]);
            }
        }

        return response()->json($project->load('attributeValues.attribute'), 201);
    }

    // get a single project with its dynamic attributes
    public function show(Project $project): JsonResponse
    {
        return response()->json($project->load('attributeValues.attribute'));
    }

    // update a project and its dynamic attributes
    public function update(Request $request, Project $project): JsonResponse
    {
        $request->validate([
            'name' => 'sometimes|string',
            'status' => 'sometimes|string',
            'attributes' => 'sometimes|array',
            'attributes.*.attribute_id' => 'required|exists:attributes,id',
            'attributes.*.value' => 'required|string',
        ]);

        $project->update($request->only('name', 'status'));

        if ($request->has('attributes')) {
            foreach ($request->attributes as $attribute) {
                AttributeValue::updateOrCreate(
                    [
                        'attribute_id' => $attribute['attribute_id'],
                        'entity_id' => $project->id,
                    ],
                    [
                        'value' => $attribute['value'],
                    ]
                );
            }
        }

        return response()->json($project->load('attributeValues.attribute'));
    }

    // delete a project and its dynamic attributes
    public function destroy(Project $project): JsonResponse
    {
        $project->attributeValues()->delete();
        $project->delete();
        return response()->json(null, 204);
    }

    // filter projects by dynamic attributes
    public function filter(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'filters' => 'sometimes|array',
                'filters.*' => 'required|string',
            ]);

            $filters = $request->input('filters', []);
            $query = Project::query();

            foreach ($filters as $field => $value) {
                // check if the field contains any operators
                if (str_contains($field, ':')) {
                    [$field, $operator] = explode(':', $field);
                } else {
                    $operator = '=';
                }

                if (in_array($field, ['name', 'status'])) {
                    if ($operator === 'like') {
                        $query->where($field, 'like', "%$value%");
                    } else {
                        $query->where($field, $operator, $value);
                    }
                } else {
                    // apply filter for dynamic attributes(EAV)
                    $query->whereHas('attributeValues', function ($q) use ($field, $operator, $value) {
                        if ($operator === 'like') {
                            $q->where('value', 'like', "%$value%");
                        } else {
                            $q->where('value', $operator, $value);
                        }
                        $q->whereHas('attribute', function ($q) use ($field) {
                            $q->where('name', $field);
                        });
                    });
                }
            }

            $projects = $query->with('attributeValues.attribute')->paginate(10);
            return response()->json($projects);

        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation Error',
                'messages' => $e->errors(),
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while filtering projects.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
