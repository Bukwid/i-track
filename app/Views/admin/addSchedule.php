<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-Track | Add Schedule</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-50 flex h-screen overflow-hidden">

    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 transform -translate-x-full md:translate-x-0 md:static md:flex flex-col bg-blue-600 text-white transition-transform duration-300 ease-in-out">
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

    <main class="flex-1 flex flex-col overflow-y-auto md:ml-64">
        <header class="bg-white shadow-sm px-6 sm:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <button id="sidebarToggle" aria-label="Toggle menu" class="md:hidden p-2 flex flex-col gap-1 items-center justify-center w-10 h-10 bg-blue-600 rounded">
                    <span id="bar1" class="block w-6 h-0.5 bg-white transition-transform duration-300 origin-center"></span>
                    <span id="bar2" class="block w-6 h-0.5 bg-white transition-opacity duration-300"></span>
                    <span id="bar3" class="block w-6 h-0.5 bg-white transition-transform duration-300 origin-center"></span>
                </button>
                <h2 class="text-xl font-semibold text-gray-800">Faculty Schedule Overview</h2>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-500">Bula National High School</span>
                <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs">
                    BNHS
                </div>
            </div>
        </header>

        <div class="p-8">
            <div class="max-w-4xl mx-auto">
                <nav class="text-sm text-gray-500 mb-4">
                    <a href="<?= base_url('faculty') ?>" class="hover:text-blue-600 transition">Faculty</a> 
                    <span class="mx-2">/</span> 
                    <span class="text-gray-800 font-medium">Add Schedule</span>
                </nav>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 bg-blue-50/50">
                        <h3 class="text-xl font-bold text-blue-800">Schedule Registration</h3>
                        <p class="text-sm text-gray-600">Assign a specific time and location for the faculty member.</p>
                    </div>

                    <form action="<?= base_url('faculty/addSchedule') ?>" method="POST" class="p-8">
                        <?= csrf_field() ?>
                        
                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <input type="hidden" name="faculty_id" value="<?= $faculty_id ?>">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="day_of_week" class="block text-sm font-semibold text-gray-700 mb-2">Day of Week</label>
                                <select name="day_of_week" id="day_of_week" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                </select>
                            </div>

                            <div>
                                <label for="subject_name" class="block text-sm font-semibold text-gray-700 mb-2">Subject Name</label>
                                <input type="text" name="subject_name" id="subject_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="e.g. ICT Lihangin" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="start_time" class="block text-sm font-semibold text-gray-700 mb-2">Start Time</label>
                                <input type="time" name="start_time" id="start_time" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                            </div>

                            <div>
                                <label for="end_time" class="block text-sm font-semibold text-gray-700 mb-2">End Time</label>
                                <input type="time" name="end_time" id="end_time" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label for="location_id" class="block text-sm font-semibold text-gray-700 mb-2">Designated Room/Checkpoint</label>
                            <select name="location_id" id="location_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                                <option value="">Select Location...</option>
                                <?php foreach($locations as $loc): ?>
                                    <option value="<?= $loc['location_id'] ?>"><?= $loc['name'] ?> (<?= $loc['building'] ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="flex items-center justify-end space-x-4 border-t border-gray-100 pt-6">
                            <a href="<?= base_url('faculty') ?>" class="px-6 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 transition">Cancel</a>
                            <button type="submit" class="px-8 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg shadow-md shadow-blue-200 transition-all transform active:scale-95">
                                Save Schedule
                            </button>
                        </div>
                    </form>
                </div>

                <p class="text-center mt-6 text-xs text-gray-400 italic">
                    Bula National High School I-Track: Location-Aware Faculty Management.
                </p>
            </div>
        </div>

        <footer class="mt-auto py-4 text-center text-gray-400 text-xs">
            Non-GPS Tracking at Bula National High School | © 2026 I-Track
        </footer>
    </main>
</body>
</html>