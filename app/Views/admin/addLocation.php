<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-Track | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-50 flex h-screen overflow-hidden">

    <aside class="w-64 bg-blue-600 text-white flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-blue-700">
            I-Track
        </div>
        <nav class="flex-grow p-4 space-y-2">
            <a href="<?= base_url('dashboard') ?>" class="flex items-center p-3 rounded-lg hover:bg-blue-700 transition <?= $page == 'Dashboard' ? 'bg-blue-900' : '' ?>">
                <span class="ml-3">Dashboard</span>
            </a>
            <a href="<?= base_url('faculty') ?>" class="flex items-center p-3 rounded-lg hover:bg-blue-700 transition <?= $page == 'Faculty' ? 'bg-blue-900' : '' ?>">
                <span class="ml-3">Faculty Members</span>
            </a>
            <a href="<?= base_url('location') ?>" class="flex items-center p-3 rounded-lg hover:bg-blue-700 transition <?= $page == 'Location' ? 'bg-blue-900' : '' ?>">
                <span class="ml-3">Location Management</span>
            </a>
        </nav>
        <div class="p-4 border-t border-blue-700">
            <a href="<?= base_url('logout') ?>" class="text-sm text-blue-200 hover:text-white">Logout</a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto">
        
        <header class="bg-white shadow-sm px-8 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800"><?= $page ?> Overview</h2>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-500">Bula National High School</span>
                <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs"></div>
            </div>
        </header>
        <div class="p-8">
            <div class="max-w-4xl mx-auto">
                <nav class="text-sm text-gray-500 mb-4">
                    <a href="<?= base_url('location') ?>" class="hover:text-blue-600 transition">Location</a> 
                    <span class="mx-2">/</span> 
                    <span class="text-gray-800 font-medium">Add New Location</span>
                </nav>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-blue-50/50">
                        <h3 class="text-xl font-bold text-blue-800">Location Registration</h3>
                        <p class="text-sm text-gray-600">Enter the details below to create a new location for I-Track.</p>
                    </div>

                    <form action="<?= base_url('location/add') ?>" method="POST" class="p-8">
                        <?= csrf_field() ?>
                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="location_code" class="block text-sm font-semibold text-gray-700 mb-2">Location Code</label>
                                <input type="text" name="location_code" id="location_code" value="<?= old('location_code') ?>"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                    placeholder="SHSB1-CL1" required>
                            </div>

                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Location Name</label>
                                <input type="text" name="name" id="name" value="<?= old('name') ?>"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                    placeholder="Computer Laboratory 1" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mb-8">
                            <div>
                                <label for="building" class="block text-sm font-semibold text-gray-700 mb-2">Building</label>
                                <select name="building" id="building" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                                    <option value="SHS Building 1">SHS Building 1</option>
                                    <option value="SHS Building 1">SHS Building 2</option>
                                    <option value="SHS Building 1">SHS Building 3</option>
                                    <option value="SHS Building 1">SHS Building 4</option>
                                    <option value="SHS Building 1">SHS Building 5</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4 border-t border-gray-100 pt-6">
                            <a href="<?= base_url('location') ?>" 
                            class="px-6 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 transition">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-8 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md shadow-blue-200 transition-all transform active:scale-95">
                                Save Location
                            </button>
                        </div>
                    </form>
                </div>

                <p class="text-center mt-6 text-xs text-gray-400 italic">
                    Authorized personnel only. Data entered here is part of the Bula National High School tracking system.
                </p>
            </div>
        </div>

        <footer class="mt-auto py-4 text-center text-gray-400 text-xs">
            Non-GPS Tracking at Bula National High School | © 2026 I-Track
        </footer>
    </main>

</body>
</html>