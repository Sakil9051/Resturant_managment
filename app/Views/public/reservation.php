<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Table - Gourmet Haven</title>
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
                <a href="<?= base_url('buffet') ?>" class="hover:text-orange-500">Buffet</a>
                <a href="<?= base_url('reservation') ?>" class="text-orange-500 font-bold">Reservation</a>
            </div>
            <a href="<?= base_url('login') ?>" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-full">Login</a>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-gray-800 text-white py-20 mt-16 text-center">
        <h1 class="text-4xl font-bold">Book a Table</h1>
        <p class="mt-4 text-gray-400">Reserve your spot for an unforgettable dining experience</p>
    </header>

    <!-- Reservation Form -->
    <div class="container mx-auto px-6 py-12">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            
            <?php if(session()->getFlashdata('msg')):?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <?= session()->getFlashdata('msg') ?>
                </div>
            <?php endif;?>

            <form action="<?= base_url('reservation/book') ?>" method="post">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
                        <input type="text" name="name" class="border rounded w-full py-3 px-4 focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input type="email" name="email" class="border rounded w-full py-3 px-4 focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                        <input type="tel" name="phone" class="border rounded w-full py-3 px-4 focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Guests</label>
                        <select name="guests" class="border rounded w-full py-3 px-4 focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <option value="2">2 People</option>
                            <option value="3">3 People</option>
                            <option value="4">4 People</option>
                            <option value="5">5 People</option>
                            <option value="6">6 People</option>
                            <option value="7+">7+ People</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Date</label>
                        <input type="date" name="date" class="border rounded w-full py-3 px-4 focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Time</label>
                        <input type="time" name="time" class="border rounded w-full py-3 px-4 focus:outline-none focus:ring-2 focus:ring-orange-500" required>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Special Requests (Optional)</label>
                    <textarea name="notes" rows="4" class="border rounded w-full py-3 px-4 focus:outline-none focus:ring-2 focus:ring-orange-500"></textarea>
                </div>

                <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full w-full transition duration-300">
                    Confirm Reservation
                </button>
            </form>
        </div>
    </div>

</body>
</html>
