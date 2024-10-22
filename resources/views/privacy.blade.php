@extends('layout.template')

@section('pageTitle')
    <title>Piccolo Pay - Privacy</title>        
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

    <!-- Page Contents  -->
        <div class="">
            <!-- Services  -->
            <div id="services" class="lg:grid grid-cols-2 gap-4 items-center px-4">
                <div>
                    <img class="mx-auto" src="{{ asset('images/photo_2.png') }}" alt="Services">
                </div>
                <div>
                    <div class=''>
                        <div>        
                            <!-- Privacy Policy  -->
                            <div class="text-sm">
                                <!-- Information We Collect  -->
                                <div class="giwa-gray-bg p-3 my-2 text-xs cursor-pointer">
                                    <div>
                                        <div class="text-center py-2 text-xl">
                                            <b>PRIVACY POLICY</b>
                                        </div>
                                        <hr />
                                        <div class="text-center py-2">
                                            <b>INFORMATION WE COLLECT</b>
                                        </div>
                                        <div class="text-justify">
                                            <p class="py-1">
                                                <b>Personal Information</b>: When you use our App, we may collect personal information such as your name, contact information, date of birth, and gender.
                                            </p>
                                            <p class="py-1">
                                                <b>Device Information</b>: We may collect information about your device, including its unique device identifier, IP address, operating system, and mobile network information
                                            </p>
                                            <p class="py-1">
                                                <b>Usage Information</b>: We may collect information about how you use the App, including the pages you visit, the features you use, and the actions you take
                                            </p>
                                            <p class="py-1">
                                                <b>Location Information</b>: With your consent, we may collect your precise or approximate location information to provide location-based services
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- How We Use Your Information  -->
                                <div class="giwa-gray-bg p-3 my-2 text-xs cursor-pointer">
                                    <div>
                                        <div class="text-center">
                                            <b>HOW WE USE YOUR INFORMATION</b>
                                        </div>
                                        <div class="text-justify">
                                            <p class="py-1">
                                                <b>We may use the information we collect for the following purposes:</b>
                                            </p>
                                            <p class="py-1">
                                                - To provide and improve our services
                                            </p>
                                            <p class="py-1">                        
                                                - To conduct research and analysis to improve our services and develop new features
                                            </p>
                                            <p class="py-1">                        
                                                - To comply with legal obligations and protect our rights
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Data Sharing and Disclosure  -->
                                <div class="giwa-gray-bg p-3 my-2 text-xs cursor-pointer">
                                    <div>
                                        <div class="text-center">
                                            <b>DATA SHARING AND DISCLOSURE</b>
                                        </div>
                                        <div class="text-justify">
                                            <p class="py-1">
                                                <b>We may share your information with third parties in the following circumstances:</b>
                                            </p>
                                            <p class="py-1">
                                                - With your consent or at your direction
                                            </p>
                                            <p class="py-1">                    
                                                - With service providers who assist us in operating the App and providing services to you
                                            </p>
                                            <p class="py-1">                        
                                                - In response to legal requests or to protect our rights, property, or safety
                                            </p>
                                            <p class="py-1">                        
                                                - In connection with a business transaction, such as a merger, acquisition, or sale of assets
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Data Retention  -->
                                <div class="giwa-gray-bg p-3 my-2 text-xs cursor-pointer">
                                    <div>
                                        <div class="text-center">
                                            <b>DATA RETENTION</b>
                                        </div>
                                        <div class="text-justify">
                                            <p class="py-1">
                                                We will retain your information for as long as necessary to fulfill the purposes outlined in this Privacy Policy unless a longer retention period is required or permitted by law
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Security  -->
                                <div class="giwa-gray-bg p-3 my-2 text-xs cursor-pointer">
                                    <div>
                                        <div class="text-center">
                                            <b>SECURITY</b>
                                        </div>
                                        <div class="text-justify">
                                            <p class="py-1">
                                                We take reasonable measures to protect your information from unauthorized access, use, or disclosure. However, no method of transmission over the internet or electronic storage is 100% secure
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Updates to this Policy -->
                                <div class="giwa-gray-bg p-3 my-2 text-xs cursor-pointer">
                                    <div>
                                        <div class="text-center">
                                            <b>UPDATES TO THIS POLICY</b>
                                        </div>
                                        <div class="text-justify">
                                            <p class="py-1">                        
                                                We may update this Privacy Policy from time to time. We will notify you of any material changes by posting the updated policy on the App or by other means
                                            </p>
                                        </div>
                                    </div>
                                </div>

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