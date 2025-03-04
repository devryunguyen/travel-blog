<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta author="David Baqueiro">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TRAVEL BLOG</title>

    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
    <!-- <link href="/www/dist/src.css?v=<?= $this->cache_version; ?>" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- <script src="https://unpkg.com/@tailwindcss/browser@4"></script> -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>

<body class="">
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['toast'])) {
        $toast = $_SESSION['toast'];
        unset($_SESSION['toast']); // Xóa sau khi hiển thị
    ?>
        <script>
            Toastify({
                text: "<?= $toast['message'] ?>",
                duration: 3000,
                gravity: "bottom",
                position: "right",
                backgroundColor: "<?= $toast['type'] === 'success' ? '#22c55e' : '#ef4444' ?>",
                stopOnFocus: true
            }).showToast();
        </script>
    <?php } ?>

    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        $user = $_SESSION['user'];
    } ?>

    <?php
    // Custom CSS/JS
    // foreach ($this->output_styles as $style_file) {
    //     echo $style_file;
    // }
    // foreach ($this->output_scripts as $script_file) {
    //     echo $script_file;
    // }
    // 
    ?>
    <div class="w-screen">
        <header class="fixed z-50 top-0 left-0 right-0 h-[78px] bg-white mb-[78px] shadow-md flex items-center w-full justify-center">
            <div class="w-full flex items-center mx-[150px]">

                <a href="/" class="text-3xl no-underline font-semibold flex">
                    <p class="text-green-500">T</p>
                    <p class="text-gray-800">RAVELBLOGS</p>
                </a>

                <div class="flex-1 flex items-center justify-center">
                    <form action="/blog/search" method="GET">
                        <div class="relative">
                            <button type="submit" class="absolute top-0 right-0 bottom-0 px-4 py-2 bg-green-500 text-white rounded-full">
                                <i class="fa-solid fa-search"></i>
                            </button>
                            <input type="text" name="q" class="w-[400px] h-[40px] px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus-within:outline-green-500 focus-visible:outline-green-500 focus-within:ring-0" placeholder="Search..." />
                        </div>
                    </form>
                </div>

                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                    <div class="dropdown">
                        <div class="flex items-center gap-x-2 cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="flex items-end flex-col">
                                <p class=" text-gray-800 text-base font-semibold"><?php echo htmlspecialchars($_SESSION['user']['full_name']) ?></p>
                                <p class="text-gray-500 text-sm font-light">Phiêu lưu mạo hiểm</p>
                            </div>
                            <div class="p-2 cursor-pointer hover:bg-gray-300 transition duration-500 rounded-full bg-gray-200">
                                <img width="42" height="42" src="https://img.icons8.com/parakeet-line/96/user.png" alt="user" />
                            </div>
                        </div>

                        <ul class="dropdown-menu">
                            <li class="px-2">
                                <p class="cursor-default font-medium text-sky-600"><?php echo htmlspecialchars($_COOKIE['author']) ?></p>
                            </li>
                            <?php if (isset($_COOKIE['role']) && $_COOKIE['role'] == 'admin'): ?>
                                <li><a class="dropdown-item" href="/user/admin">User Admin</a></li>
                            <?php endif; ?>
                            <?php if (isset($_COOKIE['role']) && $_COOKIE['role'] == 'admin'): ?>
                                <li><a class="dropdown-item" href="/blog/admin">Blog Admin</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="index?route=user/user/profile">Profile</a></li>
                            <li><a class="dropdown-item" href="index?route=user/user/settings">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Dark mode</a></li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <a class="dropdown-item" href="/logout">
                                    <div class="flex items-center gap-x-2">
                                        <i class="fa-solid fa-right-from-bracket text-rose-600"></i>
                                        <p class="text-rose-600 font-semibold text-base">Logout</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="/login">
                        <button type="button" class="px-6 py-2 text-sm font-semibold border rounded-md border-green-500 text-green-600">Sign In</button>
                    </a>
                <?php endif; ?>
            </div>
        </header>

        <div class="mt-[100px] w-full">
            <!-- <div id="main" class="main"> -->