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
                <li class="px-4">
                    <a href="{{ route('privacy') }}">Privay Policy</a>
                </li>
                <li class="px-4">
                    <a href="https://wa.me/+2347037645413" target="_blank">Support</a>
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
    <div class="lg:hidden flex justify-between px-4 py-6 items-center w-full">
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
    <div id="mobileMenu" class="bg-white fixed z-50 w-75 h-screen -top-0 hidden pt-16">
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
            <nav class="flex flex-col items-center text-xs">
                <li class="py-4">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="py-4">
                    <a href="{{ route('home') }}#whyus">Why Us</a>
                </li>
                <li class="py-4">
                    <a href="{{ route('privacy') }}">Privacy Policy</a>
                </li>
                <li class="py-4">
                    <a href="{{ route('home') }}#services">Services</a>
                </li>
                <li class="py-4">
                    <a href="https://wa.me/+2347037645413" target="_blank">Support</a>
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
