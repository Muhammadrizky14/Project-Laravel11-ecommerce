<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Create New Product</h1>
        @livewire('create-product')
    </div>
    
    @livewireScripts
</body>
</html>