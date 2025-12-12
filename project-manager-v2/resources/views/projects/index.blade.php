<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="GET" action="{{ route('projects.index') }}" class="mb-6 flex space-x-2 items-center">

                    <span class="text-sm font-medium text-gray-700">Search by:</span>
                    
                    <select name="search_by" id="search_by" onchange="toggleSearchInput(this.value)" 
                            class="border p-2 rounded flex-shrink-0 bg-gray-50 text-gray-700 w-32"> <option value="title" @selected(request('search_by') === 'title' || !request('search_by'))>Title</option>
                        <option value="start_date" @selected(request('search_by') === 'start_date')>Start Date</option>
                    </select>
                    
                    <input type="text" name="search_title" id="search_title" 
                        placeholder="Type the project title..." 
                        value="{{ request('search_by') === 'title' ? request('search') : '' }}"
                        class="border p-2 rounded flex-grow" 
                        style="{{ request('search_by') === 'start_date' ? 'display: none;' : '' }}">
                        
                    <input type="date" name="search_date" id="search_date" 
                        value="{{ request('search_by') === 'start_date' ? request('search') : '' }}"
                        class="border p-2 rounded flex-grow"
                        style="{{ request('search_by') === 'title' || !request('search_by') ? 'display: none;' : '' }}">

                    <button type="submit" class="bg-indigo-600 text-white p-2 rounded hover:bg-indigo-700">Search</button>
                    <a href="{{ route('projects.index') }}" class="text-gray-600 p-2">Clear</a>
                </form>

                <script>
                    function toggleSearchInput(searchType) {
                        const titleInput = document.getElementById('search_title');
                        const dateInput = document.getElementById('search_date');

                        if (searchType === 'title') {
                            titleInput.style.display = 'block';
                            dateInput.style.display = 'none';
                            dateInput.value = ''; // Clear the date when switching
                            titleInput.name = 'search';
                            dateInput.name = 'unused_date';
                        } else if (searchType === 'start_date') {
                            titleInput.style.display = 'none';
                            dateInput.style.display = 'block';
                            titleInput.value = ''; // Clear the title when switching
                            dateInput.name = 'search';
                            titleInput.name = 'unused_title';
                        }
                    }
                    
                    document.addEventListener('DOMContentLoaded', () => {
                        const selectedType = document.getElementById('search_by').value;
                        toggleSearchInput(selectedType);
                    });
                </script>

                <div class="mb-6">
                    <a href="{{ route('projects.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                        + Add New Project
                    </a>
                </div>

                <h3 class="text-lg font-bold mb-4">Project List</h3>
                
                @forelse ($projects as $project)
                    <div class="border p-4 mb-4 rounded-lg flex justify-between items-start">
    
                        <div class="flex-shrink-0 w-1/4 pr-4">
                            <div class="flex items-baseline space-x-1 mb-2">
                                <p class="text-sm font-medium text-gray-500">Project Title:</p>
                                <div class="text-xl font-semibold text-indigo-600">
                                    {{ $project->title }}
                                </div>
                            </div>
                            
                            <p class="text-sm font-medium text-gray-500">Start Day:</p>
                            <p class="text-base text-gray-700">
                                {{ $project->start_date }}
                            </p>

                            <p class="mt-3 text-xs font-medium text-purple-700">
                                Phase: {{ $project->phase }}
                            </p>
                        </div>

                        <div class="flex-grow pr-4 border-l border-r border-gray-100 pl-4 h-full">
                            <p class="text-sm font-medium text-gray-500 mb-1">Short Description:</p>
                            <p class="text-gray-700">{{ $project->short_description }}</p>
                        </div>
                        
                        @auth
                            @can('update', $project) 
                                <div class="flex-shrink-0 w-24 flex flex-col items-end space-y-2"> 
                                    
                                    <a href="{{ route('projects.edit', ['project' => $project->pid]) }}" 
                                    class="w-full text-center px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                                        Edit
                                    </a>
                                    
                                    <form method="POST" action="{{ route('projects.destroy', ['project' => $project->pid]) }}" class="w-full"> 
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Are you sure you want to delete this project?')"
                                                class="w-full text-center px-3 py-1 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endcan
                        @endauth
                        
                    </div>
                @empty
                    <p class="text-center text-gray-500">
                        No projects found matching your criteria.
                    </p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>