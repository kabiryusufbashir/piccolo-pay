@extends('layout.template')

@section('pageTitle')
    <title>Piccolo Pay - Sign Up</title>        
@endsection

@section('pageMeta')
    <meta name ="description", content="Unlock a world of seamless transactions and top-notch services with Piccolo Pay. We pride ourselves on being your go-to destination for airtime, data, TV subscriptions and electricity bill purchases.">
    <meta name ="keywords", content="Data, Airtime">
    <meta name="author" content="Team Piccolo">
@endsection

@section('pageContents')
    <!-- Page Contents  -->
        <div id="pageContents" class="py-12 my-2">
            <div class="lg:mx-24 lg:grid grid-cols-2 items-center gap-4">
                <div class="mx-auto">
                    <div class="px-4">
                        <svg id="signUpIcon" viewBox="0 0 349 234" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_33_1426)">
                            <path d="M-1.52588e-05 124.368C-1.52588e-05 171.699 29.9893 212.027 71.9944 227.372C78.3844 229.711 84.9805 231.443 91.6951 232.545C110.168 235.576 129.107 233.855 146.732 227.545C189.003 212.326 219.211 171.862 219.191 124.344C219.191 63.8205 170.122 14.735 109.596 14.735C86.7208 14.7017 64.4138 21.8605 45.8275 35.1997C18.08 55.0864 -1.52588e-05 87.614 -1.52588e-05 124.368Z" fill="#E5E5E5"/>
                            <path d="M71.9944 227.372C78.3844 229.711 84.9805 231.443 91.6952 232.545C110.168 235.575 129.107 233.855 146.732 227.545L141.671 207.23L141.365 206.01L131.037 206.05L79.148 206.236L78.4838 208.2L71.9944 227.372Z" fill="#2F2E41"/>
                            <path d="M253.801 0H349V107.757H253.801V0Z" fill="#E6E6E6"/>
                            <path d="M255.665 2.27979H347.303V105.478H255.665V2.27979Z" fill="white"/>
                            <path d="M301.4 101.809C298.563 101.809 296.264 99.5081 296.264 96.6702C296.264 93.8323 298.563 91.5317 301.4 91.5317C304.237 91.5317 306.537 93.8323 306.537 96.6702C306.537 99.5081 304.237 101.809 301.4 101.809Z" fill="#E6E6E6"/>
                            <path d="M302.268 38.8096H331.772V41.8288H302.268V38.8096Z" fill="#E6E6E6"/>
                            <path d="M287.243 47.8569H331.772V50.8761H287.243V47.8569Z" fill="#05976A"/>
                            <path d="M291.614 56.9609H331.772V59.9802H291.614V56.9609Z" fill="#E6E6E6"/>
                            <path d="M269.759 65.8247H331.772V68.8439H269.759V65.8247Z" fill="#05976A"/>
                            <path d="M280.588 74.2661H331.127V77.2853H280.588V74.2661Z" fill="#E6E6E6"/>
                            <path d="M213.63 175.343C213.268 175.715 212.936 176.114 212.636 176.539L166.105 175.4L160.677 165.477L144.636 171.715L152.54 190.215C153.179 191.71 154.284 192.957 155.692 193.769C157.099 194.581 158.732 194.915 160.345 194.72L212.917 188.367C214.157 189.938 215.846 191.093 217.759 191.68C219.671 192.267 221.717 192.258 223.625 191.653C225.532 191.049 227.21 189.878 228.435 188.296C229.661 186.714 230.376 184.796 230.486 182.798C230.595 180.8 230.094 178.815 229.048 177.109C228.003 175.403 226.463 174.055 224.634 173.245C222.804 172.436 220.771 172.203 218.806 172.577C216.841 172.951 215.036 173.915 213.631 175.341L213.63 175.343Z" fill="#9F616A"/>
                            <path d="M151.001 118.682L129.225 111.543L122.829 102.769L91.705 104.612L87.1356 114.851L70.5395 122.695L73.0901 170.078L77.4533 214.421C99.8899 202.799 141.762 211.66 142.129 211.804L151.001 118.682Z" fill="#05976A"/>
                            <path d="M146.346 182.817L168.495 173.952L168.401 173.558C168.306 173.159 158.879 133.752 157.627 127.419C156.323 120.822 151.559 118.998 151.357 118.924L151.209 118.869L142.443 121.538L138.593 151.797L146.346 182.817Z" fill="#05976A"/>
                            <path d="M98.5202 212.472C98.001 212.46 97.4816 212.489 96.967 212.558L66.1649 177.651L69.7477 166.925L54.2688 159.399L46.0807 177.775C45.4191 179.26 45.2569 180.919 45.6182 182.504C45.9795 184.088 46.845 185.513 48.0846 186.564L88.4856 220.807C88.1778 222.784 88.4791 224.808 89.3494 226.61C90.2197 228.412 91.6178 229.906 93.3578 230.894C95.0977 231.882 97.0971 232.316 99.0899 232.14C101.083 231.963 102.974 231.184 104.514 229.905C106.053 228.627 107.166 226.91 107.706 224.983C108.246 223.056 108.187 221.01 107.537 219.118C106.886 217.225 105.675 215.576 104.064 214.389C102.454 213.202 100.52 212.533 98.5202 212.472Z" fill="#9F616A"/>
                            <path d="M68.6235 181.049L81.4725 150.815L76.4609 129.755L71.0612 122.931C70.6657 122.762 70.2395 122.677 69.8094 122.681C69.3793 122.685 68.9547 122.778 68.5624 122.954C66.5698 123.756 64.876 126.214 63.522 130.258L51.4801 164.569L68.6235 181.049Z" fill="#05976A"/>
                            <path d="M135.287 91.5659V68.7723C135.301 64.7612 134.524 60.7869 133.002 57.0761C131.48 53.3653 129.242 49.9908 126.416 47.1451C123.59 44.2995 120.231 42.0385 116.532 40.4913C112.833 38.9441 108.865 38.1409 104.855 38.1276C100.846 38.1143 96.8725 38.8912 93.163 40.4139C89.4535 41.9365 86.0801 44.1752 83.2354 47.002C80.3907 49.8289 78.1305 53.1885 76.5838 56.8891C75.0371 60.5897 74.2342 64.5589 74.2209 68.5699C74.2207 68.6373 74.2207 68.7048 74.2209 68.7723V91.5659C74.2221 92.6536 74.6546 93.6965 75.4236 94.4657C76.1925 95.2349 77.235 95.6676 78.3224 95.6688H131.186C132.273 95.6676 133.316 95.2349 134.085 94.4657C134.854 93.6965 135.286 92.6536 135.287 91.5659Z" fill="#2F2E41"/>
                            <path d="M111.028 95.1376C98.6652 95.1376 88.6427 85.1118 88.6427 72.7444C88.6427 60.3769 98.6652 50.3511 111.028 50.3511C123.392 50.3511 133.414 60.3769 133.414 72.7444C133.414 85.1118 123.392 95.1376 111.028 95.1376Z" fill="#9F616A"/>
                            <path d="M142.511 70.5959C142.503 64.1901 139.956 58.0488 135.428 53.5192C130.9 48.9897 124.761 46.4418 118.357 46.4346H113.8C107.396 46.4418 101.257 48.9897 96.7291 53.5192C92.2011 58.0488 89.6541 64.1902 89.647 70.5959V71.0517H99.2782L102.563 61.8492L103.22 71.0517H108.197L109.854 66.4093L110.186 71.0517H142.511V70.5959Z" fill="#2F2E41"/>
                            <path d="M113.231 98.2321C113.683 97.6196 113.954 96.8918 114.01 96.1326C114.067 95.3733 113.908 94.6134 113.552 93.9405C108.723 84.7519 101.962 67.7732 110.936 57.3023L111.58 56.5508H85.5242V95.683L109.194 99.8606C109.433 99.903 109.676 99.9245 109.92 99.9247C110.566 99.9248 111.203 99.7714 111.778 99.4774C112.354 99.1833 112.851 98.7568 113.23 98.2331L113.231 98.2321Z" fill="#2F2E41"/>
                            <path d="M301.483 8.39258C303.643 8.39247 305.755 9.03322 307.552 10.2338C309.348 11.4344 310.748 13.1409 311.575 15.1375C312.402 17.1341 312.619 19.3311 312.197 21.4508C311.776 23.5704 310.736 25.5175 309.208 27.0458C307.68 28.574 305.734 29.6148 303.615 30.0365C301.496 30.4583 299.3 30.242 297.304 29.4151C295.308 28.5881 293.602 27.1877 292.401 25.3908C291.201 23.5939 290.56 21.4813 290.56 19.3202V19.3196C290.56 17.8846 290.843 16.4637 291.392 15.138C291.941 13.8123 292.745 12.6077 293.76 11.593C294.774 10.5784 295.978 9.77348 297.303 9.22434C298.629 8.67521 300.049 8.39258 301.484 8.39258H301.483ZM301.483 11.6704C300.835 11.6704 300.201 11.8626 299.663 12.2228C299.124 12.583 298.704 13.0949 298.456 13.6938C298.208 14.2928 298.143 14.9518 298.269 15.5877C298.396 16.2235 298.708 16.8075 299.166 17.266C299.624 17.7244 300.208 18.0365 300.844 18.163C301.479 18.2895 302.138 18.2246 302.737 17.9765C303.336 17.7284 303.847 17.3083 304.207 16.7693C304.568 16.2302 304.76 15.5965 304.76 14.9482C304.76 14.0789 304.415 13.2452 303.8 12.6304C303.186 12.0157 302.352 11.6704 301.483 11.6704ZM301.483 27.4513C302.778 27.4453 304.051 27.1236 305.193 26.5138C306.335 25.9041 307.311 25.0249 308.037 23.9524C307.984 21.767 303.668 20.564 301.483 20.564C299.298 20.564 294.982 21.767 294.929 23.9524C295.655 25.0241 296.632 25.9027 297.774 26.5124C298.916 27.122 300.189 27.4442 301.483 27.4513Z" fill="#05976A"/>
                            <path d="M301.356 98.6396C296.856 90.3902 286.076 85.166 277.257 89.8749C273.288 91.9942 270.133 95.7429 269.131 100.174C267.969 105.321 270.418 110.229 272.946 114.553C274.318 116.9 275.822 119.199 276.958 121.675C278.134 124.239 278.975 127.202 278.089 129.991C277.292 132.503 275.294 134.331 273.105 135.674C270.689 137.1 268.12 138.248 265.446 139.096C259.942 140.927 254.136 141.679 248.348 141.309C245.471 141.113 242.618 140.652 239.826 139.931C236.856 139.173 233.941 138.213 230.966 137.472C225.999 136.238 220.336 135.625 215.626 138.104C211.05 140.513 209.002 145.552 208.369 150.454C207.199 159.505 210.787 168.898 217.265 175.237C220.372 178.278 224.283 180.791 228.543 181.819C232.26 182.716 237.032 182.658 239.99 179.879C243.29 176.777 242.514 171.803 239.892 168.53C236.546 164.355 230.878 163.352 225.82 163.25C220.066 163.134 214.317 163.992 208.566 163.459C205.759 163.24 203.005 162.576 200.407 161.49C198.123 160.485 196.04 159.075 194.258 157.328C190.708 153.877 188.313 149.28 187.122 144.501C185.689 138.754 186.001 132.713 187.114 126.94C187.707 123.964 188.471 121.023 189.402 118.134C189.786 116.915 191.711 117.437 191.323 118.664C187.896 129.536 185.985 142.107 192.607 152.2C195.347 156.481 199.616 159.555 204.544 160.796C210.275 162.221 216.289 161.516 222.115 161.305C227.656 161.103 233.739 161.32 238.488 164.548C242.384 167.196 245.109 172.232 243.932 176.986C242.796 181.57 238.392 183.896 233.987 184.254C229.365 184.631 224.816 183.079 220.935 180.652C212.86 175.605 207.491 166.728 206.368 157.317C205.782 152.413 206.378 147.13 208.601 142.679C209.773 140.27 211.596 138.237 213.864 136.812C216.126 135.425 218.738 134.742 221.362 134.501C227.322 133.952 233.049 135.999 238.704 137.565C241.592 138.403 244.553 138.968 247.547 139.253C250.453 139.494 253.376 139.447 256.272 139.111C259.147 138.772 261.979 138.143 264.727 137.234C267.419 136.402 269.998 135.236 272.401 133.764C274.522 132.407 276.356 130.464 276.46 127.817C276.573 124.946 275.126 122.261 273.75 119.84C271.031 115.06 267.672 110.383 266.963 104.786C266.342 99.8904 268.312 95.0649 271.712 91.5729C273.417 89.8005 275.469 88.3992 277.74 87.4568C280.01 86.5144 282.451 86.0512 284.909 86.0963C289.955 86.2408 294.786 88.4357 298.498 91.8068C300.338 93.4797 301.887 95.448 303.081 97.6306C303.695 98.7572 301.975 99.7641 301.36 98.6366L301.356 98.6396Z" fill="white"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_33_1426">
                            <rect width="349" height="234" fill="white" transform="matrix(-1 0 0 1 349 0)"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </div>
                    <div class="slogan my-4 text-black hidden lg:block">
                        Do more with us by <br> creating an account
                    </div>
                </div>
                <div class="lg:bg-white py-4 rounded-2xl lg:px-8 px-4">
                    <div class="slogan my-4 hidden lg:block">
                        PiccoloPay
                    </div>
                    <div class="slogan my-2 text-black text-lg">
                        Create an account
                    </div>
                    <div class="text-xs">
                        Do more with piccolopay by creating an account
                    </div>
                    <div>
                        <form action="">
                            <div class="lg:grid grid-cols-2 gap-4 my-4">
                                <div class="yus-margin-bottom">
                                    <input class="input_box" type="text" placeholder="First Name" name="firstname" required>
                                </div>
                                <div>
                                    <input class="input_box" type="text" placeholder="Last Name" name="lastname" required>
                                </div>
                            </div>
                            <div class="my-4">
                                <input class="input_box" type="email" placeholder="Email" name="email" required>
                            </div>
                            <div class="my-4">
                                <input class="input_box" type="password" placeholder="Password" name="password" required>
                            </div>
                            <div class="my-4">
                                <input class="input_box" type="password" placeholder="Confirm Password" name="confirm_password" required>
                            </div>
                            <div class="my-4 submit_box">
                                <input class="" type="submit" value="Create Account" name="submit">
                            </div>
                        </form>
                    </div>
                    <div class="text-center text-sm">
                        Already have an account? <a href="{{ route('login') }}" class="green-text">Login</a>
                    </div>
                </div>
            </div>
        </div>
    <!-- End of Page Contents  -->
@endsection