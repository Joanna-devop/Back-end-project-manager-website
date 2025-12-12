<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    use AuthorizesRequests;

    // The public list/search view
    public function index(Request $request)
{
    // Determine the column to search (default to title)
    $searchBy = $request->input('search_by', 'title');
    
    // Get the search term from the unified 'search' input
    $searchTerm = $request->input('search');

    $projects = Project::query();

    // Apply search filter if a search term is present
    if ($searchTerm) {
        $projects->where(function ($query) use ($searchBy, $searchTerm) {
            
            if ($searchBy === 'title') {
                // Search by title
                $query->where('title', 'like', '%' . $searchTerm . '%');
            } elseif ($searchBy === 'start_date') {
                // Search by exact date (date picker ensures correct format)
                $query->where('start_date', $searchTerm);
            }
        });
    }

    $projects = $projects->latest()->get();
        
    return view('projects.index', ['projects' => $projects]);
}

// 1. Returns the blank form view
public function create()
{
    // Renders the form for creating a project
    return view('projects.create');
}

// 2. Stores the data from the form
public function store(Request $request)
{
    // Validation:
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'short_description' => 'required|string',
        'phase' => 'required|in:design,development,testing,deployment,complete',
    ]);
    
    // Create the Project and set the owner (Authorisation)
    // Uses the relationship defined in User.php to set the 'uid' automatically.
    auth()->user()->projects()->create($validated); 
    
    // Redirect back to the list
        return redirect()->route('projects.index')->with('status', 'Project created successfully!');
    }

// Renders the form to edit an existing project
public function edit(Project $project)
{
    // If the user does not own the project, Laravel throws a 403 Forbidden error.
    $this->authorize('update', $project);

    return view('projects.edit', ['project' => $project]);
}

// Handles the submission of the edit form
public function update(Request $request, Project $project)
{
    // SECURITY CHECK: Apply the policy again before updating the database.
    $this->authorize('update', $project);

    // Validation
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'nullable|date|after_or_equal:start_date',
        'short_description' => 'required|string',
        'phase' => 'required|in:design,development,testing,deployment,complete',
    ]);

    // Update the record using Eloquent
    $project->update($validated);

    // Redirect back to the list
    return redirect()->route('projects.index')->with('status', 'Project updated successfully!');
}

public function destroy(Project $project)
{
    // 1. SECURITY CHECK: Ensure the user owns the project before deleting
    $this->authorize('delete', $project);

    // 2. Delete the record
    $project->delete();

    // 3. Redirect back to the list
    return redirect()->route('projects.index')->with('status', 'Project deleted successfully!');
}


}
