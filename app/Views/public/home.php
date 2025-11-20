<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gourmet Haven - Restaurant & Buffet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hero-bg {
            background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="font-sans text-gray-800">

    <!-- Navigation -->
    <nav class="bg-white shadow-md fixed w-full z-10 top-0">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-orange-600">Gourmet Haven</a>
            <div class="hidden md:flex space-x-6">
                <a href="#" class="hover:text-orange-500">Home</a>
                <a href="#menu" class="hover:text-orange-500">Menu</a>
                <a href="#buffet" class="hover:text-orange-500">Buffet</a>
                <a href="#reservation" class="hover:text-orange-500">Reservation</a>
                <a href="#contact" class="hover:text-orange-500">Contact</a>
            </div>
            <a href="<?= base_url('login') ?>" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-full">Login</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-bg h-screen flex items-center justify-center text-center text-white relative">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 px-6">
            <h1 class="text-5xl md:text-7xl font-bold mb-4">Experience the Taste of Luxury</h1>
            <p class="text-xl md:text-2xl mb-8">Premium Dining & Exquisite Buffet</p>
            <a href="#reservation" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-full text-lg font-semibold transition duration-300">Book a Table</a>
        </div>
    </header>

    <!-- Introduction -->
    <section class="py-20 container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-6 text-gray-800">Welcome to Gourmet Haven</h2>
        <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed">
            Located in the heart of the city, Gourmet Haven offers a unique dining experience with a blend of traditional flavors and modern culinary techniques. Whether you're here for our famous buffet or an intimate dinner, we promise an unforgettable meal.
        </p>
    </section>

    <!-- Menu Preview -->
    <section id="menu" class="py-20 bg-gray-100">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold mb-12 text-center text-gray-800">Our Specialties</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Item 1 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Dish" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Grilled Salmon</h3>
                        <p class="text-gray-600 mb-4">Fresh Atlantic salmon served with asparagus and lemon butter sauce.</p>
                        <span class="text-orange-500 font-bold text-lg">$25.00</span>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Dish" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">BBQ Ribs</h3>
                        <p class="text-gray-600 mb-4">Slow-cooked pork ribs glazed with our secret BBQ sauce.</p>
                        <span class="text-orange-500 font-bold text-lg">$22.00</span>
                    </div>
                </div>
                <!-- Item 3 -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Dish" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Vegetarian Pizza</h3>
                        <p class="text-gray-600 mb-4">Wood-fired pizza topped with fresh vegetables and mozzarella.</p>
                        <span class="text-orange-500 font-bold text-lg">$18.00</span>
                    </div>
                </div>
            </div>
            <div class="text-center mt-10">
                <a href="#" class="text-orange-500 font-semibold hover:underline">View Full Menu &rarr;</a>
            </div>
        </div>
    </section>

    <!-- Buffet Section -->
    <section id="buffet" class="py-20 container mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Buffet" class="rounded-lg shadow-lg">
            </div>
            <div class="md:w-1/2 md:pl-12">
                <h2 class="text-4xl font-bold mb-6 text-gray-800">Unlimited Luxury Buffet</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Indulge in our lavish buffet spread featuring over 50 dishes from around the world. From live cooking stations to a decadent dessert bar, there's something for everyone.
                </p>
                <ul class="mb-8 space-y-2 text-gray-700">
                    <li>✔ Lunch & Dinner Sessions</li>
                    <li>✔ International & Local Cuisines</li>
                    <li>✔ Unlimited Soft Drinks</li>
                    <li>✔ Special Kids Pricing</li>
                </ul>
                <a href="#" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-full text-lg font-semibold transition duration-300">Book Buffet Now</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-10" id="contact">
        <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4">Gourmet Haven</h3>
                <p class="text-gray-400">Experience the best dining in town.</p>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4">Contact Us</h3>
                <p class="text-gray-400">123 Food Street, Flavor Town</p>
                <p class="text-gray-400">Phone: (123) 456-7890</p>
                <p class="text-gray-400">Email: info@gourmethaven.com</p>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4">Opening Hours</h3>
                <p class="text-gray-400">Mon - Sun: 10:00 AM - 11:00 PM</p>
            </div>
        </div>
        <div class="text-center mt-10 border-t border-gray-700 pt-6 text-gray-500">
            &copy; 2025 Gourmet Haven. All rights reserved.
        </div>
    </footer>

</body>
</html>
