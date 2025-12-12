<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project: ' . $project->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('projects.update', $project) }}">
                    @csrf 
                    @method('PATCH') 

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Project Title</label>
                        <input type="text" id="title" name="title" required 
                               value="{{ old('title', $project->title) }}" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" id="start_date" name="start_date" required 
                               value="{{ old('start_date', $project->start_date) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    
                    <div class="mb-4">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date (Optional)</label>
                        <input type="date" id="end_date" name="end_date" 
                               value="{{ old('end_date', $project->end_date) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('end_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="short_description" class="block text-sm font-medium text-gray-700">Short Description</label>
                        <textarea id="short_description" name="short_description" rows="3" required 
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('short_description', $project->short_description) }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label for="phase" class="block text-sm font-medium text-gray-700">Project Phase</label>
                        <select id="phase" name="phase" required 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach(['design', 'development', 'testing', 'deployment', 'complete'] as $phase)
                                <option value="{{ $phase }}" 
                                        @selected(old('phase', $project->phase) === $phase)>
                                    {{ ucfirst($phase) }}
                                </option>
                            @endforeach
                        </select>
                    </div>



                    <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-200">
                        
                        <form method="POST" action="{{ route('projects.update', $project) }}">
                            @csrf 
                            @method('PATCH') 
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 font-semibold">
                                Update Project
                            </button>
                        </form>
                        
                        <form method="POST" action="{{ route('projects.destroy', ['project' => $project->pid]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Are you sure you want to delete this project?')"
                                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 font-semibold">
                                Delete Project
                            </button>
                        </form>
                    </div>
                    


                </form>

            </div>
        </div>
    </div>
</x-app-layout>