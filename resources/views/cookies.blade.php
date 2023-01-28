@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Cookies') }}
                    </div>
                    <div class="card-body">
                        <h5>Welcome to Company's Website Cookie Policy</h5>
                        <p>Our website uses cookies to improve your experience while you navigate through the website. Outlined below are the types of cookies we use and what information they collect.</p>
                        <ol>
                            <li>Types of Cookies: We use both session and persistent cookies on our website. Session cookies are temporary and expire when you close your browser, while persistent cookies remain on your device until they expire or you delete them.</li>
                            <li>Third-Party Cookies: We may also use third-party cookies from partners, such as Google Analytics, to analyze usage and traffic on our website.</li>
                            <li>Managing Cookies: You have the ability to accept or decline the use of cookies on our website through your browser settings. However, please note that disabling cookies may limit your ability to use certain features on our website.</li>
                            <li>Changes to this Cookie Policy: We reserve the right to make changes to this Cookie Policy from time to time. Your continued use of our website following the posting of any changes to this policy constitutes acceptance of those changes.</li>
                        </ol>
                        <p>Thank you for visiting Company's website. If you have any questions about our use of cookies, please do not hesitate to <a href="{{ route('contact') }}">contact us</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
