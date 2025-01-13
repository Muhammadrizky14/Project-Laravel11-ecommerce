@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid gap-12 md:grid-cols-2">
            <!-- Left Column - Contact Info -->
            <div>
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-semibold">Call To Us</h2>
                        <p class="text-gray-600 mt-1">We are available 24/7, 7 days a week.</p>
                        <p class="text-gray-600 mt-1">Phone: +62987623461</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-semibold">Write To US</h2>
                        <p class="text-gray-600 mt-1">Fill out our form and we will contact you within 24 hours.</p>
                        <p class="text-gray-600 mt-1">Emails: customer@gmail.com</p>
                        <p class="text-gray-600">supportKkrist@yaho.com</p>
                    </div>
                </div>
            </div>

            <!-- Right Column - Contact Form -->
            <div>
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <input type="text" name="name" placeholder="Your Name *" class="w-full px-4 py-3 bg-gray-100 rounded-md focus:outline-none" required>
                        </div>
                        <div>
                            <input type="email" name="email" placeholder="Your Email *" class="w-full px-4 py-3 bg-gray-100 rounded-md focus:outline-none" required>
                        </div>
                        <div>
                            <input type="tel" name="phone" placeholder="Your Phone *" class="w-full px-4 py-3 bg-gray-100 rounded-md focus:outline-none" required>
                        </div>
                    </div>
                    <div>
                        <textarea name="message" rows="6" placeholder="Your Message" class="w-full px-4 py-3 bg-gray-100 rounded-md focus:outline-none"></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="bg-red-500 text-white px-8 py-3 rounded-md hover:bg-red-600 transition-colors">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection