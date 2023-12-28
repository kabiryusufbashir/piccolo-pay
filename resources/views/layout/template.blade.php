<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Page Icon  -->
        <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico')}}"/>
        
        <!-- Font Awesome  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- Boostrap  -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.4/dataTables.bootstrap5.css" rel="stylesheet">
        
        <!-- jQuery  -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables.net-bs5/1.13.4/dataTables.bootstrap5.min.js" integrity="sha512-KFdmxVdAssPxrj4mZh1c01AbGXMAmXmBsO4Tc/GG5+kNLqitTfUBpDHicyDwF7CaFV+pN1r808IOK+vHzWB8gw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-wOLiP6uL5tNrV1FiutKtAyQGGJ1CWAsqQ6Kp2XZ12/CvZxw8MvNJfdhh0yTwjPIir4SWag2/MHrseR7PRmNtvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
        <!-- Page Description  -->

        @yield('pageTitle')

        @yield('pageMeta')

        <link rel="stylesheet" href="{{ asset('build/assets/app-6ac740c7.css') }}">
        <link href="{{ asset('css/main.css?v=1.1') }}" rel="stylesheet">
        @vite('resources/css/app.css')
    
    </head>
    <body>
        <!-- Navigation Container  -->
            <div id="navContainer" class="hidden py-6 lg:grid grid-cols-5 gap-3 items-center">
                <!-- Slogan  -->
                <a href="{{ route('home') }}">
                    <div class="slogan" class="col-span-1">
                        PiccoloPay
                    </div>
                </a>
                <!-- Links  -->
                <div class="col-span-3">
                    <nav class="flex justify-center">
                        <li class="px-4">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="px-4">
                            <a href="{{ route('home') }}#whyus">Why Us</a>
                        </li>
                        <li class="px-4">
                            <a href="{{ route('home') }}#services">Services</a>
                        </li>
                    </nav>
                </div>
                <!-- Button  -->
                <div class="col-span-1">
                    <nav class="flex justify-center">
                        <li class="px-6 py-2 mx-4 gray-bg rounded-full">
                            <a href="{{ route('login') }}" class="hover:text-black">Login</a>
                        </li>
                        <li class="px-6 py-2 green-bg rounded-full">
                            <a href="{{ route('signup') }}" class="white-text hover:text-white">Sign Up</a>
                        </li>
                    </nav>
                </div>
            </div>
            <!-- Mobile View  -->
            <div class="lg:hidden block flex justify-between px-4 py-6 items-center w-full">
                <!-- Slogan  -->
                <a href="{{ route('home') }}">
                    <div class="slogan text-lg">
                        PiccoloPay
                    </div>
                </a>
                <!-- Toggle  -->
                <div id="toggleBtn" class="cursor-pointer">
                    <svg class="" width="24" height="18" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.8335 12.8333H11.1668M1.8335 6.99999H18.1668M8.8335 1.16666H18.1668" stroke="#1A1A1A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
            <!-- Mobile Menu  -->
            <div id="mobileMenu" class="bg-white fixed z-50 w-full h-screen -top-0 hidden pt-16">
                <div id="closeMobileMenu" class="flex justify-end mr-12">
                    <svg width="70" height="70" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_d_73_1706)">
                            <circle cx="45" cy="45" r="29" fill="white"/>
                        </g>
                        <path d="M40.4419 50.4369L45.4398 45.439L50.4377 50.4369M50.4377 40.4411L45.4388 45.439L40.4419 40.4411" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <defs>
                            <filter id="filter0_d_73_1706" x="0" y="0" width="90" height="90" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                                <feMorphology radius="2" operator="dilate" in="SourceAlpha" result="effect1_dropShadow_73_1706"/>
                                <feOffset/>
                                <feGaussianBlur stdDeviation="7"/>
                                <feComposite in2="hardAlpha" operator="out"/>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0"/>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_73_1706"/>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_73_1706" result="shape"/>
                            </filter>
                        </defs>
                    </svg>
                </div>
                <div>
                    <nav class="flex flex-col items-center text-sm">
                        <li class="py-4">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="py-4">
                            <a href="{{ route('home') }}#whyus">Why Us</a>
                        </li>
                        <li class="py-4">
                            <a href="{{ route('home') }}#services">Services</a>
                        </li>
                        <li class="px-8 my-4 py-3 gray-bg rounded-full">
                            <a href="{{ route('login') }}" class="hover:text-black">Login</a>
                        </li>
                        <li class="px-8 my-4 py-3 green-bg rounded-full">
                            <a href="{{ route('signup') }}" class="white-text hover:text-white">Sign Up</a>
                        </li>
                    </nav>
                </div>
            </div>
        <!-- End of Navigation Container -->
        
        @yield('pageContents')

        <!-- Footer  -->
            <div id="footer" class="bg-white px-16 py-12">
                <div class="lg:grid grid-cols-3 gap-6 py-6">
                    <div>
                        <a href="{{ route('home') }}">
                            <div class="slogan">
                                PiccoloPay
                            </div>
                        </a>
                        <div class="banner-message my-4 lg:text-sm text-xs">
                            Unlock a world of seamless transactions and top-notch services with Piccolo Pay. We pride ourselves on being your go-to destination for airtime, data, TV subscriptions and electricity bill purchases.
                        </div>
                    </div>
                    <div class="mx-auto">
                        <div class="banner-header text-xl">
                            Navigations
                        </div>
                        <div class="my-4">
                            <nav class="lg:grid grid-cols-2 gap-4">
                                <li class="py-3">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="py-3">
                                    <a href="{{ route('home') }}#whyus">Why Us</a>
                                </li>
                                <li class="py-3">
                                    <a href="{{ route('home') }}#services">Services</a>
                                </li>
                                <li class="py-3">
                                    <a href="{{ route('signup') }}">Sign Up</a>
                                </li>
                                <li class="py-3">
                                    <a href="{{ route('login') }}">Login</a>
                                </li>
                            </nav>   
                        </div>
                    </div>
                    <div class="mx-auto">
                        <div class="banner-header text-xl">
                            Social Media Links
                        </div>
                        <div class="my-4 flex">
                            <!-- Facebook  -->
                            <div>
                                <svg width="44" height="44" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="32" cy="32" r="32" fill="#E9E9E9"/>
                                    <path d="M34 33.5H36.5L37.5 29.5H34V27.5C34 26.47 34 25.5 36 25.5H37.5V22.14C37.174 22.097 35.943 22 34.643 22C31.928 22 30 23.657 30 26.7V29.5H27V33.5H30V42H34V33.5Z" fill="black"/>
                                </svg>
                            </div>   
                            <!-- WhatsApp  -->
                            <div class="ml-4">
                                <svg width="44" height="44" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="32" cy="32" r="32" fill="#E9E9E9"/>
                                    <path d="M39.05 24.9101C38.1332 23.984 37.0412 23.2497 35.8376 22.7501C34.6341 22.2505 33.3431 21.9955 32.04 22.0001C26.58 22.0001 22.13 26.4501 22.13 31.9101C22.13 33.6601 22.59 35.3601 23.45 36.8601L22.05 42.0001L27.3 40.6201C28.75 41.4101 30.38 41.8301 32.04 41.8301C37.5 41.8301 41.95 37.3801 41.95 31.9201C41.95 29.2701 40.92 26.7801 39.05 24.9101ZM32.04 40.1501C30.56 40.1501 29.11 39.7501 27.84 39.0001L27.54 38.8201L24.42 39.6401L25.25 36.6001L25.05 36.2901C24.2277 34.977 23.7911 33.4593 23.79 31.9101C23.79 27.3701 27.49 23.6701 32.03 23.6701C34.23 23.6701 36.3 24.5301 37.85 26.0901C38.6175 26.854 39.2257 27.7627 39.6394 28.7635C40.0531 29.7642 40.264 30.8372 40.26 31.9201C40.28 36.4601 36.58 40.1501 32.04 40.1501ZM36.56 33.9901C36.31 33.8701 35.09 33.2701 34.87 33.1801C34.64 33.1001 34.48 33.0601 34.31 33.3001C34.14 33.5501 33.67 34.1101 33.53 34.2701C33.39 34.4401 33.24 34.4601 32.99 34.3301C32.74 34.2101 31.94 33.9401 31 33.1001C30.26 32.4401 29.77 31.6301 29.62 31.3801C29.48 31.1301 29.6 31.0001 29.73 30.8701C29.84 30.7601 29.98 30.5801 30.1 30.4401C30.22 30.3001 30.27 30.1901 30.35 30.0301C30.43 29.8601 30.39 29.7201 30.33 29.6001C30.27 29.4801 29.77 28.2601 29.57 27.7601C29.37 27.2801 29.16 27.3401 29.01 27.3301H28.53C28.36 27.3301 28.1 27.3901 27.87 27.6401C27.65 27.8901 27.01 28.4901 27.01 29.7101C27.01 30.9301 27.9 32.1101 28.02 32.2701C28.14 32.4401 29.77 34.9401 32.25 36.0101C32.84 36.2701 33.3 36.4201 33.66 36.5301C34.25 36.7201 34.79 36.6901 35.22 36.6301C35.7 36.5601 36.69 36.0301 36.89 35.4501C37.1 34.8701 37.1 34.3801 37.03 34.2701C36.96 34.1601 36.81 34.1101 36.56 33.9901Z" fill="black"/>
                                </svg>
                            </div>
                            <!-- Twitter  -->
                            <div class="ml-4">
                                <svg width="44" height="44" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="32" cy="32" r="32" fill="#E9E9E9"/>
                                        <g clip-path="url(#clip0_18_396)">
                                            <path d="M34.2342 30.1625L42.9766 20H40.9047L33.314 28.8238L27.251 20H20.258L29.4264 33.3433L20.258 44H22.3299L30.3462 34.6818L36.749 44H43.742L34.2337 30.1625H34.2342ZM31.3966 33.4606L30.4676 32.132L23.0763 21.5596H26.2586L32.2231 30.092L33.152 31.4206L40.9057 42.5112H37.7238L31.3966 33.4612V33.4606Z" fill="black"/>
                                        </g>
                                    <defs>
                                        <clipPath id="clip0_18_396">
                                            <rect width="24" height="24" fill="white" transform="translate(20 20)"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="green-bg py-8 text-center text-white text-xs">
                A Product of <a target="_blank" href="https://teampiccolo.com" class="hover:text-white">Team Piccolo</a> &copy; 2023 <br> All Rights Reserved
            </div>
        <!-- End of Footer  -->

        <script>
            // Wait for the document to be ready
            $(document).ready(function() {
                $('#toggleBtn').click(function() {
                    $('#mobileMenu').toggle();
                });

                $('#closeMobileMenu').click(function(){
                    $('#mobileMenu').toggle();
                })
            });
        </script>
    </body>
</html>
