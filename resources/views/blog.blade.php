@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Our Blog</h1>
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <!-- Sample blog post -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/blog/sample-post.jpg') }}" alt="Sample blog post" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Sample Blog Post Title</h2>
                    <p class="text-gray-600 mb-4">This is a brief excerpt from the blog post. It gives readers a quick overview of what the article is about.</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800">Read more</a>
                </div>
            </div>
            <!-- Add more blog posts here -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/blog/sample-post.jpg') }}" alt="Sample blog post" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Sample Blog Post Title</h2>
                    <p class="text-gray-600 mb-4">This is a brief excerpt from the blog post. It gives readers a quick overview of what the article is about.</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800">Read more</a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/blog/sample-post.jpg') }}" alt="Sample blog post" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Sample Blog Post Title</h2>
                    <p class="text-gray-600 mb-4">This is a brief excerpt from the blog post. It gives readers a quick overview of what the article is about.</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800">Read more</a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/blog/sample-post.jpg') }}" alt="Sample blog post" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Sample Blog Post Title</h2>
                    <p class="text-gray-600 mb-4">This is a brief excerpt from the blog post. It gives readers a quick overview of what the article is about.</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800">Read more</a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/blog/sample-post.jpg') }}" alt="Sample blog post" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Sample Blog Post Title</h2>
                    <p class="text-gray-600 mb-4">This is a brief excerpt from the blog post. It gives readers a quick overview of what the article is about.</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800">Read more</a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ asset('images/blog/sample-post.jpg') }}" alt="Sample blog post" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Sample Blog Post Title</h2>
                    <p class="text-gray-600 mb-4">This is a brief excerpt from the blog post. It gives readers a quick overview of what the article is about.</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800">Read more</a>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
