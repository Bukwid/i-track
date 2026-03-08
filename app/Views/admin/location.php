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
            <?php if(session()->getFlashdata('error')): ?>
                <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('success')): ?>
                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-gray-700">Location List</h3>
                    <a href="<?= base_url('location/add') ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">+ Add Location</a>
                </div>
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-600 text-sm">
                        <tr>
                            <th class="p-4 font-semibold">Location Code</th>
                            <th class="p-4 font-semibold">Name</th>
                            <th class="p-4 font-semibold">Building</th>
                            <th class="p-4 font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        <?php if(!empty($locationList)): ?>
                            <?php foreach($locationList as $location): ?>
                                <tr>
                                    <td class="p-4 font-medium"><?= esc($location['location_code']) ?></td>
                                    <td class="p-4 text-gray-600"><?= esc($location['name']) ?></td>
                                    <td class="p-4 text-gray-600"><?= esc($location['building']) ?></td>
                                    <td>
                                        <a href="<?= base_url('location/delete/' . $location['location_id']) ?>" class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700">Delete</a>
                                        <a href="<?= base_url('location/get-qrcode/' . $location['location_id']) ?>" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700">QR Code</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-500">No location found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <footer class="mt-auto py-4 text-center text-gray-400 text-xs">
            Non-GPS Tracking at Bula National High School | © 2026 I-Track
        </footer>
    </main>

</body>
</html>