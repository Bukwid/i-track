<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-Track | Settings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-slate-*: initial;
            --color-blue-*: initial;
            --color-emerald-*: initial;
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
            <a href="<?= base_url('faculty') ?>" class="flex items-center gap-3 p-3 rounded-xl transition-all text-slate-400 hover:bg-slate-800 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="font-medium">Faculty Members</span>
            </a>
            <a href="<?= base_url('location') ?>" class="flex items-center gap-3 p-3 rounded-xl transition-all text-slate-400 hover:bg-slate-800 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="font-medium">Location Management</span>
            </a>
            <a href="<?= base_url('settings') ?>" class="flex items-center gap-3 p-3 rounded-xl transition-all bg-blue-600 shadow-md shadow-blue-900/20 text-white">
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
                    <h1 class="text-2xl lg:text-3xl font-bold text-slate-800">Settings</h1>
                    <p class="text-sm lg:text-base text-slate-500 hidden sm:block">Manage your admin account credentials</p>
                </div>
            </div>
        </header>

        <div class="p-6 lg:p-8 pt-0 flex-1">
            <div class="max-w-3xl mx-auto">
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 rounded-2xl flex items-center gap-3 font-medium">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <?php if(session()->getFlashdata('success')): ?>
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-600 rounded-2xl flex items-center gap-3 font-medium">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <!-- Update Username -->
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden mb-6">
                    <div class="p-6 md:p-8 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-800">Update Username</h3>
                                <p class="text-sm text-slate-500 mt-0.5">Change your admin login username.</p>
                            </div>
                        </div>
                    </div>

                    <form action="<?= base_url('settings/username') ?>" method="POST" class="p-6 md:p-8">
                        <?= csrf_field() ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="current_username" class="block text-sm font-semibold text-slate-700 mb-2">Current Username</label>
                                <div class="w-full px-4 py-2.5 border border-slate-200 rounded-xl bg-slate-100 text-slate-500 text-sm">
                                    <?= esc($admin['username']) ?>
                                </div>
                            </div>
                            <div>
                                <label for="new_username" class="block text-sm font-semibold text-slate-700 mb-2">New Username</label>
                                <input type="text" name="new_username" id="new_username" value="<?= old('new_username') ?>"
                                    class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50/50"
                                    placeholder="Enter new username" required>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-95">
                                Update Username
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Update Password -->
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-6 md:p-8 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-800">Update Password</h3>
                                <p class="text-sm text-slate-500 mt-0.5">Change your admin login password.</p>
                            </div>
                        </div>
                    </div>

                    <form action="<?= base_url('settings/password') ?>" method="POST" class="p-6 md:p-8">
                        <?= csrf_field() ?>
                        <div class="space-y-6 mb-6">
                            <div>
                                <label for="current_password" class="block text-sm font-semibold text-slate-700 mb-2">Current Password</label>
                                <input type="password" name="current_password" id="current_password"
                                    class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50/50"
                                    placeholder="Enter current password" required>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="new_password" class="block text-sm font-semibold text-slate-700 mb-2">New Password</label>
                                    <input type="password" name="new_password" id="new_password"
                                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50/50"
                                        placeholder="Enter new password" required>
                                </div>
                                <div>
                                    <label for="confirm_password" class="block text-sm font-semibold text-slate-700 mb-2">Confirm New Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password"
                                        class="w-full px-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50/50"
                                        placeholder="Confirm new password" required>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-8 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-95">
                                Update Password
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
