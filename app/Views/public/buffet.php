<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buffet - Gourmet Haven</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">

    <!-- Navigation -->
    <nav class="bg-white shadow-md fixed w-full z-10 top-0">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="<?= base_url() ?>" class="text-2xl font-bold text-orange-600">Gourmet Haven</a>
            <div class="hidden md:flex space-x-6">
                <a href="<?= base_url() ?>" class="hover:text-orange-500">Home</a>
                <a href="<?= base_url('menu') ?>" class="hover:text-orange-500">Menu</a>
                <a href="<?= base_url('buffet') ?>" class="text-orange-500 font-bold">Buffet</a>
                <a href="<?= base_url('reservation') ?>" class="hover:text-orange-500">Reservation</a>
            </div>
            <a href="<?= base_url('login') ?>" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-full">Login</a>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-gray-800 text-white py-20 mt-16 text-center">
        <h1 class="text-4xl font-bold">Unlimited Luxury Buffet</h1>
        <p class="mt-4 text-gray-400">Eat all you can from our premium selection</p>
    </header>

    <!-- Packages -->
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Lunch Package -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-orange-500 text-white text-center py-4">
                    <h3 class="text-2xl font-bold">Lunch Buffet</h3>
                    <p>12:00 PM - 3:00 PM</p>
                </div>
                <div class="p-8 text-center">
                    <p class="text-4xl font-bold text-gray-800 mb-4">$19.99 <span class="text-sm text-gray-500 font-normal">/ adult</span></p>
                    <p class="text-xl text-gray-600 mb-6">$9.99 <span class="text-sm text-gray-500 font-normal">/ child</span></p>
                    <ul class="text-left space-y-2 mb-8 mx-auto max-w-xs">
                        <li>✔ International Salads</li>
                        <li>✔ Live Pasta Station</li>
                        <li>✔ Grilled Meats</li>
                        <li>✔ Dessert Bar</li>
                        <li>✔ Unlimited Soft Drinks</li>
                    </ul>
                    <button onclick="openModal('Lunch')" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-full font-bold w-full">Book Lunch</button>
                </div>
            </div>

            <!-- Dinner Package -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gray-800 text-white text-center py-4">
                    <h3 class="text-2xl font-bold">Dinner Buffet</h3>
                    <p>6:00 PM - 10:00 PM</p>
                </div>
                <div class="p-8 text-center">
                    <p class="text-4xl font-bold text-gray-800 mb-4">$29.99 <span class="text-sm text-gray-500 font-normal">/ adult</span></p>
                    <p class="text-xl text-gray-600 mb-6">$14.99 <span class="text-sm text-gray-500 font-normal">/ child</span></p>
                    <ul class="text-left space-y-2 mb-8 mx-auto max-w-xs">
                        <li>✔ All Lunch Items</li>
                        <li>✔ Premium Seafood</li>
                        <li>✔ Carving Station (Roast Beef)</li>
                        <li>✔ Chocolate Fountain</li>
                        <li>✔ Live Music</li>
                    </ul>
                    <button onclick="openModal('Dinner')" class="bg-gray-800 hover:bg-gray-900 text-white px-8 py-3 rounded-full font-bold w-full">Book Dinner</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Modal -->
    <div id="bookingModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-8 w-full max-w-md relative">
            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">&times;</button>
            <h2 class="text-2xl font-bold mb-6">Book Buffet - <span id="modalTitle"></span></h2>
            <form action="<?= base_url('buffet/book') ?>" method="post">
                <input type="hidden" name="session" id="sessionInput">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" name="name" class="border rounded w-full py-2 px-3" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" class="border rounded w-full py-2 px-3" required>
                </div>
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Adults</label>
                        <input type="number" name="adults" class="border rounded w-full py-2 px-3" min="1" value="1" required>
                    </div>
                    <div class="w-1/2">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Children</label>
                        <input type="number" name="children" class="border rounded w-full py-2 px-3" min="0" value="0">
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Date</label>
                    <input type="date" name="date" class="border rounded w-full py-2 px-3" required>
                </div>
                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded w-full">Confirm Booking</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(session) {
            document.getElementById('modalTitle').innerText = session;
            document.getElementById('sessionInput').value = session;
            document.getElementById('bookingModal').classList.remove('hidden');
            document.getElementById('bookingModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('bookingModal').classList.add('hidden');
            document.getElementById('bookingModal').classList.remove('flex');
        }
    </script>

</body>
</html>
