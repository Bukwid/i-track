<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-Track | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
        @theme {
            --color-slate-*: initial;
            --color-blue-*: initial;
        }
    </style>
</head>
<body class="bg-slate-50 flex flex-col min-h-screen text-slate-800 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-100 rounded-full blur-3xl opacity-50 -z-10"></div>
    <div class="absolute bottom-[-10%] right-[-5%] w-[30%] h-[50%] bg-indigo-100 rounded-full blur-3xl opacity-50 -z-10"></div>

    <div class="flex-grow flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="max-w-md w-full bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 p-8 sm:p-10 m-4 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -z-10"></div>
            
            <div class="text-center mb-8">
                <!-- Logo -->
                <div class="mx-auto w-24 h-24 sm:w-32 sm:h-32 mb-4">
                    <img src="<?= base_url('public/images/i-track-logo.png') ?>" alt="I-Track Logo" class="w-full h-full object-contain">
                </div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Welcome to I-Track</h1>
                <p class="text-slate-500 mt-2 text-sm">Sign in to access your dashboard</p>
            </div>

            <form action="<?= base_url('login') ?>" method="POST">
                <?= csrf_field() ?>
                
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 text-sm rounded-2xl flex items-center gap-3 font-medium">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span><?= session()->getFlashdata('error') ?></span>
                    </div>
                <?php endif; ?>
                
                <div class="mb-5">
                    <label class="block text-slate-700 text-sm font-semibold mb-2" for="username">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <input class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm" 
                               type="text" name="username" id="username" placeholder="Enter username" value="<?= old('username') ?>" required>
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-slate-700 text-sm font-semibold mb-2" for="password">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm" 
                               type="password" name="password" id="password" placeholder="••••••••" required>
                    </div>
                </div>

                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-[0.98] flex items-center justify-center gap-2" 
                        type="submit">
                    <span>Sign In</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>
        </div>
    </div>

    <footer class="pb-8 text-center px-4">
        <p class="text-slate-500 text-sm font-medium flex items-center justify-center gap-2 flex-wrap">
            <span>Non-GPS Tracking</span>
            <span class="hidden sm:inline w-1 h-1 bg-slate-300 rounded-full"></span>
            <span>Bula National High School</span>
        </p>
    </footer>

</body>
</html>