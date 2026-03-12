<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-Track | Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-slate-*: initial;
            --color-blue-*: initial;
            --color-emerald-*: initial;
            --color-indigo-*: initial;
        }
    </style>
</head>
<body class="bg-slate-50 flex h-screen overflow-hidden text-slate-800">

    <!-- Mobile overlay -->
    <div id="mobileOverlay" class="fixed inset-0 bg-slate-900/50 z-30 hidden lg:hidden transition-opacity"></div>

    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 transform -translate-x-full lg:translate-x-0 lg:static flex flex-col bg-slate-900 text-white transition-transform duration-300 ease-in-out shadow-xl lg:shadow-none">
        <div class="p-6 text-2xl font-bold tracking-tight flex items-center justify-between gap-2 border-b border-slate-800">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center font-black text-sm">iT</div>
                <span>I-Track<span class="text-blue-400">.</span></span>
            </div>
            <button id="closeSidebar" class="lg:hidden text-slate-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <nav class="flex-1 px-4 space-y-2 mt-6 overflow-y-auto">
            <a href="<?= base_url('dashboard') ?>" class="flex items-center gap-3 p-3 rounded-xl transition-all <?= $page == 'Dashboard' ? 'bg-blue-600 shadow-md shadow-blue-900/20 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="<?= base_url('faculty') ?>" class="flex items-center gap-3 p-3 rounded-xl transition-all <?= $page == 'Faculty' ? 'bg-blue-600 shadow-md shadow-blue-900/20 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="font-medium">Faculty Members</span>
            </a>
            <a href="<?= base_url('location') ?>" class="flex items-center gap-3 p-3 rounded-xl transition-all <?= $page == 'Location' ? 'bg-blue-600 shadow-md shadow-blue-900/20 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="font-medium">Location Management</span>
            </a>
            <a href="<?= base_url('settings') ?>" class="flex items-center gap-3 p-3 rounded-xl transition-all <?= $page == 'Settings' ? 'bg-blue-600 shadow-md shadow-blue-900/20 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white' ?>">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="font-medium">Settings</span>
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800 flex flex-col gap-2">
            <div class="flex items-center gap-3 p-2 text-white">
                <div class="w-10 h-10 rounded-full bg-blue-500 shadow-lg flex items-center justify-center font-bold">A</div>
                <div>
                <p class="text-sm font-semibold">Admin User</p>
                <p class="text-xs text-slate-400">System Admin</p>
                </div>
            </div>
            <a href="<?= base_url('logout') ?>" class="flex items-center gap-3 p-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-xl transition-all w-full">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span class="font-medium">Logout</span>
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-y-auto">
        <header class="flex justify-between items-center p-6 lg:p-8 bg-slate-50 sticky top-0 z-20">
            <div class="flex items-center gap-4">
                <button id="openSidebar" class="lg:hidden p-2 -ml-2 text-slate-500 hover:bg-slate-100 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div>
                    <h1 class="text-2xl lg:text-3xl font-bold text-slate-800"><?= $page ?> Overview</h1>
                    <p class="text-sm lg:text-base text-slate-500 hidden sm:block">Welcome back to Bula National High School tracking.</p>
                </div>
            </div>
            
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-medium shadow-lg shadow-blue-200 transition-all active:scale-95 text-sm flex items-center gap-2">
                <span class="hidden sm:inline">Refresh Data</span>
                <svg class="w-4 h-4 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            </button>
        </header>

        <div class="px-6 lg:px-8 pb-8 flex-1">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-blue-50 rounded-bl-full -z-10 group-hover:scale-110 transition-transform"></div>
                    <p class="text-slate-500 text-sm font-medium">Total Faculty</p>
                    <div class="flex flex-col mt-1">
                        <h3 class="text-3xl font-bold text-slate-800"><?= $facultyCount ?></h3>
                        <span class="text-blue-500 text-xs font-bold bg-blue-50/50 px-2 py-1 rounded-lg mt-2 inline-block w-max">Active Members</span>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-indigo-50 rounded-bl-full -z-10 group-hover:scale-110 transition-transform"></div>
                    <p class="text-slate-500 text-sm font-medium">Active Locations</p>
                    <div class="flex flex-col mt-1">
                        <h3 class="text-3xl font-bold text-slate-800"><?= $locationCount ?></h3>
                        <span class="text-indigo-500 text-xs font-bold bg-indigo-50/50 px-2 py-1 rounded-lg mt-2 inline-block w-max">Monitored Zones</span>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-emerald-50 rounded-bl-full -z-10 group-hover:scale-110 transition-transform"></div>
                    <p class="text-slate-500 text-sm font-medium">System Status</p>
                    <div class="flex flex-col mt-1">
                        <h3 class="text-3xl font-bold text-slate-800">Online</h3>
                        <span class="text-emerald-500 text-xs font-bold bg-emerald-50 px-2 py-1 rounded-lg mt-2 inline-flex items-center gap-1 w-max">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Trackers Active
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden flex flex-col">
                <div class="p-6 md:p-8 border-b border-slate-100/80 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-slate-800">Recent Activity</h3>
                        <p class="text-sm text-slate-500 mt-1">Latest known locations of faculty members.</p>
                    </div>
                </div>
                
                <div class="overflow-x-auto p-6 md:p-8 pt-2 md:pt-4">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-slate-400 text-sm uppercase tracking-wider font-medium border-b border-slate-100">
                                <th class="pb-4 font-semibold px-2">Personnel Name</th>
                                <th class="pb-4 font-semibold px-2">Last Known Location</th>
                                <th class="pb-4 font-semibold px-2 text-right">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-slate-50">
                            <?php if(empty($currentLocations)): ?>
                                <tr>
                                    <td colspan="3" class="py-12 text-center text-slate-500 bg-slate-50/50 rounded-2xl border-dashed border-2 border-slate-100 mt-4">
                                        <div class="flex flex-col items-center justify-center gap-3">
                                            <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center text-slate-400">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                            </div>
                                            <p>No recent activity found.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($currentLocations as $location): ?>
                                    <tr class="hover:bg-slate-50/80 transition-colors group">
                                        <td class="py-4 px-2">
                                            <div class="flex items-center gap-3">
                                                <div class="w-9 h-9 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 font-semibold text-xs border border-slate-200 group-hover:bg-white transition-colors">
                                                    <?= substr($location['first_name'], 0, 1) . substr($location['last_name'], 0, 1) ?>
                                                </div>
                                                <span class="font-medium text-slate-700"><?= $location['last_name'] . ', ' . $location['first_name'] ?></span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-2">
                                            <div class="flex items-center gap-2 text-slate-600">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                <?= $location['location_name'] ?> 
                                                <span class="text-slate-300 mx-1">•</span> 
                                                <span class="text-slate-500 text-xs bg-slate-100 px-2 py-0.5 rounded-md"><?= $location['building'] ?></span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-2 text-right">
                                            <span class="inline-flex items-center gap-1.5 text-slate-500 text-xs bg-slate-50 border border-slate-100 px-2.5 py-1.5 rounded-lg group-hover:bg-white transition-colors whitespace-nowrap">
                                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                <?= $location['last_scanned'] ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
        <footer class="mt-8 py-4 text-center text-slate-400 text-sm flex items-center justify-center gap-2">
            <span>Non-GPS Tracking</span>
            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
            <span>Bula National High School</span>
            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
            <span>© 2026 I-Track</span>
        </footer>
        </div>

    </main>

    <script>
        // Sidebar toggle functionality
        const sidebar = document.getElementById('sidebar');
        const openSidebarBtn = document.getElementById('openSidebar');
        const closeSidebarBtn = document.getElementById('closeSidebar');
        const mobileOverlay = document.getElementById('mobileOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            mobileOverlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden', window.innerWidth < 1024 && !sidebar.classList.contains('-translate-x-full'));
        }

        openSidebarBtn.addEventListener('click', toggleSidebar);
        closeSidebarBtn.addEventListener('click', toggleSidebar);
        mobileOverlay.addEventListener('click', toggleSidebar);
        
        // Handle resize events to prevent body scroll locking on large screens
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                document.body.classList.remove('overflow-hidden');
            } else if (!sidebar.classList.contains('-translate-x-full')) {
                document.body.classList.add('overflow-hidden');
            }
        });
    </script>
</body>
</html>