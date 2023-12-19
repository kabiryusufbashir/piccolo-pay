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
        
        <title>Piccolo Pay</title>
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
        @vite('resources/css/app.css')
    
    </head>
    <body>
        <!-- Navigation Container  -->
            <div id="navContainer" class="py-6 grid grid-cols-5 gap-3 items-center">
                <!-- Slogan  -->
                <div id="slogan" class="col-span-1">
                    PiccoloPay
                </div>
                <!-- Links  -->
                <div class="col-span-3">
                    <nav class="flex justify-center">
                        <li class="px-4">
                            <a href="">Home</a>
                        </li>
                        <li class="px-4">
                            <a href="">About</a>
                        </li>
                        <li class="px-4">
                            <a href="">Services</a>
                        </li>
                        <li class="px-4">
                            <a href="">Contact Us</a>
                        </li>
                    </nav>
                </div>
                <!-- Button  -->
                <div class="col-span-1">
                    <nav class="flex justify-center">
                        <li class="px-6 py-2 mx-4 gray-bg rounded-full">
                            <a href="" class="hover:text-black">Login</a>
                        </li>
                        <li class="px-6 py-2 green-bg rounded-full">
                            <a href="" class="white-text hover:text-white">Sign Up</a>
                        </li>
                    </nav>
                </div>
            </div>
        <!-- End of Navigation Container -->
        
        <!-- Banner Section  -->
            <div id="bannerSection" class="grid grid-cols-2 gap-4 py-12 items-center">
                <div>
                    <div class="banner-header">
                        Welcome to Piccolo Pay - Your One-Stop Shop for Connectivity and Convenience!
                    </div>
                    <div class="banner-message my-4">
                        Unlock a world of seamless transactions and top-notch services with Piccolo Pay. We pride ourselves on being your go-to destination for airtime, data, TV subscriptions and electricity bill purchases.
                    </div>
                    <div class="flex my-8">
                        <div class="px-8 py-3 gray-bg rounded-full">
                            <a href="" class="hover:text-black">Login</a>
                        </div>
                        <div class="px-8 py-3 mx-4 green-bg rounded-full">
                            <a href="" class="white-text hover:text-white">Sign Up</a>
                        </div>
                        <div class="mx-4">
                            <svg width="84" height="41" viewBox="0 0 94 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M91.2668 30.2172C91.7101 30.7465 92.4985 30.8161 93.0278 30.3728C93.557 29.9295 93.6266 29.1411 93.1833 28.6119L91.2668 30.2172ZM45.0247 14.5569L45.2227 15.7911L45.0247 14.5569ZM0.0033443 10.0052L13.7261 14.4796L10.7397 0.358146L0.0033443 10.0052ZM93.1833 28.6119C87.4317 21.7455 69.8456 9.30898 44.8267 13.3227L45.2227 15.7911C69.2242 11.9406 85.9767 23.9018 91.2668 30.2172L93.1833 28.6119ZM44.8267 13.3227C40.8148 13.9663 37.7589 15.3662 35.5427 17.3372C33.3217 19.3126 32.0186 21.7957 31.41 24.4738C30.2053 29.7756 31.7077 35.8638 34.1298 40.7005C35.3492 43.1356 36.8311 45.3148 38.3933 46.9757C39.9267 48.606 41.6597 49.8666 43.4035 50.2232C44.3046 50.4075 45.2309 50.3531 46.1003 49.9539C46.9655 49.5566 47.6697 48.8662 48.2161 47.9562C49.2823 46.1805 49.8426 43.4163 49.872 39.6052L47.3721 39.5859C47.3437 43.2558 46.7908 45.4735 46.0728 46.6692C45.7271 47.245 45.3714 47.5376 45.0571 47.682C44.747 47.8243 44.3741 47.87 43.9044 47.7739C42.9065 47.5699 41.6112 46.748 40.2144 45.2629C38.8462 43.8083 37.4958 41.839 36.3651 39.5811C34.0871 35.0321 32.8187 29.5571 33.8479 25.0278C34.3563 22.7902 35.4214 20.7908 37.2041 19.2053C38.9918 17.6154 41.5752 16.3763 45.2227 15.7911L44.8267 13.3227ZM49.872 39.6052C49.9719 26.688 45.2813 17.7749 37.9039 12.4047C30.5781 7.07206 20.7859 5.36543 10.878 6.43425L11.1461 8.91983C20.6468 7.89493 29.7569 9.56649 36.4326 14.4259C43.0568 19.2479 47.4668 27.3409 47.3721 39.5859L49.872 39.6052Z" fill="#05976A"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div>
                    <div id="banner-sticker">
                        <!-- Airtime  -->
                        <div class="my-4 flex bg-white shadow-lg rounded-lg py-3 px-3 w-48 items-center">
                            <div class="pr-2">
                                <img class="rounded-full w-12" src="{{ asset('images/mtn.png') }}" alt="mtn">
                            </div>
                            <div class="text-xs">
                                Data Purchase successful
                            </div>
                        </div>
                        <!-- Data  -->
                        <div class="flex bg-white shadow-lg rounded-lg py-3 px-3 w-48 items-center">
                            <div class="pr-2">
                                <img class="rounded-full w-16" src="{{ asset('images/glo.png') }}" alt="glo">
                            </div>
                            <div class="text-xs">
                                Airtime Purchase successful
                            </div>
                        </div>
                    </div>
                    <div>
                        <img class="ml-auto" src="{{ asset('images/photo_1.png') }}" alt="Advert 1">
                    </div>
                </div>
            </div>
        <!-- End of Banner Section  -->

        <!-- Page Contents  -->
            <div id="pageContents">
                <!-- Experience  -->
                <div id="experience" class="py-16 px-16 white-text">
                    <div class="grid grid-cols-2">
                        <div>
                            <div class="banner-header">
                                Experience Seamless Bill Payment for All
                            </div>
                            <div class="flex my-4">
                                <div class="mr-10">
                                    <div class="banner-header">100 %</div>
                                    <div class="letter-spacing">Reliable</div> 
                                </div>
                                <div>
                                    <div class="banner-header">24/7</div>
                                    <div class="letter-spacing">Services</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Services  -->
                <div id="services" class="grid grid-cols-2 gap-4 items-center">
                    <div>
                        <img class="mx-auto" src="{{ asset('images/photo_2.png') }}" alt="Services">
                    </div>
                    <div>
                        <div class="banner-header text-xl">
                            Our Services
                        </div>
                        <div class="grid grid-cols-2 gap-4 my-6">
                            <div>
                                <p class="banner-header text-sm py-3">Airtime and Data</p>
                                <p class="text-sm">
                                    Stay connected effortlessly with our quick and reliable airtime and data services. Whether it's a call with a friend or a video conference with clients, we've got you covered.
                                </p>
                            </div>
                            <div>
                                <p class="banner-header text-sm py-3">TV Subscriptions</p>
                                <p class="text-sm">
                                    Elevate your entertainment experience with hassle-free TV subscriptions. Choose from a variety of packages to enjoy your favorite shows, movies and sports without missing a beat.
                                </p>
                            </div>
                            <div>
                                <p class="banner-header text-sm py-3">Electricity Bill Purchase</p>
                                <p class="text-sm">
                                    Simplify your life by paying your electricity bills with ease. No more long queues or complicated processes - just a straightforward way to keep the lights on.
                                </p>
                            </div>
                            <div>
                                <p class="banner-header text-sm py-3">Exam Pin</p>
                                <p class="text-sm">
                                    Facing difficulties checking your results? Gain seamless access to check your exams with our Exam PINs! No more uncertainties - just a straightforward way to review your exams and pave the way to success.
                                </p>
                            </div>
                            <div class="flex py-6">
                                <div class="px-8 py-3 green-bg rounded-full">
                                    <a href="" class="white-text hover:text-white">Get Started</a>
                                </div>
                                <div class="mx-4">
                                    <svg width="84" height="41" viewBox="0 0 94 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M91.2668 30.2172C91.7101 30.7465 92.4985 30.8161 93.0278 30.3728C93.557 29.9295 93.6266 29.1411 93.1833 28.6119L91.2668 30.2172ZM45.0247 14.5569L45.2227 15.7911L45.0247 14.5569ZM0.0033443 10.0052L13.7261 14.4796L10.7397 0.358146L0.0033443 10.0052ZM93.1833 28.6119C87.4317 21.7455 69.8456 9.30898 44.8267 13.3227L45.2227 15.7911C69.2242 11.9406 85.9767 23.9018 91.2668 30.2172L93.1833 28.6119ZM44.8267 13.3227C40.8148 13.9663 37.7589 15.3662 35.5427 17.3372C33.3217 19.3126 32.0186 21.7957 31.41 24.4738C30.2053 29.7756 31.7077 35.8638 34.1298 40.7005C35.3492 43.1356 36.8311 45.3148 38.3933 46.9757C39.9267 48.606 41.6597 49.8666 43.4035 50.2232C44.3046 50.4075 45.2309 50.3531 46.1003 49.9539C46.9655 49.5566 47.6697 48.8662 48.2161 47.9562C49.2823 46.1805 49.8426 43.4163 49.872 39.6052L47.3721 39.5859C47.3437 43.2558 46.7908 45.4735 46.0728 46.6692C45.7271 47.245 45.3714 47.5376 45.0571 47.682C44.747 47.8243 44.3741 47.87 43.9044 47.7739C42.9065 47.5699 41.6112 46.748 40.2144 45.2629C38.8462 43.8083 37.4958 41.839 36.3651 39.5811C34.0871 35.0321 32.8187 29.5571 33.8479 25.0278C34.3563 22.7902 35.4214 20.7908 37.2041 19.2053C38.9918 17.6154 41.5752 16.3763 45.2227 15.7911L44.8267 13.3227ZM49.872 39.6052C49.9719 26.688 45.2813 17.7749 37.9039 12.4047C30.5781 7.07206 20.7859 5.36543 10.878 6.43425L11.1461 8.91983C20.6468 7.89493 29.7569 9.56649 36.4326 14.4259C43.0568 19.2479 47.4668 27.3409 47.3721 39.5859L49.872 39.6052Z" fill="#05976A"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- End of Page Contents  -->
    </body>
</html>
