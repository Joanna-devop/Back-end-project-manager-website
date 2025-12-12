<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="POST" action="{{ route('projects.store') }}">
                    @csrf 

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Project Title</label>
                        <input type="text" id="title" name="title" required 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" id="start_date" name="start_date" required 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    
                    <div class="mb-4">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date (Optional)</label>
                        <input type="date" id="end_date" name="end_date" 
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        @error('end_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="short_description" class="block text-sm font-medium text-gray-700">Short Description</label>
                        <textarea id="short_description" name="short_description" rows="3" required 
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <div class="mb-6">
                        <label for="phase" class="block text-sm font-medium text-gray-700">Project Phase</label>
                        <select id="phase" name="phase" required 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="design">Design</option>
                            <option value="development">Development</option>
                            <option value="testing">Testing</option>
                            <option value="deployment">Deployment</option>
                            <option value="complete">Complete</option>
                        </select>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Create Project
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>