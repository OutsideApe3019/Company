@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Terms and Conditions') }}
                    </div>
                    <div class="card-body">
                        <h4>Welcome to Company!</h4>

                        <p>By using our services, you agree to the following terms and conditions:</p>
                        <ol>
                            <li>Use of Services: You must be 14 years of age or older to use our services. By using our services, you represent and warrant that you have the right, authority, and capacity to enter into this agreement and to abide by all of the terms and conditions set forth below.</li>
                            <li>Privacy Policy: We respect your privacy and are committed to protecting it. Our Privacy Policy, which is incorporated into these terms and conditions by this reference, explains how we collect, use, and disclose information about you.</li>
                            <li>User Content: You are responsible for any content or information that you submit, post, or display on or through our services. You retain ownership of any intellectual property rights that you hold in that content.</li>
                            <li>Limitation of Liability: Our services are provided "as is" and "as available." We do not guarantee that they will be error-free or uninterrupted. To the fullest extent permitted by law, we exclude all representations, warranties, and conditions of any kind, whether express or implied.</li>
                            <li>Indemnification: You agree to indemnify and hold us, our affiliates, and our and their respective officers, agents, partners, and employees, harmless from any loss, liability, claim, or demand, including reasonable attorneys' fees, made by any third party due to or arising out of your use of our services, your violation of these terms and conditions, or your violation of any rights of another.</li>
                            <li>Changes to These Terms and Conditions: We reserve the right to make changes to these terms and conditions from time to time. Your continued use of our services following the posting of any changes to these terms and conditions constitutes acceptance of those changes.</li>
                        </ol>
                        <h5>Thank you for using Company!</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
