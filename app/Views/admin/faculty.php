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

    <main class="flex-1 flex flex-col overflow-y-auto w-full">
        
        <header class="flex justify-between items-center p-6 lg:p-8 bg-slate-50 sticky top-0 z-20">
            <div class="flex items-center gap-4">
                <button id="openSidebar" class="lg:hidden p-2 -ml-2 text-slate-500 hover:bg-slate-100 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <div>
                    <h1 class="text-2xl lg:text-3xl font-bold text-slate-800"><?= $page ?> Overview</h1>
                    <p class="text-sm lg:text-base text-slate-500 hidden sm:block">Manage your faculty members</p>
                </div>
            </div>
        </header>

        <div class="p-6 lg:p-8 pt-0 flex-1 w-full max-w-full overflow-hidden">
            <?php if(session()->getFlashdata('error')): ?>
                <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 rounded-2xl flex items-center gap-3 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('success')): ?>
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl flex items-center gap-3 font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden flex flex-col w-full">
                <div class="p-6 md:p-8 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h3 class="text-xl font-bold text-slate-800">Faculty List</h3>
                    <a href="<?= base_url('faculty/add') ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-medium shadow-lg shadow-blue-200 transition-all active:scale-95 text-sm flex items-center gap-2 justify-center w-full sm:w-auto">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Add Faculty
                    </a>
                </div>
                <div class="overflow-x-auto p-6 md:p-8 pt-2 md:pt-4 w-full">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-slate-400 text-sm uppercase tracking-wider font-medium border-b border-slate-100">
                            <th class="pb-4 font-semibold px-2">Last Name</th>
                            <th class="pb-4 font-semibold px-2">First Name</th>
                            <th class="pb-4 font-semibold px-2">Username</th>
                            <th class="pb-4 font-semibold px-2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-slate-50">
                        <?php if(!empty($facultyList)): ?>
                            <?php foreach($facultyList as $faculty): ?>
                                <tr class="hover:bg-slate-50/80 transition-colors group">
                                    <td class="py-4 px-2 font-medium text-slate-700"><?= esc($faculty['last_name']) ?></td>
                                    <td class="py-4 px-2 text-slate-600"><?= esc($faculty['first_name']) ?></td>
                                    <td class="py-4 px-2 text-slate-600"><?= esc($faculty['username']) ?></td>
                                    <td class="py-4 px-2">
                                        <div class="flex flex-col xl:flex-row gap-2">
                                            <a href="<?= base_url('faculty/schedule/' . $faculty['faculty_id']) ?>" class="bg-amber-100 text-amber-700 hover:bg-amber-200 hover:text-amber-800 px-4 py-2 rounded-lg text-xs font-semibold transition-colors text-center inline-flex items-center justify-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> Schedule</a>
                                            <a href="<?= base_url('faculty/delete/' . $faculty['faculty_id']) ?>" class="bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 px-4 py-2 rounded-lg text-xs font-semibold transition-colors text-center inline-flex items-center justify-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="py-12 text-center text-slate-500 bg-slate-50/50 rounded-2xl border-dashed border-2 border-slate-100 mt-4">
                                    No faculty members found.
                                </td>
                            </tr>
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