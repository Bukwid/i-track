<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-Track | Add Faculty</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            <a href="<?= base_url('dashboard') ?>" class="flex items-center gap-3 p-3 rounded-xl transition-all text-slate-400 hover:bg-slate-800 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="<?= base_url('faculty') ?>" class="flex items-center gap-3 p-3 rounded-xl transition-all bg-blue-600 shadow-md shadow-blue-900/20 text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="font-medium">Faculty Members</span>
            </a>
            <a href="<?= base_url('location') ?>" class="flex items-center gap-3 p-3 rounded-xl transition-all text-slate-400 hover:bg-slate-800 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="font-medium">Location Management</span>
            </a>
            <a href="<?= base_url('settings') ?>" class="flex items-center gap-3 p-3 rounded-xl transition-all text-slate-400 hover:bg-slate-800 hover:text-white">
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
                    <h1 class="text-2xl lg:text-3xl font-bold text-slate-800">Add Faculty Member</h1>
                    <p class="text-sm lg:text-base text-slate-500 hidden sm:block">Register a new faculty account for I-Track</p>
                </div>
            </div>
        </header>

        <div class="p-6 lg:p-8 pt-0 flex-1">
            <div class="max-w-3xl mx-auto">
                <nav class="text-sm text-slate-500 mb-6 flex items-center gap-2">
                    <a href="<?= base_url('faculty') ?>" class="hover:text-blue-600 transition">Faculty</a> 
                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <span class="text-slate-800 font-medium">Add New Faculty</span>
                </nav>

                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-6 md:p-8 border-b border-slate-100">
                        <h3 class="text-xl font-bold text-slate-800">Faculty Registration</h3>
                        <p class="text-sm text-slate-500 mt-1">Enter the details below to create a new faculty account.</p>
                    </div>

                    <form action="<?= base_url('faculty/add') ?>" method="POST" class="p-6 md:p-8">
                        <?= csrf_field() ?>
                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 rounded-2xl flex items-center gap-3 font-medium">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="first_name" class="block text-sm font-semibold text-slate-700 mb-2">First Name</label>
                                <input type="text" name="first_name" id="first_name" value="<?= old('first_name') ?>"
                                    class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50/50"
                                    placeholder="e.g. Juan" required>
                            </div>

                            <div>
                                <label for="last_name" class="block text-sm font-semibold text-slate-700 mb-2">Last Name</label>
                                <input type="text" name="last_name" id="last_name" value="<?= old('last_name') ?>"
                                    class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50/50"
                                    placeholder="e.g. Dela Cruz" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div>
                                <label for="username" class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">@</span>
                                    <input type="text" name="username" id="username" value="<?= old('username') ?>"
                                        class="w-full pl-9 pr-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50/50"
                                        placeholder="juan.delacruz" required>
                                </div>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Initial Password</label>
                                <input type="password" name="password" id="password"
                                    class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50/50"
                                    placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">
                            <a href="<?= base_url('faculty') ?>" class="px-6 py-2.5 text-sm font-medium text-slate-500 hover:text-slate-800 transition rounded-xl hover:bg-slate-100">Cancel</a>
                            <button type="submit" class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-95">
                                Save Faculty Member
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <footer class="mt-8 py-4 text-center text-slate-400 text-sm flex items-center justify-center gap-2">
                <span>Non-GPS Tracking</span>
                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                <span>Bula National High School</span>
                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                <span>&copy; 2026 I-Track</span>
            </footer>
        </div>
    </main>

    <script>
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