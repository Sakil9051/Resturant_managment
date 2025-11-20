<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tables - RestoAdmin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
    </style>
</head>
<body class="bg-gray-50">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="w-64 gradient-bg text-white flex-shrink-0 shadow-2xl">
            <div class="p-6">
                <h1 class="text-2xl font-bold flex items-center">
                    <i class="fas fa-utensils mr-3"></i>
                    RestoAdmin
                </h1>
            </div>
            
            <nav class="mt-6">
                <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-home w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                <a href="<?= base_url('admin/tables') ?>" class="flex items-center px-6 py-3 bg-white bg-opacity-20 border-l-4 border-white">
                    <i class="fas fa-table w-5"></i>
                    <span class="ml-3">Tables</span>
                </a>
                <a href="<?= base_url('admin/reservations') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-calendar-check w-5"></i>
                    <span class="ml-3">Reservations</span>
                </a>
                <a href="<?= base_url('admin/menu') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-book-open w-5"></i>
                    <span class="ml-3">Menu</span>
                </a>
                <a href="<?= base_url('admin/buffet') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-birthday-cake w-5"></i>
                    <span class="ml-3">Buffet</span>
                </a>
                <a href="<?= base_url('admin/orders') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-shopping-cart w-5"></i>
                    <span class="ml-3">Orders</span>
                </a>
                <a href="<?= base_url('admin/kds') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-fire w-5"></i>
                    <span class="ml-3">KDS</span>
                </a>
                <a href="<?= base_url('admin/inventory') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-boxes w-5"></i>
                    <span class="ml-3">Inventory</span>
                </a>
                <a href="<?= base_url('admin/staff') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-users w-5"></i>
                    <span class="ml-3">Staff</span>
                </a>
                <a href="<?= base_url('admin/reports') ?>" class="flex items-center px-6 py-3 hover:bg-white hover:bg-opacity-10 transition-all duration-200">
                    <i class="fas fa-chart-bar w-5"></i>
                    <span class="ml-3">Reports</span>
                </a>
                <div class="border-t border-white border-opacity-20 mt-6 pt-6">
                    <a href="<?= base_url('logout') ?>" class="flex items-center px-6 py-3 hover:bg-red-500 hover:bg-opacity-20 transition-all duration-200">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span class="ml-3">Logout</span>
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm z-10">
                <div class="flex items-center justify-between px-8 py-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Table Management</h2>
                        <p class="text-sm text-gray-500 mt-1">Manage restaurant tables and seating layout</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="relative p-2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        <div class="flex items-center space-x-3 border-l pl-4">
                            <div class="w-10 h-10 rounded-full gradient-bg flex items-center justify-center text-white font-semibold">
                                A
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-800">Admin User</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-8">
                
                <div class="flex justify-end mb-6">
                    <button onclick="document.getElementById('addTableModal').classList.remove('hidden')" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-2 rounded-lg shadow-md transition-all flex items-center">
                        <i class="fas fa-plus mr-2"></i> Add New Table
                    </button>
                </div>

                <?php if(session()->getFlashdata('msg')):?>
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert">
                        <p class="font-bold">Success</p>
                        <p><?= session()->getFlashdata('msg') ?></p>
                    </div>
                <?php endif;?>

                <?php if(session()->getFlashdata('error')):?>
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm" role="alert">
                        <p class="font-bold">Error</p>
                        <p><?= session()->getFlashdata('error') ?></p>
                    </div>
                <?php endif;?>

                <!-- Table List -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-800">All Tables</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Table Number</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Seats</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach($tables as $table): ?>
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#<?= $table['id'] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900"><?= $table['table_number'] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600"><?= $table['seats'] ?> Seats</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            <?= $table['status'] == 'Available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                            <?= $table['status'] ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="<?= base_url('admin/tables/edit/' . $table['id']) ?>" class="text-blue-600 hover:text-blue-900 mr-3" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="openDeleteModal('<?= base_url('admin/tables/delete/' . $table['id']) ?>')" class="text-red-600 hover:text-red-900" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Live Floor Map -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Live Floor Map</h3>
                        <div class="space-x-2">
                            <button onclick="resetLayout()" class="text-sm text-gray-500 hover:text-gray-700 underline">Reset Layout</button>
                            <span class="text-xs text-gray-400">(Drag tables to rearrange)</span>
                        </div>
                    </div>
                    
                    <div id="floor-map" class="h-96 bg-gray-100 rounded-lg border-2 border-dashed border-gray-300 relative overflow-hidden" style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 20px 20px;">
                        <!-- Tables will be rendered here by JS -->
                    </div>
                </div>

                <script>
                    // Pass PHP data to JS
                    const tablesData = <?= json_encode($tables) ?>;
                    const floorMap = document.getElementById('floor-map');
                    let isDragging = false;
                    let currentTable = null;
                    let offset = { x: 0, y: 0 };

                    // Initialize Map
                    function initMap() {
                        const savedLayout = localStorage.getItem('resto_table_layout');
                        const layout = savedLayout ? JSON.parse(savedLayout) : {};

                        floorMap.innerHTML = ''; // Clear existing

                        tablesData.forEach((table, index) => {
                            const el = document.createElement('div');
                            el.className = `absolute w-24 h-24 rounded-full flex flex-col items-center justify-center shadow-md cursor-move transition-shadow hover:shadow-lg select-none ${
                                table.status === 'Available' ? 'bg-green-100 border-2 border-green-400 text-green-800' : 
                                (table.status === 'Reserved' ? 'bg-yellow-100 border-2 border-yellow-400 text-yellow-800' : 'bg-red-100 border-2 border-red-400 text-red-800')
                            }`;
                            
                            // Position
                            let pos = layout[table.id];
                            if (!pos) {
                                // Default grid positioning if no saved layout
                                const col = index % 6;
                                const row = Math.floor(index / 6);
                                pos = { x: 20 + (col * 120), y: 20 + (row * 120) };
                            }
                            
                            el.style.left = pos.x + 'px';
                            el.style.top = pos.y + 'px';
                            el.dataset.id = table.id;
                            
                            el.innerHTML = `
                                <i class="fas fa-utensils mb-1 opacity-50"></i>
                                <span class="font-bold text-lg">${table.table_number}</span>
                                <span class="text-xs">${table.seats} Seats</span>
                            `;

                            // Drag Events
                            el.addEventListener('mousedown', startDrag);
                            
                            floorMap.appendChild(el);
                        });
                    }

                    function startDrag(e) {
                        isDragging = true;
                        currentTable = e.currentTarget;
                        
                        // Calculate offset
                        const rect = currentTable.getBoundingClientRect();
                        const mapRect = floorMap.getBoundingClientRect();
                        
                        offset.x = e.clientX - rect.left;
                        offset.y = e.clientY - rect.top;
                        
                        currentTable.style.zIndex = 100; // Bring to front
                        
                        document.addEventListener('mousemove', drag);
                        document.addEventListener('mouseup', stopDrag);
                    }

                    function drag(e) {
                        if (!isDragging || !currentTable) return;
                        e.preventDefault();
                        
                        const mapRect = floorMap.getBoundingClientRect();
                        let x = e.clientX - mapRect.left - offset.x;
                        let y = e.clientY - mapRect.top - offset.y;
                        
                        // Boundary checks
                        x = Math.max(0, Math.min(x, mapRect.width - 96)); // 96 is width of table
                        y = Math.max(0, Math.min(y, mapRect.height - 96));
                        
                        currentTable.style.left = x + 'px';
                        currentTable.style.top = y + 'px';
                    }

                    function stopDrag() {
                        if (!isDragging || !currentTable) return;
                        
                        isDragging = false;
                        currentTable.style.zIndex = '';
                        
                        saveLayout();
                        currentTable = null;
                        
                        document.removeEventListener('mousemove', drag);
                        document.removeEventListener('mouseup', stopDrag);
                    }

                    function saveLayout() {
                        const layout = {};
                        const tables = floorMap.querySelectorAll('div[data-id]');
                        
                        tables.forEach(t => {
                            layout[t.dataset.id] = {
                                x: parseInt(t.style.left),
                                y: parseInt(t.style.top)
                            };
                        });
                        
                        localStorage.setItem('resto_table_layout', JSON.stringify(layout));
                    }

                    function resetLayout() {
                        if(confirm('Reset map layout to default?')) {
                            localStorage.removeItem('resto_table_layout');
                            initMap();
                        }
                    }

                    // Load map on start
                    document.addEventListener('DOMContentLoaded', initMap);
                </script>
            </main>
        </div>
    </div>

    <!-- Add Table Modal -->
    <div id="addTableModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 backdrop-blur-sm transition-all">
        <div class="bg-white rounded-xl shadow-2xl p-8 w-96 relative transform transition-all scale-100">
            <button onclick="document.getElementById('addTableModal').classList.add('hidden')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
            <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Add New Table</h2>
            <form action="<?= base_url('admin/tables/add') ?>" method="post">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Table Number</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-hashtag"></i>
                        </span>
                        <input type="text" name="table_number" class="pl-10 border border-gray-300 rounded-lg w-full py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="e.g. T-10" required>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Seats</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                            <i class="fas fa-chair"></i>
                        </span>
                        <input type="number" name="seats" class="pl-10 border border-gray-300 rounded-lg w-full py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" min="1" placeholder="Number of seats" required>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-3 px-4 rounded-lg shadow-md transition-all transform hover:-translate-y-0.5">
                    Save Table
                </button>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 backdrop-blur-sm transition-all">
        <div class="bg-white rounded-xl shadow-2xl p-8 w-96 relative transform transition-all scale-100">
            <button onclick="closeDeleteModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600"></i>
                </div>
                <h2 class="text-2xl font-bold mb-2 text-gray-800">Confirm Deletion</h2>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this item? This action cannot be undone.</p>
                <div class="flex space-x-4">
                    <button onclick="closeDeleteModal()" class="w-1/2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-4 rounded-lg transition-all">
                        Cancel
                    </button>
                    <a id="confirmDeleteBtn" href="#" class="w-1/2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold py-3 px-4 rounded-lg shadow-md transition-all transform hover:-translate-y-0.5 block">
                        Delete
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(deleteUrl) {
            document.getElementById('confirmDeleteBtn').href = deleteUrl;
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
        }
    </script>

</body>
</html>
