<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LiteNote</title>
    @vite('resources/css/app.css') <!-- Assuming you are using Laravel mix for CSS compilation -->
    <style>
        /* Custom styles */
        body {
            font-family: 'figtree', sans-serif;
            /* Apply your custom font */
            background-color: #ffffff;
            /* Set a light background color */
            color: #374151;
            /* Use a darker text color for better readability */
            line-height: 1.6;
            /* Improve line spacing */
        }

        .container {
            max-width: 1300px;
            margin-top: 100px;
            padding: 20px;
            display: flex;
            /* Use flexbox for layout */
            justify-content: space-between;
            /* Space items evenly */
            align-items: center;
            /* Center items vertically */
        }

        .header-links {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }



        .title {
            text-align: center;
            font-size: 2.5rem;
            margin-top: 3rem;
            flex: 1;
            /* Take up remaining space */
        }

        .main-content {
            text-align: center;
            margin-top: 3rem;
            flex: 1;
            /* Take up remaining space */
        }

        .main-content h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .main-content p {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }

        .get-started-btn:hover {
            background-color: #D97706;
        }


        .illustration img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            /* Optional: Add border radius for aesthetics */
        }

        .get-started-btn {
            background-color: #F59E0B;
            color: #ffffff;
            padding: 12px 24px;
            font-size: 1.25rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .get-started-btn:hover {
            background-color: #D97706;
        }

        .svg-right {
            text-align: right; /* Ensure the SVG aligns to the right */
        }
        .svg-right svg {
            stroke: #ffffff; /* Change color to white */
            float: right; /* Float to the right */
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                /* Stack items vertically on small screens */
                align-items: flex-start;
                /* Align items to the start */
            }

            .illustration {
                margin-left: 0;
                /* Remove margin on small screens */
                margin-top: 20px;
                /* Add margin on top */
            }
        }
    </style>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>

<nav class="bg-[#D97706] ">
    <div class=" max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button type="button"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>


                    <!--
                  Icon when menu is closed.

                  Menu open: "hidden", Menu closed: "block"
                -->
                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!--
                  Icon when menu is open.

                  Menu open: "block", Menu closed: "hidden"
                -->
                    <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex flex-shrink-0 items-center">

                    <div
                        class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        <!-- Profile dropdown -->
                        <div class="relative ml-3">
                            <div>
                                <button type="button"
                                    class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="absolute -inset-1.5"></span>
                            </div><img class="h-10 w-10 rounded-full" src="image/pic5.jpg" alt="Your Company">
                            </button>
                        </div>


                        <div class="hidden sm:ml-6 sm:block">
                            <div class="flex space-x-4 justify-end ml-auto">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <header class="header-links text-white">
                                    @if (Route::has('login'))
                                        @auth
                                            <a href="{{ route('notes.index') }}">Notes</a>
                                        @else
                                            <a href="{{ route('login') }}">Login</a>

                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}">Register</a>
                                            @endif
                                        @endauth
                                    @endif
                                </header>

                            </div>
                        </div>

                    </div>

                </div>
            </div>



        </div>

    </div>
</nav>

<body>

    <div class="container mx-auto p-4">
        <!-- Header -->
        <!-- Title and Main Content -->
        <div class="flex flex-wrap md:flex-nowrap">
            <div class="w-full md:w-1/1 p-4">
                <div class="title">
                    <h1 class="text-7xl font-bold mb-4">LiteNotes</h1>
                    <main class="main-content">
                        <h2 class="text-3xl mb-9 mt-4">Quickly Capture What’s On Your Mind</h2>
                        <p class="text-3xl mb-6">LiteNote makes it easy to capture a thought or list for yourself, and
                            share it with friends and
                            family.</p>
                        <button class="get-started-btn">Get Started</button>
                    </main>
                </div>
            </div>


            <!-- Illustration -->
            <div class="w-full p-4  ">
                <div class="illustration">
                    <img src="image/backgroud.jpg" alt="Illustration" class="w-full h-auto mt-9 ml-8  ">

                </div>

            </div>
        </div>
    </div>

</body>

</html>
