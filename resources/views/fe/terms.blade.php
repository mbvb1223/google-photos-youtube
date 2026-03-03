@extends('fe.layouts.app')

@section('title', 'Terms of Service - Photos2Tube')

@section('content')
    <main class="flex-1 px-6 py-12 lg:py-24">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 dark:text-white mb-4 tracking-tight">Terms of Service</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mb-12">Last updated: January 15, 2026</p>

            <div class="prose prose-slate dark:prose-invert max-w-none space-y-8 text-slate-600 dark:text-slate-400 leading-relaxed">
                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">1. Acceptance of Terms</h2>
                    <p>By accessing or using Photos2Tube ("the Service"), you agree to be bound by these Terms of Service, our <a href="{{ route('privacy') }}" class="text-primary hover:underline">Privacy Policy</a>, the <a href="https://www.youtube.com/t/terms" class="text-primary hover:underline" target="_blank" rel="noopener noreferrer">YouTube Terms of Service</a>, and the <a href="https://policies.google.com/privacy" class="text-primary hover:underline" target="_blank" rel="noopener noreferrer">Google Privacy Policy</a>. If you do not agree to these terms, please do not use the Service.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">2. Description of Service</h2>
                    <p>Photos2Tube provides a tool that allows users to transfer videos from their Google Photos library to their YouTube channel. The Service acts as an intermediary, accessing your Google Photos and YouTube accounts via authorized Google OAuth 2.0 connections to facilitate video transfers.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">3. Account Requirements</h2>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>You must create an account to use the Service.</li>
                        <li>You must connect at least one Google account with Google Photos access and one with YouTube access to perform transfers.</li>
                        <li>You are responsible for maintaining the security of your account credentials.</li>
                        <li>You must be at least 13 years old to use the Service.</li>
                        <li>You are responsible for all activity that occurs under your account.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">4. Google Account Authorization</h2>
                    <p class="mb-3">By connecting your Google account, you authorize Photos2Tube to:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Access your Google Photos library to browse and select videos via the Google Photos Picker API.</li>
                        <li>Download selected videos temporarily for the sole purpose of transferring them to YouTube.</li>
                        <li>Upload videos to your YouTube channel using the YouTube Data API v3.</li>
                        <li>List and manage playlists on your YouTube channel if you choose to assign videos to a playlist.</li>
                    </ul>
                    <p class="mt-3">You may revoke this authorization at any time by:</p>
                    <ul class="list-disc pl-6 space-y-2 mt-2">
                        <li>Disconnecting your accounts from the Photos2Tube dashboard.</li>
                        <li>Removing Photos2Tube from your <a href="https://myaccount.google.com/permissions" class="text-primary hover:underline" target="_blank" rel="noopener noreferrer">Google Account permissions page</a>.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">5. User Content and Responsibilities</h2>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>You retain all ownership rights to your videos and content.</li>
                        <li>You are solely responsible for the content you transfer, including ensuring it complies with <a href="https://www.youtube.com/t/terms" class="text-primary hover:underline" target="_blank" rel="noopener noreferrer">YouTube's Terms of Service</a> and <a href="https://www.youtube.com/howyoutubeworks/policies/community-guidelines/" class="text-primary hover:underline" target="_blank" rel="noopener noreferrer">Community Guidelines</a>.</li>
                        <li>You must have the legal right to upload any content you transfer through the Service.</li>
                        <li>Photos2Tube does not review, moderate, or take responsibility for content transferred through the Service.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">6. Prohibited Uses</h2>
                    <p class="mb-3">You agree not to:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Use the Service to transfer content that infringes on intellectual property rights.</li>
                        <li>Use the Service for any illegal or unauthorized purpose.</li>
                        <li>Transfer content that violates YouTube's Community Guidelines.</li>
                        <li>Attempt to bypass any rate limits or restrictions imposed by the Service or Google APIs.</li>
                        <li>Use automated means to access the Service beyond its intended functionality.</li>
                        <li>Attempt to access other users' data or accounts.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">7. Privacy and Data Use</h2>
                    <p>Your use of the Service is also governed by our <a href="{{ route('privacy') }}" class="text-primary hover:underline">Privacy Policy</a>, which describes how we collect, use, and protect your data. By using the Service, you also acknowledge and agree to be bound by the <a href="https://policies.google.com/privacy" class="text-primary hover:underline" target="_blank" rel="noopener noreferrer">Google Privacy Policy</a>.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">8. Service Availability</h2>
                    <p>We strive to maintain the Service's availability, but we do not guarantee uninterrupted access. The Service depends on third-party APIs (Google Photos Picker API, YouTube Data API v3) which may experience downtime or changes outside our control. We are not liable for transfer failures caused by third-party service issues, API quota limitations, or network interruptions.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">9. Limitation of Liability</h2>
                    <p>Photos2Tube is provided "as is" and "as available" without warranties of any kind, either express or implied. We are not liable for any damages arising from your use of the Service, including but not limited to data loss, failed transfers, or content removed by YouTube. Your use of the Service is at your sole risk.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">10. Account Termination</h2>
                    <p class="mb-3">You may delete your account at any time from your profile settings. We reserve the right to suspend or terminate accounts that violate these terms or engage in prohibited uses.</p>
                    <p>Upon termination, your stored data (including OAuth tokens, transfer history, and account information) will be permanently deleted from our systems.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">11. Changes to Terms</h2>
                    <p>We may update these Terms of Service from time to time. We will update the "Last updated" date at the top of this page when changes are made. Continued use of the Service after changes constitutes acceptance of the updated terms.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">12. Contact</h2>
                    <p>For questions about these Terms of Service, please contact us at <a href="mailto:phamkhien2309@gmail.com" class="text-primary hover:underline">phamkhien2309@gmail.com</a> or visit our <a href="{{ route('contact') }}" class="text-primary hover:underline">contact page</a>.</p>
                </section>
            </div>
        </div>
    </main>
@endsection
