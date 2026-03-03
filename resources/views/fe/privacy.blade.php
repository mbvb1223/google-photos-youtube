@extends('fe.layouts.app')

@section('title', 'Privacy Policy - Photos2Tube')

@section('content')
    <main class="flex-1 px-6 py-12 lg:py-24">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 dark:text-white mb-4 tracking-tight">Privacy Policy</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mb-12">Last updated: {{ date('F j, Y') }}</p>

            <div class="prose prose-slate dark:prose-invert max-w-none space-y-8 text-slate-600 dark:text-slate-400 leading-relaxed">
                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">1. Introduction</h2>
                    <p>Photos2Tube ("we", "our", or "us") operates the photos2tube.com website and service. This Privacy Policy explains how we collect, use, and protect your personal information when you use our service to transfer videos from Google Photos to YouTube.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">2. Information We Collect</h2>
                    <p class="mb-3">We collect the following types of information:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li><strong class="text-slate-900 dark:text-white">Account Information:</strong> Your name and email address when you create an account.</li>
                        <li><strong class="text-slate-900 dark:text-white">Google OAuth Tokens:</strong> When you connect your Google account, we receive OAuth access and refresh tokens to access Google Photos and YouTube on your behalf. These tokens are stored encrypted.</li>
                        <li><strong class="text-slate-900 dark:text-white">Transfer Data:</strong> Metadata about your video transfers, including video titles, descriptions, privacy settings, and transfer status.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">3. How We Use Your Information</h2>
                    <p class="mb-3">We use your information solely to:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Authenticate you and maintain your account.</li>
                        <li>Access your Google Photos library to let you select videos for transfer.</li>
                        <li>Upload selected videos to your YouTube channel on your behalf.</li>
                        <li>Display your transfer history and status.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">4. Google API Services Usage</h2>
                    <p class="mb-3">Our use and transfer of information received from Google APIs adheres to the <a href="https://developers.google.com/terms/api-services-user-data-policy" class="text-primary hover:underline" target="_blank" rel="noopener noreferrer">Google API Services User Data Policy</a>, including the Limited Use requirements.</p>
                    <p class="mb-3">Specifically:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>We only access Google user data that is necessary to provide the video transfer functionality.</li>
                        <li>We do not use Google user data for advertising purposes.</li>
                        <li>We do not sell Google user data to third parties.</li>
                        <li>We do not use Google user data for purposes unrelated to the core functionality of transferring videos from Google Photos to YouTube.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">5. Data Storage and Security</h2>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>OAuth tokens are stored using encrypted database fields and are never exposed in plaintext.</li>
                        <li>Videos are temporarily downloaded during transfer and are deleted from our servers immediately after upload to YouTube completes.</li>
                        <li>We do not permanently store any of your video content.</li>
                        <li>All data transmission is encrypted using HTTPS/TLS.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">6. Data Sharing</h2>
                    <p>We do not sell, trade, or share your personal information with third parties, except as required to provide the service (i.e., communicating with Google APIs) or as required by law.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">7. Data Retention and Deletion</h2>
                    <p class="mb-3">You may disconnect your Google accounts or delete your Photos2Tube account at any time. When you do:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Your stored OAuth tokens are immediately deleted.</li>
                        <li>Your transfer history and account data are permanently removed.</li>
                        <li>You can also revoke access via your <a href="https://myaccount.google.com/permissions" class="text-primary hover:underline" target="_blank" rel="noopener noreferrer">Google Account permissions page</a>.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">8. Your Rights</h2>
                    <p class="mb-3">You have the right to:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Access the personal data we hold about you.</li>
                        <li>Request correction of inaccurate data.</li>
                        <li>Request deletion of your data.</li>
                        <li>Disconnect your Google accounts at any time from your dashboard.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">9. Contact Us</h2>
                    <p>If you have questions about this Privacy Policy or your data, please contact us at <a href="mailto:support@photos2tube.com" class="text-primary hover:underline">support@photos2tube.com</a> or visit our <a href="{{ route('contact') }}" class="text-primary hover:underline">contact page</a>.</p>
                </section>
            </div>
        </div>
    </main>
@endsection
