<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::create([
            'title' => 'Do you support multiple registrations?',
            'answer' => '<p>ASG Communications requires that each device (Desk phone, Cordless phone, Softphone) be registered as a separate extension on our system. If muliple devices register with the same extension number there will be issues with incoming calls not knowing which device to send the call to.</p>'
        ]);

        Question::create([
            'title' => 'Emergency Calls (000)',
            'answer' => '<p>000 - Connects directly to emergency services. You are advised to call 000 from a traditional landline or mobile and not your VOIP phone. Due to the nature of the internet, there are many outside factors that can cause calls to go wrong or not connect at all. For this reason, you are strongly advised to dial emergency numbers from your mobile or landline phone.</p>'
        ]);

        Question::create([
            'title' => 'Forgotten password',
            'answer' => '<p>Simply click on "Forgot your password?" on the login screen, you will be asked for your email address that was used during registration, and we will send you a password reset link. If you are still having issues, Contact us.</p>'
        ]);

        Question::create([
            'title' => 'How do i setup my phone?',
            'answer' => '<p>If you purchase deskphones or cordless phones from us, we will set them up for you. If however you are using a softphone app, please refere to our instructions page.</p>'
        ]);

        Question::create([
            'title' => 'How quickly can i get up and running?',
            'answer' => '<p>In some instances you can be up and running within a couple of hours with one of our temporary numbers. If you want to bring your existing phone number to ASG Communications, it may take a few days, to a few weeks as it depends on the other carrier.</p>'
        ]);

        Question::create([
            'title' => 'How reliable is VoIP?',
            'answer' => '<p>The reliability of your VoIP service is highly dependent on your internet connection. If your internet connection is experiencing issues, then your call quality will suffer.</p><p class="mt-2">ASG Communications at times may need to perform maintenance on our systems which can occasionally result in some downtime. All customers will be notified prior to these periods with expected downtime given.</p>'
        ]);

        Question::create([
            'title' => 'What happens if my internet connection drops out?',
            'answer' => '<p>Your deskphone requires an internet connection to function. In the event that it drops out, there are a number of ways to keep your calls flowing?</p><p>Redundant internet connection. We recommend having a redundant internet connection when possible. E.g. if your NBN connection goes down, you could use a 4G backup connection.</p><p class="mt-2">Configuring your calls to divert to mobile if offline, or divert to voicemail.</p>'
        ]);
    }
}
