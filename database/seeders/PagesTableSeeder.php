<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\User;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::find(1);

        Page::truncate();

        
        $about = new Page([
            'title' => 'About',
            'url' => '/about',
            'content' => 'This is about us.'
        ]);

        $contact = new Page([
            'title' => 'Contact',
            'url' => '/contact',
            'content' => 'This is contact us.'
        ]);

        $faq = new Page([
            'title' => 'FAQ',
            'url' => '/another-page',
            'content' => 'This is another us.'
        ]);
        
        $admin->pages()->saveMany([
            $about,
            $contact,
            $faq
        ]);

        $about->appendNode($faq);
    }
}
