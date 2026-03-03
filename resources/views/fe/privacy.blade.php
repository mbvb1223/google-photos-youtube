@extends('fe.layouts.app')

@section('title', 'Privacy Policy - Photos2Tube')

@section('content')
    <main class="flex-1 px-6 py-12 lg:py-24">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 dark:text-white mb-4 tracking-tight">Privacy Policy</h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mb-12">Last updated: September 3, 2025</p>

            <div class="prose prose-slate dark:prose-invert max-w-none space-y-8 text-slate-600 dark:text-slate-400 leading-relaxed">
                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">1. Introduction</h2>
                    <p>Photos2Tube ("we", "our", or "us") operates the Photos2Tube website and service. This Privacy Policy explains how we collect, use, store, and protect your personal information when you use our service to transfer videos from Google Photos to YouTube.</p>
                    <p class="mt-3">By using Photos2Tube, you agree to the collection and use of information in accordance with this policy.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">2. Information We Collect</h2>
                    <p class="mb-3">We collect the following types of information:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li><strong class="text-slate-900 dark:text-white">Account Information:</strong> Your name and email address when you create an account.</li>
                        <li><strong class="text-slate-900 dark:text-white">Google OAuth Tokens:</strong> When you connect your Google account, we receive OAuth 2.0 access and refresh tokens. These tokens are stored encrypted and are used solely to access Google Photos and YouTube on your behalf.</li>
                        <li><strong class="text-slate-900 dark:text-white">Google Photos Data:</strong> When you use the Google Photos Picker, we receive metadata and video content for the items you select. Video content is only held temporarily during transfer.</li>
                        <li><strong class="text-slate-900 dark:text-white">YouTube Data:</strong> We access your YouTube channel information and playlist data to facilitate video uploads and playlist management.</li>
                        <li><strong class="text-slate-900 dark:text-white">Transfer Records:</strong> Metadata about your video transfers, including video titles, descriptions, privacy settings, and transfer status.</li>
                        <li><strong class="text-slate-900 dark:text-white">Cookies:</strong> We use essential session cookies to keep you logged in and maintain your preferences. We do not use tracking or advertising cookies.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">3. Google OAuth Scopes</h2>
                    <p class="mb-3">Photos2Tube requests the following Google OAuth scopes:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li><strong class="text-slate-900 dark:text-white">OpenID / Email / Profile:</strong> <code class="text-sm bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded">openid</code>, <code class="text-sm bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded">email</code>, <code class="text-sm bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded">profile</code> — to identify your Google account and display your account name and email address in the Photos2Tube dashboard.</li>
                        <li><strong class="text-slate-900 dark:text-white">Google Photos:</strong> <code class="text-sm bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded">https://www.googleapis.com/auth/photospicker.mediaitems.readonly</code> — to let you browse and select videos from your Google Photos library via the Google Photos Picker API.</li>
                        <li><strong class="text-slate-900 dark:text-white">YouTube:</strong> <code class="text-sm bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded">https://www.googleapis.com/auth/youtube</code> — to upload your selected videos to your YouTube channel, list your YouTube playlists, and add uploaded videos to your chosen playlist. This scope is required because the YouTube Data API v3 playlist management endpoints require this level of access. Photos2Tube only uses this scope for: (1) uploading videos, (2) listing your playlists, and (3) adding videos to playlists.</li>
                    </ul>
                    <p class="mt-3">We request only the minimum scopes necessary to provide the video transfer functionality. No other Google data is accessed or modified beyond the operations described above.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">4. How We Use Your Information</h2>
                    <p class="mb-3">We use your information solely to provide and improve the Photos2Tube service:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Authenticate you and maintain your account session.</li>
                        <li>Access your Google Photos library to let you select videos for transfer.</li>
                        <li>Download selected videos temporarily from Google Photos.</li>
                        <li>Upload selected videos to your YouTube channel on your behalf.</li>
                        <li>Add uploaded videos to your chosen YouTube playlist, if selected.</li>
                        <li>Display your transfer history and status on your dashboard.</li>
                    </ul>
                    <p class="mt-3">We do not use your data for any purpose other than providing the core video transfer functionality described above.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">5. Google API Services User Data Policy</h2>
                    <p class="mb-3">Photos2Tube uses <a href="https://developers.google.com/youtube/terms/api-services-terms-of-service" class="text-primary hover:underline" target="_blank" rel="noopener noreferrer">YouTube API Services</a> and the Google Photos Picker API. Our use and transfer of information received from Google APIs to any other app adheres to the <a href="https://developers.google.com/terms/api-services-user-data-policy" class="text-primary hover:underline" target="_blank" rel="noopener noreferrer">Google API Services User Data Policy</a>, including the Limited Use requirements.</p>
                    <p class="mb-3">In accordance with Limited Use requirements:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>We limit our use of Google user data to providing and improving user-facing features that are prominent in the application's user interface.</li>
                        <li>We do not transfer Google user data to third parties unless necessary to provide the service, for security purposes, or to comply with applicable laws.</li>
                        <li>We do not use or transfer Google user data for serving ads, including retargeting, personalized, or interest-based advertising.</li>
                        <li>We do not sell Google user data to any third party.</li>
                        <li>We do not allow humans to read Google user data unless we have your affirmative agreement, it is necessary for security purposes, or it is required by law.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">6. Data Storage and Security</h2>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>OAuth tokens are stored using AES-256 encrypted database fields and are never exposed in plaintext.</li>
                        <li>Videos are temporarily downloaded to our server during transfer and are deleted immediately after the upload to YouTube completes or fails.</li>
                        <li>We do not permanently store any of your video or photo content.</li>
                        <li>All data transmission between your browser, our servers, and Google APIs is encrypted using HTTPS/TLS.</li>
                        <li>User passwords are hashed and never stored in plaintext.</li>
                        <li>We use essential session cookies solely to keep you logged in and maintain your session state. We do not use any third-party tracking cookies, analytics cookies, or advertising cookies.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">7. Data Sharing</h2>
                    <p class="mb-3">We do not sell, trade, rent, or share your personal information with third parties, except in the following limited circumstances:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li><strong class="text-slate-900 dark:text-white">Google APIs:</strong> We transmit your data to Google's servers as necessary to perform video transfers (downloading from Google Photos, uploading to YouTube).</li>
                        <li><strong class="text-slate-900 dark:text-white">Legal Requirements:</strong> We may disclose your information if required to do so by law or in response to valid legal process.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">8. Data Retention and Deletion</h2>
                    <p class="mb-3">We retain your account data for as long as your account is active. You may disconnect your Google accounts or delete your Photos2Tube account at any time. When you do:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Your stored OAuth tokens are immediately and permanently deleted.</li>
                        <li>Your transfer history and account data are permanently removed from our database.</li>
                        <li>Any temporarily stored video files are deleted.</li>
                    </ul>
                    <p class="mt-3">When you disconnect a Google account through Photos2Tube, all associated OAuth tokens and data are deleted within 7 calendar days. When you revoke access via your Google Account settings, all associated data is deleted within 30 calendar days.</p>
                    <p class="mt-3">You can also revoke Photos2Tube's access via your <a href="https://myaccount.google.com/permissions" class="text-primary hover:underline" target="_blank" rel="noopener noreferrer">Google Account permissions page</a> or the <a href="https://security.google.com/settings/security/permissions" class="text-primary hover:underline" target="_blank" rel="noopener noreferrer">Google Security Settings page</a>.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">9. Your Rights</h2>
                    <p class="mb-3">You have the right to:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Access the personal data we hold about you.</li>
                        <li>Request correction of inaccurate data.</li>
                        <li>Request deletion of your data at any time.</li>
                        <li>Disconnect your Google accounts from your dashboard at any time.</li>
                        <li>Revoke Google OAuth access from your Google Account settings.</li>
                    </ul>
                    <p class="mt-3">To exercise any of these rights, please contact us at the email address below.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">10. Third-Party Services</h2>
                    <p class="mb-3">Photos2Tube uses YouTube API Services and the Google Photos Picker API. These third-party services have their own policies:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li><a href="https://policies.google.com/privacy" class="text-primary hover:underline" target="_blank" rel="noopener noreferrer">Google Privacy Policy</a></li>
                        <li><a href="https://www.youtube.com/t/terms" class="text-primary hover:underline" target="_blank" rel="noopener noreferrer">YouTube Terms of Service</a></li>
                        <li><a href="https://developers.google.com/youtube/terms/api-services-terms-of-service" class="text-primary hover:underline" target="_blank" rel="noopener noreferrer">YouTube API Services Terms of Service</a></li>
                        <li><a href="https://developers.google.com/terms/api-services-user-data-policy" class="text-primary hover:underline" target="_blank" rel="noopener noreferrer">Google API Services User Data Policy</a></li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">11. Children's Privacy</h2>
                    <p>Photos2Tube is not intended for use by children under the age of 13 (or the minimum age required in your jurisdiction). We do not knowingly collect personal information from children under 13. If we become aware that we have collected personal data from a child under 13, we will take steps to delete that information promptly.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">12. Changes to This Policy</h2>
                    <p>We may update this Privacy Policy from time to time. We will notify users of significant changes by updating the "Last updated" date at the top of this page. Continued use of the Service after changes constitutes acceptance of the updated policy.</p>
                </section>

                <section>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-3">13. Contact Us</h2>
                    <p>If you have questions about this Privacy Policy, your data, or wish to exercise your data rights, please contact us at <a href="mailto:phamkhien2309@gmail.com" class="text-primary hover:underline">phamkhien2309@gmail.com</a> or visit our <a href="{{ route('contact') }}" class="text-primary hover:underline">contact page</a>.</p>
                </section>
            </div>
        </div>
    </main>
@endsection
