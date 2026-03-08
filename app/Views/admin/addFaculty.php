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
                    <a href="<?= base_url('dashboard/faculty') ?>" class="hover:text-blue-600 transition">Faculty</a> 
                    <span class="mx-2">/</span> 
                    <span class="text-gray-800 font-medium">Add New Faculty</span>
                </nav>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-blue-50/50">
                        <h3 class="text-xl font-bold text-blue-800">Faculty Registration</h3>
                        <p class="text-sm text-gray-600">Enter the details below to create a new faculty account for I-Track.</p>
                    </div>

                    <form action="<?= base_url('faculty/add') ?>" method="POST" class="p-8">
                        <?= csrf_field() ?>
                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-2">First Name</label>
                                <input type="text" name="first_name" id="first_name" value="<?= old('first_name') ?>"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                    placeholder="e.g. Juan" required>
                            </div>

                            <div>
                                <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-2">Last Name</label>
                                <input type="text" name="last_name" id="last_name" value="<?= old('last_name') ?>"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                    placeholder="e.g. Dela Cruz" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Username</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                        @
                                    </span>
                                    <input type="text" name="username" id="username" value="<?= old('username') ?>"
                                        class="w-full pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                        placeholder="juan.delacruz" required>
                                </div>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Initial Password</label>
                                <input type="password" name="password" id="password"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                    placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4 border-t border-gray-100 pt-6">
                            <a href="<?= base_url('faculty') ?>" 
                            class="px-6 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 transition">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-8 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md shadow-blue-200 transition-all transform active:scale-95">
                                Save Faculty Member
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