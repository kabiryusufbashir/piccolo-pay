@extends('layout.template')

@section('pageTitle')
    <title>Piccolo Pay - Home</title>        
@endsection

@section('pageMeta')
    <meta name ="description", content="Unlock a world of seamless transactions and top-notch services with Piccolo Pay. We pride ourselves on being your go-to destination for airtime, data, TV subscriptions and electricity bill purchases.">
    <meta name ="keywords", content="Data, Airtime">
    <meta name="author" content="Team Piccolo">
@endsection

@section('nav')
    @include('includes.nav')
@endsection

@section('pageContents')
    <!-- Banner Section  -->
        <div id="bannerSection" class="lg:grid grid-cols-2 gap-4 py-12 items-center bg-white">
            <div class="mx-4 p-1">
                <div id="bannerAdvertNoti" class="absolute lg:top-64 top-32 lg:left-12 lg:block">
                    <!-- Airtime  -->
                    <div class="my-4 flex bg-white shadow-lg rounded-lg py-3 px-3 w-48 items-center">
                        <div class="pr-2">
                            <img class="rounded-full lg:w-12 w-8" src="{{ asset('images/mtn.png') }}" alt="mtn">
                        </div>
                        <div class="text-xs">
                            Data Purchase successful
                        </div>
                    </div>
                    <!-- Data  -->
                    <div class="flex bg-white shadow-lg rounded-lg py-3 px-3 w-48 items-center">
                        <div class="pr-2">
                            <img class="rounded-full lg:w-16 w-10" src="{{ asset('images/glo.png') }}" alt="glo">
                        </div>
                        <div class="text-xs">
                            Airtime Purchase successful
                        </div>
                    </div>
                </div>
                <div>
                    <img class="mx-auto" src="{{ asset('images/photo_1.png') }}" alt="Advert 1">
                </div>
            </div>
            <div class="p-2">
                <div class="banner-header">
                    Welcome to Piccolo Pay - Your One-Stop Shop for Connectivity and Convenience!
                </div>
                <div class="banner-message my-4 text-xs lg:text-sm">
                    Unlock a world of seamless transactions and top-notch services with Piccolo Pay. We pride ourselves on being your go-to destination for airtime, data, TV subscriptions and electricity bill purchases.
                </div>
                <div class="lg:flex my-8">
                    <div class="yus-mt px-8 text-sm py-3 gray-bg rounded-full text-center">
                        <a href="{{ route('login') }}" class="hover:text-black">Login</a>
                    </div>
                    <div class="px-8 py-3 text-sm lg:mx-4 green-bg rounded-full text-center">
                        <a href="{{ route('signup') }}" class="white-text hover:text-white">Sign Up</a>
                    </div>
                    <div class="mx-4 hidden lg:block">
                        <svg width="84" height="41" viewBox="0 0 94 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M91.2668 30.2172C91.7101 30.7465 92.4985 30.8161 93.0278 30.3728C93.557 29.9295 93.6266 29.1411 93.1833 28.6119L91.2668 30.2172ZM45.0247 14.5569L45.2227 15.7911L45.0247 14.5569ZM0.0033443 10.0052L13.7261 14.4796L10.7397 0.358146L0.0033443 10.0052ZM93.1833 28.6119C87.4317 21.7455 69.8456 9.30898 44.8267 13.3227L45.2227 15.7911C69.2242 11.9406 85.9767 23.9018 91.2668 30.2172L93.1833 28.6119ZM44.8267 13.3227C40.8148 13.9663 37.7589 15.3662 35.5427 17.3372C33.3217 19.3126 32.0186 21.7957 31.41 24.4738C30.2053 29.7756 31.7077 35.8638 34.1298 40.7005C35.3492 43.1356 36.8311 45.3148 38.3933 46.9757C39.9267 48.606 41.6597 49.8666 43.4035 50.2232C44.3046 50.4075 45.2309 50.3531 46.1003 49.9539C46.9655 49.5566 47.6697 48.8662 48.2161 47.9562C49.2823 46.1805 49.8426 43.4163 49.872 39.6052L47.3721 39.5859C47.3437 43.2558 46.7908 45.4735 46.0728 46.6692C45.7271 47.245 45.3714 47.5376 45.0571 47.682C44.747 47.8243 44.3741 47.87 43.9044 47.7739C42.9065 47.5699 41.6112 46.748 40.2144 45.2629C38.8462 43.8083 37.4958 41.839 36.3651 39.5811C34.0871 35.0321 32.8187 29.5571 33.8479 25.0278C34.3563 22.7902 35.4214 20.7908 37.2041 19.2053C38.9918 17.6154 41.5752 16.3763 45.2227 15.7911L44.8267 13.3227ZM49.872 39.6052C49.9719 26.688 45.2813 17.7749 37.9039 12.4047C30.5781 7.07206 20.7859 5.36543 10.878 6.43425L11.1461 8.91983C20.6468 7.89493 29.7569 9.56649 36.4326 14.4259C43.0568 19.2479 47.4668 27.3409 47.3721 39.5859L49.872 39.6052Z" fill="#05976A"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    <!-- End of Banner Section  -->

    <!-- Page Contents  -->
        <div id="pageContents">
            <!-- Experience  -->
            <div id="experience" class="py-16 lg:px-16 white-text">
                <div class="lg:grid grid-cols-2">
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
            <div id="services" class="lg:grid grid-cols-2 gap-4 items-center px-4">
                <div>
                    <img class="mx-auto" src="{{ asset('images/photo_2.png') }}" alt="Services">
                </div>
                <div>
                    <div class="banner-header text-2xl my-4">
                        Our Services
                    </div>
                    <div class="grid grid-cols-2 gap-4 my-6">
                        <div>
                            <p class="banner-header text-sm py-3">Airtime and Data</p>
                            <p class="lg:text-sm text-xs">
                                Stay connected effortlessly with our quick and reliable airtime and data services. Whether it's a call with a friend or a video conference with clients, we've got you covered.
                            </p>
                        </div>
                        <div>
                            <p class="banner-header text-sm py-3">TV Subscriptions</p>
                            <p class="lg:text-sm text-xs">
                                Elevate your entertainment experience with hassle-free TV subscriptions. Choose from a variety of packages to enjoy your favorite shows, movies and sports without missing a beat.
                            </p>
                        </div>
                        <div>
                            <p class="banner-header text-sm py-3">Electricity Bill Purchase</p>
                            <p class="lg:text-sm text-xs">
                                Simplify your life by paying your electricity bills with ease. No more long queues or complicated processes - just a straightforward way to keep the lights on.
                            </p>
                        </div>
                        <div>
                            <p class="banner-header text-sm py-3">Exam Pin</p>
                            <p class="lg:text-sm text-xs">
                                Facing difficulties checking your results? Gain seamless access to check your exams with our Exam PINs! No more uncertainties - just a straightforward way to review your exams and pave the way to success.
                            </p>
                        </div>
                    </div>
                    <div class="flex py-6 items-center">
                        <div class="px-8 py-3 green-bg rounded-full">
                            <a href="" class="white-text hover:text-white lg:text-sm text-xs">Get Started</a>
                        </div>
                        <div class="mx-4">
                            <svg width="84" height="41" viewBox="0 0 94 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M91.2668 30.2172C91.7101 30.7465 92.4985 30.8161 93.0278 30.3728C93.557 29.9295 93.6266 29.1411 93.1833 28.6119L91.2668 30.2172ZM45.0247 14.5569L45.2227 15.7911L45.0247 14.5569ZM0.0033443 10.0052L13.7261 14.4796L10.7397 0.358146L0.0033443 10.0052ZM93.1833 28.6119C87.4317 21.7455 69.8456 9.30898 44.8267 13.3227L45.2227 15.7911C69.2242 11.9406 85.9767 23.9018 91.2668 30.2172L93.1833 28.6119ZM44.8267 13.3227C40.8148 13.9663 37.7589 15.3662 35.5427 17.3372C33.3217 19.3126 32.0186 21.7957 31.41 24.4738C30.2053 29.7756 31.7077 35.8638 34.1298 40.7005C35.3492 43.1356 36.8311 45.3148 38.3933 46.9757C39.9267 48.606 41.6597 49.8666 43.4035 50.2232C44.3046 50.4075 45.2309 50.3531 46.1003 49.9539C46.9655 49.5566 47.6697 48.8662 48.2161 47.9562C49.2823 46.1805 49.8426 43.4163 49.872 39.6052L47.3721 39.5859C47.3437 43.2558 46.7908 45.4735 46.0728 46.6692C45.7271 47.245 45.3714 47.5376 45.0571 47.682C44.747 47.8243 44.3741 47.87 43.9044 47.7739C42.9065 47.5699 41.6112 46.748 40.2144 45.2629C38.8462 43.8083 37.4958 41.839 36.3651 39.5811C34.0871 35.0321 32.8187 29.5571 33.8479 25.0278C34.3563 22.7902 35.4214 20.7908 37.2041 19.2053C38.9918 17.6154 41.5752 16.3763 45.2227 15.7911L44.8267 13.3227ZM49.872 39.6052C49.9719 26.688 45.2813 17.7749 37.9039 12.4047C30.5781 7.07206 20.7859 5.36543 10.878 6.43425L11.1461 8.91983C20.6468 7.89493 29.7569 9.56649 36.4326 14.4259C43.0568 19.2479 47.4668 27.3409 47.3721 39.5859L49.872 39.6052Z" fill="#05976A"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Why Us  -->
            <div id="whyus" class="lg:grid grid-cols-2 gap-4 items-center lg:px-4">
                <div class="px-8">
                    <div class="banner-header text-2xl">
                        Why Choose Us
                    </div>
                    <div class="my-6 text-sm">
                        Convenience: Enjoy the convenience of a one-stop shop for all your connectivity needs. No more hopping between platforms - everything you need is right here
                    </div>
                    <div class="grid grid-cols-2 gap-4 my-10">
                        <div>
                            <p>
                                <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="20.5" cy="20.5" r="20.5" fill="#05976A" fill-opacity="0.23"/>
                                    <path d="M14.1667 21L13.6633 16.4692C13.5192 15.1725 14.8542 14.22 16.0333 14.7792L25.9867 19.4942C27.2575 20.0958 27.2575 21.9042 25.9867 22.5058L16.0333 27.2208C14.8542 27.7792 13.5192 26.8275 13.6633 25.5308L14.1667 21ZM14.1667 21H20" stroke="#05976A" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </p>
                            <p class="banner-header text-sm py-3">Fast and Reliable</p>
                            <p class="text-sm">
                                Our services are designed for speed and reliability. Experience quick transactions and a seamless user interface that makes your life easier.
                            </p>
                        </div>
                        <div>
                            <p>
                                <svg width="41" height="41" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="20.5" cy="20.5" r="20.5" fill="#05976A" fill-opacity="0.23"/>
                                    <path d="M29.1712 20.5C29.1919 20.4263 29.2162 20.3544 29.2337 20.2794C29.2375 20.2644 29.2387 20.2494 29.2425 20.2344C29.421 19.5137 29.4203 18.7602 29.2405 18.0398C29.0606 17.3195 28.707 16.6541 28.2106 16.1019C27.7529 15.4864 27.1565 14.9875 26.4699 14.6457C25.7833 14.3038 25.0257 14.1287 24.2587 14.1344H24.2262C24.1637 14.1344 24.0937 14.1388 24.0275 14.1407H23.9519C22.631 14.2135 21.318 14.392 20.0256 14.6744L17.2275 14.2275H17.2056C15.8729 13.9973 14.5014 14.2172 13.3075 14.8525C12.6349 15.2579 12.0572 15.8032 11.6137 16.4513L11.5881 16.4857L11.5725 16.5075C10.9858 17.3779 10.6667 18.401 10.6547 19.4506C10.6427 20.5001 10.9383 21.5303 11.505 22.4138C11.4931 22.435 11.4862 22.4588 11.475 22.4807C11.4208 22.589 11.3747 22.7012 11.3369 22.8163C11.3169 22.8788 11.3019 22.945 11.2875 23.01C11.2762 23.0632 11.265 23.1157 11.2575 23.1688C11.2498 23.235 11.2452 23.3015 11.2437 23.3682C11.2437 23.4219 11.2375 23.4744 11.24 23.5275C11.2444 23.5975 11.2525 23.6669 11.2637 23.7363C11.2712 23.7857 11.275 23.835 11.2862 23.8838C11.305 23.9607 11.33 24.0363 11.3587 24.11C11.3731 24.1494 11.3825 24.19 11.4 24.2288C11.4512 24.3432 11.5137 24.4513 11.5875 24.5525C11.8703 24.9574 12.2875 25.2489 12.765 25.375C12.7472 25.6416 12.7915 25.9086 12.8946 26.155C12.9976 26.4014 13.1565 26.6205 13.3587 26.795C13.7169 27.1088 14.1561 27.3155 14.6262 27.3913C14.7231 27.7057 14.8931 27.9925 15.1219 28.2288C15.4339 28.5672 15.8557 28.7842 16.3125 28.8413C16.4212 29.2119 16.6275 29.5469 16.91 29.81C17.2581 30.1525 17.7244 30.3475 18.2125 30.3538C18.5715 30.3521 18.9241 30.2587 19.2369 30.0825C19.7019 30.3488 20.2469 30.4388 20.7731 30.3363C21.0493 30.2857 21.311 30.1751 21.5397 30.0121C21.7684 29.8491 21.9584 29.6378 22.0962 29.3932C22.1094 29.3725 22.1169 29.3544 22.1287 29.3338C22.66 29.4425 23.2131 29.3469 23.6775 29.0663C24.0859 28.8357 24.3968 28.4649 24.5525 28.0225C25.1112 28.03 25.6525 27.8288 26.0694 27.4569C26.2978 27.2573 26.4752 27.0059 26.5867 26.7238C26.6983 26.4416 26.7407 26.1369 26.7106 25.835C26.7106 25.8175 26.7062 25.8038 26.705 25.7869C27.0312 25.6892 27.3246 25.5044 27.5537 25.2525C27.85 24.9402 28.0407 24.5427 28.099 24.1161C28.1573 23.6896 28.0803 23.2555 27.8787 22.875C28.4406 22.2258 28.8658 21.4699 29.1287 20.6525C29.1437 20.6044 29.1562 20.5519 29.1712 20.5ZM28.1012 19.4375C28.0701 19.7518 28.001 20.0611 27.8956 20.3588L27.8756 20.4213C27.6679 20.9773 27.3684 21.4945 26.9894 21.9513C25.0287 20.24 22.1769 17.7425 21.9425 17.5188C21.6718 17.2597 21.3122 17.1139 20.9375 17.1113C20.8213 17.1103 20.7056 17.1269 20.5944 17.1607C20.1981 17.2857 19.2244 17.5982 18.3744 17.9138C18.0494 18.0344 17.6781 17.7263 17.565 17.4638C17.49 17.3063 17.4775 17.1263 17.5287 16.96C17.6306 16.7757 17.8019 16.6388 18.0044 16.58C19.927 15.9042 21.9357 15.5044 23.9706 15.3925H24.0462C24.1156 15.3925 24.1844 15.3875 24.2481 15.3863C24.7149 15.3786 25.1784 15.4665 25.61 15.6444C26.2501 15.9362 26.812 16.3752 27.25 16.9257C27.6409 17.3681 27.9143 17.9018 28.045 18.4775L28.0506 18.5063C28.0807 18.6601 28.0997 18.816 28.1075 18.9725C28.1094 19.0232 28.1125 19.0869 28.1125 19.1432C28.1125 19.2338 28.1125 19.3238 28.1019 19.4132L28.1012 19.4375ZM12.5044 23.5994C12.5 23.5725 12.5 23.5432 12.5 23.515C12.4931 23.4548 12.4931 23.394 12.5 23.3338C12.5069 23.2983 12.5159 23.2632 12.5269 23.2288C12.5394 23.1732 12.5581 23.1188 12.5806 23.0669C12.6012 23.0294 12.625 22.9932 12.6512 22.9594C12.6884 22.8985 12.7336 22.8428 12.7856 22.7938L12.7894 22.7907L13.965 21.7938C14.0431 21.7336 14.1323 21.6895 14.2275 21.6638C14.3227 21.6382 14.422 21.6316 14.5197 21.6443C14.6175 21.6571 14.7118 21.689 14.7972 21.7383C14.8826 21.7875 14.9575 21.8531 15.0175 21.9313C15.0612 21.9953 15.0896 22.0685 15.1004 22.1452C15.1113 22.222 15.1043 22.3002 15.08 22.3738L13.2362 24.17C13.109 24.1723 12.9833 24.1416 12.8714 24.0808C12.7596 24.02 12.6654 23.9312 12.5981 23.8232C12.5517 23.7559 12.5197 23.6797 12.5044 23.5994ZM14.0769 25.0963L16.1 23.125L16.0906 23.1157C16.2045 23.059 16.333 23.0389 16.4587 23.0582C16.6194 23.1019 16.7644 23.1919 16.875 23.3169C16.985 23.4107 17.0587 23.5394 17.0837 23.6819C17.093 23.8263 17.0614 23.9703 16.9925 24.0975C16.9861 24.1149 16.9807 24.1327 16.9762 24.1507L14.9319 26.1425C14.7884 26.1488 14.6453 26.1241 14.5122 26.0702C14.3792 26.0163 14.2592 25.9344 14.1606 25.83C14.0795 25.7278 14.0286 25.6048 14.0138 25.4751C13.999 25.3454 14.0208 25.2142 14.0769 25.0963ZM15.8175 27.0244L17.93 24.9688C18.0644 24.9957 18.1875 25.0644 18.2812 25.165C18.4108 25.2785 18.501 25.4301 18.5387 25.5982C18.5486 25.6704 18.5454 25.7439 18.5294 25.815L16.7025 27.5932C16.5806 27.6158 16.455 27.607 16.3374 27.5676C16.2199 27.5283 16.1143 27.4596 16.0306 27.3682C15.933 27.2724 15.8599 27.1544 15.8175 27.0244ZM17.7781 28.9069C17.6651 28.8071 17.5758 28.6832 17.5169 28.5444L19.2425 26.865C19.3656 26.9057 19.4781 26.9725 19.5725 27.0607C19.6606 27.131 19.7271 27.2248 19.7644 27.3313C19.7856 27.4101 19.7856 27.4931 19.7644 27.5719C19.6863 27.824 19.5562 28.057 19.3825 28.2557L18.91 28.8057H18.9137C18.8981 28.8157 18.8806 28.82 18.8662 28.8313C18.69 28.9921 18.4633 29.0865 18.225 29.0982C18.0568 29.0953 17.8963 29.0267 17.7781 28.9069ZM20.5744 29.0988C20.4819 29.1132 20.3887 29.1175 20.2956 29.1113L20.3419 29.0575L20.3569 29.0394L20.3575 29.04C20.5469 28.8059 20.7073 28.5497 20.835 28.2769L21.1112 28.5694C21.0886 28.6283 21.0615 28.6854 21.03 28.74C20.9854 28.8299 20.9214 28.9087 20.8426 28.9708C20.7638 29.0328 20.6722 29.0766 20.5744 29.0988ZM24.5744 26.7707L23.4625 25.5388C23.367 25.4271 23.2352 25.3526 23.0902 25.3285C22.9453 25.3044 22.7965 25.3322 22.67 25.407C22.5435 25.4819 22.4475 25.5989 22.3988 25.7375C22.3501 25.8762 22.3518 26.0276 22.4037 26.165C22.4327 26.243 22.4769 26.3144 22.5337 26.375L23.4312 27.375C23.425 27.4388 23.4119 27.5019 23.3919 27.5625C23.3398 27.7396 23.2211 27.8895 23.0606 27.9807C22.8652 28.1088 22.6281 28.1572 22.3981 28.1157L21.6481 27.3194C21.5671 27.2343 21.4637 27.1738 21.3497 27.1452C21.2357 27.1165 21.116 27.1208 21.0044 27.1575C20.9947 27.0968 20.9815 27.0367 20.965 26.9775C20.8618 26.651 20.6699 26.3595 20.4106 26.1357C20.229 25.9699 20.0209 25.8358 19.795 25.7388C19.7993 25.6225 19.792 25.5061 19.7731 25.3913C19.6925 24.9657 19.4787 24.5767 19.1625 24.2807C18.9327 24.0479 18.6485 23.8761 18.3356 23.7807C18.3387 23.6969 18.3356 23.6138 18.3262 23.5307C18.2678 23.1097 18.0666 22.7216 17.7562 22.4313C17.4736 22.1354 17.1106 21.9288 16.7119 21.8369C16.5762 21.8107 16.4379 21.8013 16.3 21.8088C16.2509 21.5766 16.1518 21.358 16.0094 21.1682C15.8489 20.9598 15.6489 20.7851 15.4209 20.6541C15.1928 20.5231 14.9412 20.4384 14.6804 20.4048C14.4195 20.3712 14.1546 20.3893 13.9008 20.4582C13.647 20.5271 13.4093 20.6454 13.2012 20.8063L13.1794 20.8238L12.4075 21.4738C12.0456 20.8147 11.8724 20.0686 11.907 19.3174C11.9416 18.5663 12.1827 17.8393 12.6037 17.2163L12.6169 17.1975C12.9591 16.6873 13.408 16.2574 13.9325 15.9375C14.8893 15.4392 15.985 15.274 17.0462 15.4682L17.3362 15.5144C16.9078 15.7075 16.5656 16.0517 16.375 16.4813C16.2829 16.717 16.2391 16.9688 16.2461 17.2217C16.2532 17.4747 16.3111 17.7236 16.4162 17.9538C16.6035 18.4066 16.9526 18.7735 17.3956 18.9829C17.8386 19.1922 18.3438 19.2291 18.8125 19.0863C19.6375 18.7807 20.5837 18.4738 20.9375 18.3619C20.9656 18.361 20.9936 18.3664 21.0194 18.3778C21.0451 18.3891 21.068 18.4061 21.0862 18.4275C21.3919 18.715 25.0812 21.9444 26.6225 23.2875L26.7475 23.3944C26.8446 23.5516 26.886 23.7368 26.8653 23.9204C26.8446 24.104 26.7628 24.2753 26.6331 24.4069C26.5441 24.5029 26.4271 24.5685 26.2987 24.5944L25.2156 23.4963C25.0977 23.3841 24.9409 23.3221 24.7781 23.3233C24.6154 23.3246 24.4595 23.389 24.3433 23.503C24.2272 23.6171 24.1599 23.7717 24.1557 23.9344C24.1514 24.0971 24.2106 24.2551 24.3206 24.375L25.3556 25.4238C25.36 25.4425 25.365 25.4613 25.3706 25.4794L25.3781 25.4988C25.425 25.6322 25.4534 25.7714 25.4625 25.9125C25.4798 26.0197 25.4706 26.1295 25.4356 26.2322C25.4007 26.335 25.341 26.4276 25.2619 26.5019C25.075 26.6769 24.8281 26.7732 24.5725 26.7707H24.5744Z" fill="#05976A"/>
                                </svg>
                            </p>
                            <p class="banner-header text-sm py-3">Customer Satisfaction</p>
                            <p class="text-sm">
                                Your satisfaction is our priority. Our dedicated support team is ready to assist you, ensuring a smooth and pleasant experience every time.
                            </p>
                        </div>
                    </div>
                    <div class="flex py-6">
                        <div class="px-8 py-3 green-bg rounded-full">
                            <a href="" class="white-text hover:text-white lg:text-sm text-xs">Learn More</a>
                        </div>
                        <div class="mx-4">
                            <svg width="84" height="41" viewBox="0 0 94 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M91.2668 30.2172C91.7101 30.7465 92.4985 30.8161 93.0278 30.3728C93.557 29.9295 93.6266 29.1411 93.1833 28.6119L91.2668 30.2172ZM45.0247 14.5569L45.2227 15.7911L45.0247 14.5569ZM0.0033443 10.0052L13.7261 14.4796L10.7397 0.358146L0.0033443 10.0052ZM93.1833 28.6119C87.4317 21.7455 69.8456 9.30898 44.8267 13.3227L45.2227 15.7911C69.2242 11.9406 85.9767 23.9018 91.2668 30.2172L93.1833 28.6119ZM44.8267 13.3227C40.8148 13.9663 37.7589 15.3662 35.5427 17.3372C33.3217 19.3126 32.0186 21.7957 31.41 24.4738C30.2053 29.7756 31.7077 35.8638 34.1298 40.7005C35.3492 43.1356 36.8311 45.3148 38.3933 46.9757C39.9267 48.606 41.6597 49.8666 43.4035 50.2232C44.3046 50.4075 45.2309 50.3531 46.1003 49.9539C46.9655 49.5566 47.6697 48.8662 48.2161 47.9562C49.2823 46.1805 49.8426 43.4163 49.872 39.6052L47.3721 39.5859C47.3437 43.2558 46.7908 45.4735 46.0728 46.6692C45.7271 47.245 45.3714 47.5376 45.0571 47.682C44.747 47.8243 44.3741 47.87 43.9044 47.7739C42.9065 47.5699 41.6112 46.748 40.2144 45.2629C38.8462 43.8083 37.4958 41.839 36.3651 39.5811C34.0871 35.0321 32.8187 29.5571 33.8479 25.0278C34.3563 22.7902 35.4214 20.7908 37.2041 19.2053C38.9918 17.6154 41.5752 16.3763 45.2227 15.7911L44.8267 13.3227ZM49.872 39.6052C49.9719 26.688 45.2813 17.7749 37.9039 12.4047C30.5781 7.07206 20.7859 5.36543 10.878 6.43425L11.1461 8.91983C20.6468 7.89493 29.7569 9.56649 36.4326 14.4259C43.0568 19.2479 47.4668 27.3409 47.3721 39.5859L49.872 39.6052Z" fill="#05976A"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div>
                    <img class="ml-auto px-4" src="{{ asset('images/photo_3.png') }}" alt="Why Us">
                </div>
            </div>

            <!-- How it works  -->
            <div id="how_it_works" class="px-16 my-8 white-text">
                <div class="banner-header text-center">
                    How does it work
                </div>
                <div class="text-center text-sm">
                    Start using our bill payment system in three easy steps
                </div>
                <div class="lg:flex lg:justify-center py-16">
                    <!-- Step 1  -->
                    <div class="bg-gray-200 bg-opacity-20 rounded-lg p-4">
                        <div>
                            <svg width="55" height="55" viewBox="0 0 75 75" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="37.5" cy="37.5" r="37.5" fill="#05976A"/>
                                <path d="M33.7802 33.58V30.4H39.3202V45H35.7602V33.58H33.7802Z" fill="white"/>
                            </svg>
                        </div>  
                        <div>
                            <p class="banner-header text-sm py-3">Sign Up</p>
                            <p class="text-sm">
                                Create account with an active <br> email to get started
                            </p>
                        </div> 
                    </div>
                    <!-- Arrow 1  -->
                    <div class="lg:relative lg:top-32">
                        <svg width="138" height="38" viewBox="0 0 138 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M135.893 0.25774C136.302 0.198383 136.683 0.482582 136.742 0.892521L137.71 7.57285C137.769 7.98279 137.485 8.36323 137.075 8.42259C136.665 8.48195 136.284 8.19775 136.225 7.78781L135.365 1.84974L129.427 2.70958C129.017 2.76894 128.637 2.48473 128.577 2.07479C128.518 1.66486 128.802 1.28442 129.212 1.22506L135.893 0.25774ZM1.55486 0.495392C13.8408 14.005 35.2796 30.1875 59.6425 34.9009C71.8091 37.2547 84.6978 36.7477 97.5553 31.6295C110.414 26.5108 123.29 16.7607 135.399 0.551144L136.601 1.44886C124.357 17.8391 111.27 27.7846 98.1101 33.0231C84.9492 38.2621 71.7644 38.7739 59.3575 36.3736C34.5733 31.5787 12.8651 15.1615 0.445138 1.50461L1.55486 0.495392Z" fill="white"/>
                        </svg>
                    </div>
                    <!-- Step 2  -->
                    <div class="bg-gray-200 bg-opacity-20 rounded-lg p-4">
                        <div>
                            <svg width="55" height="55" viewBox="0 0 75 75" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="37.5" cy="37.5" r="37.5" fill="#05976A"/>
                                <path d="M32.0671 42.26C32.5204 41.9 32.7271 41.7333 32.6871 41.76C33.9938 40.68 35.0204 39.7933 35.7671 39.1C36.5271 38.4067 37.1671 37.68 37.6871 36.92C38.2071 36.16 38.4671 35.42 38.4671 34.7C38.4671 34.1533 38.3404 33.7267 38.0871 33.42C37.8338 33.1133 37.4538 32.96 36.9471 32.96C36.4404 32.96 36.0404 33.1533 35.7471 33.54C35.4671 33.9133 35.3271 34.4467 35.3271 35.14H32.0271C32.0538 34.0067 32.2938 33.06 32.7471 32.3C33.2138 31.54 33.8204 30.98 34.5671 30.62C35.3271 30.26 36.1671 30.08 37.0871 30.08C38.6738 30.08 39.8671 30.4867 40.6671 31.3C41.4804 32.1133 41.8871 33.1733 41.8871 34.48C41.8871 35.9067 41.4004 37.2333 40.4271 38.46C39.4538 39.6733 38.2138 40.86 36.7071 42.02H42.1071V44.8H32.0671V42.26Z" fill="white"/>
                            </svg>
                        </div>  
                        <div>
                            <p class="banner-header text-sm py-3">Fund Account</p>
                            <p class="text-sm">
                                Use our secured and reliable <br> payment gateway to fund your account
                            </p>
                        </div> 
                    </div>
                    <!-- Arrow 2  -->
                    <div class="lg:relative lg:top-10">
                        <svg width="138" height="38" viewBox="0 0 138 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M135.893 37.7423C136.302 37.8016 136.683 37.5174 136.742 37.1075L137.71 30.4272C137.769 30.0172 137.485 29.6368 137.075 29.5774C136.665 29.5181 136.284 29.8023 136.225 30.2122L135.365 36.1503L129.427 35.2904C129.017 35.2311 128.637 35.5153 128.577 35.9252C128.518 36.3351 128.802 36.7156 129.212 36.7749L135.893 37.7423ZM1.55486 37.5046C13.8408 23.995 35.2796 7.81249 59.6425 3.09913C71.8091 0.745296 84.6978 1.25228 97.5553 6.37051C110.414 11.4892 123.29 21.2393 135.399 37.4489L136.601 36.5511C124.357 20.1609 111.27 10.2154 98.1101 4.97687C84.9492 -0.262104 71.7644 -0.773862 59.3575 1.62643C34.5733 6.42133 12.8651 22.8385 0.445138 36.4954L1.55486 37.5046Z" fill="white"/>
                        </svg>
                    </div>
                    <!-- Step 3  -->
                    <div class="bg-gray-200 bg-opacity-20 rounded-lg p-4">
                        <div>
                            <svg width="75" height="75" viewBox="0 0 75 75" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="37.5" cy="37.5" r="37.5" fill="#05976A"/>
                                <path d="M32.4653 34.52C32.5186 33.0933 32.9853 31.9933 33.8653 31.22C34.7453 30.4467 35.9386 30.06 37.4453 30.06C38.4453 30.06 39.2986 30.2333 40.0053 30.58C40.7253 30.9267 41.2653 31.4 41.6253 32C41.9986 32.6 42.1853 33.2733 42.1853 34.02C42.1853 34.9 41.9653 35.62 41.5253 36.18C41.0853 36.7267 40.572 37.1 39.9853 37.3V37.38C40.7453 37.6333 41.3453 38.0533 41.7853 38.64C42.2253 39.2267 42.4453 39.98 42.4453 40.9C42.4453 41.7267 42.252 42.46 41.8653 43.1C41.492 43.7267 40.9386 44.22 40.2053 44.58C39.4853 44.94 38.6253 45.12 37.6253 45.12C36.0253 45.12 34.7453 44.7267 33.7853 43.94C32.8386 43.1533 32.3386 41.9667 32.2853 40.38H35.6053C35.6186 40.9667 35.7853 41.4333 36.1053 41.78C36.4253 42.1133 36.892 42.28 37.5053 42.28C38.0253 42.28 38.4253 42.1333 38.7053 41.84C38.9986 41.5333 39.1453 41.1333 39.1453 40.64C39.1453 40 38.9386 39.54 38.5253 39.26C38.1253 38.9667 37.4786 38.82 36.5853 38.82H35.9453V36.04H36.5853C37.2653 36.04 37.812 35.9267 38.2253 35.7C38.652 35.46 38.8653 35.04 38.8653 34.44C38.8653 33.96 38.732 33.5867 38.4653 33.32C38.1986 33.0533 37.832 32.92 37.3653 32.92C36.8586 32.92 36.4786 33.0733 36.2253 33.38C35.9853 33.6867 35.8453 34.0667 35.8053 34.52H32.4653Z" fill="white"/>
                            </svg>
                        </div>  
                        <div>
                            <p class="banner-header text-sm py-3">Start Transacting</p>
                            <p class="text-sm">
                                You are all set to start using our <br> seamless bill payment system
                            </p>
                        </div> 
                    </div>
                </div>
            </div>

            <!-- Testimonials  -->
            <div id="testimonials" class="px-4">
                <div class="lg:px-8">
                    <div class="banner-header text-2xl text-center">
                        What people say about us
                    </div>
                    <div class="lg:grid lg:grid-cols-3 gap-8 py-12">
                        <!-- First  -->
                        <div class="bg-white rounded-2xl p-6 my-4">
                            <div class="flex justify-between my-4">
                                <div class="flex items-center">
                                    <div>
                                        <img class="w-16 rounded-full" src="{{ asset('images/yusuf.jpg') }}" alt="Customer 1">
                                    </div>
                                    <div class="text-xs ml-3">
                                        <b>Kabir Yusuf Bashir</b><br>
                                        <i>C.E.O Team Piccolo</i>
                                    </div>
                                </div>
                                <div>
                                    <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.408 13.832V9.464C16.408 7.832 16.12 6.328 15.544 4.952C14.968 3.576 13.992 2.184 12.616 0.775997L10.12 2.744C11.144 3.8 11.864 4.776 12.28 5.672C12.696 6.568 12.904 7.528 12.904 8.552L14.392 7.16H9.688V13.832H16.408ZM6.856 13.832V9.464C6.856 7.832 6.568 6.328 5.992 4.952C5.416 3.576 4.44 2.184 3.064 0.775997L0.568 2.744C1.592 3.8 2.312 4.776 2.728 5.672C3.144 6.568 3.352 7.528 3.352 8.552L4.84 7.16H0.136V13.832H6.856Z" fill="#05976A"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-sm my-4">
                                PiccoloPay has always been the best when it comes to bill payments
                            </div>
                        </div>
                        <!-- Second  -->
                        <div class="bg-white rounded-2xl p-6 my-4">
                            <div class="flex justify-between my-4">
                                <div class="flex items-center">
                                    <div>
                                        <img class="w-16 rounded-full" src="{{ asset('images/yusuf.jpg') }}" alt="Customer 1">
                                    </div>
                                    <div class="text-xs ml-3">
                                        <b>Kabir Yusuf Bashir</b><br>
                                        <i>C.E.O Team Piccolo</i>
                                    </div>
                                </div>
                                <div>
                                    <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.408 13.832V9.464C16.408 7.832 16.12 6.328 15.544 4.952C14.968 3.576 13.992 2.184 12.616 0.775997L10.12 2.744C11.144 3.8 11.864 4.776 12.28 5.672C12.696 6.568 12.904 7.528 12.904 8.552L14.392 7.16H9.688V13.832H16.408ZM6.856 13.832V9.464C6.856 7.832 6.568 6.328 5.992 4.952C5.416 3.576 4.44 2.184 3.064 0.775997L0.568 2.744C1.592 3.8 2.312 4.776 2.728 5.672C3.144 6.568 3.352 7.528 3.352 8.552L4.84 7.16H0.136V13.832H6.856Z" fill="#05976A"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-sm my-4">
                                PiccoloPay communication has the best service and experience I have seen so far
                            </div>
                        </div>
                        <!-- Third  -->
                        <div class="bg-white rounded-2xl p-6 my-4">
                            <div class="flex justify-between my-4">
                                <div class="flex items-center">
                                    <div>
                                        <img class="w-16 rounded-full" src="{{ asset('images/yusuf.jpg') }}" alt="Customer 1">
                                    </div>
                                    <div class="text-xs ml-3">
                                        <b>Kabir Yusuf Bashir</b><br>
                                        <i>C.E.O Team Piccolo</i>
                                    </div>
                                </div>
                                <div>
                                    <svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.408 13.832V9.464C16.408 7.832 16.12 6.328 15.544 4.952C14.968 3.576 13.992 2.184 12.616 0.775997L10.12 2.744C11.144 3.8 11.864 4.776 12.28 5.672C12.696 6.568 12.904 7.528 12.904 8.552L14.392 7.16H9.688V13.832H16.408ZM6.856 13.832V9.464C6.856 7.832 6.568 6.328 5.992 4.952C5.416 3.576 4.44 2.184 3.064 0.775997L0.568 2.744C1.592 3.8 2.312 4.776 2.728 5.672C3.144 6.568 3.352 7.528 3.352 8.552L4.84 7.16H0.136V13.832H6.856Z" fill="#05976A"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="text-sm my-4">
                                This company is good on what they do for sure
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End of Page Contents  -->
@endsection

@section('footer')
    @include('includes.footer')
@endsection