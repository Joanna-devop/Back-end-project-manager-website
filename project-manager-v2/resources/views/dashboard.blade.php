<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Welcome to Project Manager') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
                
                <h3 class="text-3xl font-extrabold text-gray-900 mb-2">
                    Hello, {{ Auth::user()->name }}!
                </h3>
                
                <p class="text-lg text-gray-600 mb-8">
                    This is your action hub. Get started quickly by launching a new project!
                </p>

                <a href="{{ route('projects.create') }}" 
                   class="inline-block px-8 py-3 bg-indigo-600 text-white font-bold text-xl uppercase tracking-wider rounded-lg shadow-lg hover:bg-indigo-700 transition duration-150">
                    🚀 Start a New Project
                </a>

                <p class="mt-8 pt-4 border-t border-gray-200 text-sm text-gray-500">
                    Need to review past work? You can view all projects <a href="{{ route('projects.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium underline">here</a>.
                </p>

            </div>
        </div>
    </div>
</x-app-layout>