<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Menu - Gourmet Haven</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <!-- Navigation -->
    <nav class="bg-white shadow-md fixed w-full z-10 top-0">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="<?= base_url() ?>" class="text-2xl font-bold text-orange-600">Gourmet Haven</a>
            <div class="hidden md:flex space-x-6">
                <a href="<?= base_url() ?>" class="hover:text-orange-500">Home</a>
                <a href="<?= base_url('menu') ?>" class="text-orange-500 font-bold">Menu</a>
                <a href="<?= base_url('buffet') ?>" class="hover:text-orange-500">Buffet</a>
                <a href="<?= base_url('reservation') ?>" class="hover:text-orange-500">Reservation</a>
            </div>
            <a href="<?= base_url('login') ?>" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-full">Login</a>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-gray-800 text-white py-20 mt-16 text-center">
        <h1 class="text-4xl font-bold">Our Exquisite Menu</h1>
        <p class="mt-4 text-gray-400">Discover flavors that delight your senses</p>
    </header>

    <!-- Menu Content -->
    <div class="container mx-auto px-6 py-12">
        <!-- Categories -->
        <div class="flex justify-center space-x-4 mb-12">
            <button class="px-6 py-2 bg-orange-500 text-white rounded-full">All</button>
            <button class="px-6 py-2 bg-white text-gray-600 border border-gray-300 rounded-full hover:bg-orange-50 hover:text-orange-500">Starters</button>
            <button class="px-6 py-2 bg-white text-gray-600 border border-gray-300 rounded-full hover:bg-orange-50 hover:text-orange-500">Main Course</button>
            <button class="px-6 py-2 bg-white text-gray-600 border border-gray-300 rounded-full hover:bg-orange-50 hover:text-orange-500">Desserts</button>
            <button class="px-6 py-2 bg-white text-gray-600 border border-gray-300 rounded-full hover:bg-orange-50 hover:text-orange-500">Beverages</button>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Item 1 -->
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300">
                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Dish" class="w-full h-56 object-cover rounded-t-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-xl font-bold">Grilled Salmon</h3>
                        <span class="text-orange-500 font-bold">$25.00</span>
                    </div>
                    <p class="text-gray-600 text-sm">Fresh Atlantic salmon served with asparagus and lemon butter sauce.</p>
                </div>
            </div>
            <!-- Item 2 -->
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300">
                <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Dish" class="w-full h-56 object-cover rounded-t-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-xl font-bold">BBQ Ribs</h3>
                        <span class="text-orange-500 font-bold">$22.00</span>
                    </div>
                    <p class="text-gray-600 text-sm">Slow-cooked pork ribs glazed with our secret BBQ sauce.</p>
                </div>
            </div>
            <!-- Item 3 -->
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300">
                <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Dish" class="w-full h-56 object-cover rounded-t-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-xl font-bold">Vegetarian Pizza</h3>
                        <span class="text-orange-500 font-bold">$18.00</span>
                    </div>
                    <p class="text-gray-600 text-sm">Wood-fired pizza topped with fresh vegetables and mozzarella.</p>
                </div>
            </div>
            <!-- Item 4 -->
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300">
                <img src="https://images.unsplash.com/photo-1600891964092-4316c288032e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Dish" class="w-full h-56 object-cover rounded-t-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-xl font-bold">Steak Frites</h3>
                        <span class="text-orange-500 font-bold">$30.00</span>
                    </div>
                    <p class="text-gray-600 text-sm">Premium sirloin steak served with crispy french fries.</p>
                </div>
            </div>
            <!-- Item 5 -->
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300">
                <img src="https://images.unsplash.com/photo-1563379926898-05f4575a45d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Dish" class="w-full h-56 object-cover rounded-t-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-xl font-bold">Seafood Pasta</h3>
                        <span class="text-orange-500 font-bold">$24.00</span>
                    </div>
                    <p class="text-gray-600 text-sm">Linguine pasta tossed with shrimp, mussels, and calamari in marinara sauce.</p>
                </div>
            </div>
            <!-- Item 6 -->
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300">
                <img src="https://images.unsplash.com/photo-1551024709-8f23befc6f87?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Dish" class="w-full h-56 object-cover rounded-t-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-xl font-bold">Chocolate Lava Cake</h3>
                        <span class="text-orange-500 font-bold">$10.00</span>
                    </div>
                    <p class="text-gray-600 text-sm">Warm chocolate cake with a gooey center, served with vanilla ice cream.</p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
