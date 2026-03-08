<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I-Track | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

    <div class="flex-grow flex items-center justify-center">
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8 m-4">
            <div class="text-center mb-8">
                <img src="<?= base_url('public/images/i-track-logo.png') ?>" alt="I-Track Logo" class="mx-auto w-48 h-48">
                <p class="text-gray-500 mt-2">Sign in to your account</p>
            </div>

            <form action="<?= base_url('login') ?>" method="POST">
                <?= csrf_field() ?>
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="username">Username</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition border-gray-300" 
                           type="text" name="username" id="username" placeholder="Enter username" value="<?= old('username') ?>" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">Password</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition border-gray-300" 
                           type="password" name="password" id="password" placeholder="••••••••" required>
                </div>

                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1" 
                        type="submit">
                    Login
                </button>
            </form>
        </div>
    </div>

    <footer class="pb-6 text-center">
        <p class="text-gray-600 font-medium">Non-GPS Tracking at Bula National High School</p>
    </footer>

</body>
</html>