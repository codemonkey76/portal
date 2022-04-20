<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Testimonial::create([
            'name' => 'Ross',
            'position' => 'Manager/Owner',
            'image_url' => 'https://images.unsplash.com/photo-1611940358470-9e9f6ded7842?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=facearea&w=256&h=256&facepad=2.5&q=80',
            'text' => '<p>I have had a contrasting experience with VoIP providers that could not be more extreme. Needless to say that when I made the decision to switch providers, I did so apprehensively, after all - once bitten, twice shy!</p>'
        ]);

        Testimonial::create([
            'name' => 'Kevin Hargraves',
            'position' => 'Underwood Wrecking',
            'image_url' => '/images/testimonials/underwood-wrecking/underwood-wrecking.jpg',
            'text' => '<p>We have been using ASG Communications for almost 2 years now for our Internet and digital phone system. Their service and product are second to none. They have saved us in the vicinity of $4000 pa and we have better coverage and service.</p>'
        ]);

        Testimonial::create([
            'name' => 'Belinda Sharpe',
            'position' => 'Stain Busters Cleaning Systems',
            'image_url' => '/images/testimonials/stain-busters/StainBusters.png',
            'text' => '<p>A big thank you to John and Len at Alpha Communications for the seamless implementation of our new phone system. Nothing has been too difficult, including dealing with the frustrating process of porting our numbers away from Telstra. All the effort you have gone to has been greatly appreciated. Very professional, 5-star service!.</p>'
        ]);

        Testimonial::create([
            'name' => 'Renee Henville',
            'position' => 'Integrated Human Resourcing',
            'image_url' => '/images/testimonials/integrated-hr/integrated-hr.jpg',
            'text' => '<p>I can\'t recommend Alpha Solutions Group more highly. John, Len and the team have been amazing in providing my firm, Integrated Human Resourcing, with internet and voip phone connections. They provided advice on the best solution to the business, seamlessly implemented and are available for ongoing support when needed. They also advise if there are more cost effective options available and as a result have saved the firm hundreds of dollars per year.</p>'
        ]);
    }
}
