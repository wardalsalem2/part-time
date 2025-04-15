<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            ['name' => 'Ahmad Alhussein', 'email' => 'ahmad@example.com', 'subject' => 'Job Inquiry', 'message' => 'Hello, I am interested in the Web Developer position. Could you provide more details about the job requirements and responsibilities?'],
            ['name' => 'Sara AlZoubi', 'email' => 'sara@example.com', 'subject' => 'Product Feedback', 'message' => 'I recently purchased a product from your store, and I wanted to share my feedback. The quality was great, but the delivery took longer than expected.'],
            ['name' => 'Rami AlOmar', 'email' => 'rami@example.com', 'subject' => 'Service Issue', 'message' => 'I am facing an issue with the mobile app login. Could you assist me in fixing it?'],
            ['name' => 'Muna AlShammari', 'email' => 'muna@example.com', 'subject' => 'Event Registration', 'message' => 'I would like to register for the upcoming event. Can you please send me the registration details and process?'],
            ['name' => 'Jad AlJadid', 'email' => 'jad@example.com', 'subject' => 'Collaboration Opportunity', 'message' => 'I am looking for potential collaboration opportunities with your company. Would you be interested in discussing this further?'],
            ['name' => 'Huda Kassem', 'email' => 'huda@example.com', 'subject' => 'Invoice Request', 'message' => 'Can you please send me the invoice for my recent purchase? I need it for my records.'],
            ['name' => 'Khaled Abed', 'email' => 'khaled@example.com', 'subject' => 'Support Request', 'message' => 'I am having trouble with my account. Please assist me in resetting my password or recovering my account.'],
            ['name' => 'Nour AlBashir', 'email' => 'nour@example.com', 'subject' => 'Product Inquiry', 'message' => 'I am interested in buying a new laptop from your store. Can you recommend the best models within my budget of $1000?'],
            ['name' => 'Ali ElTayeb', 'email' => 'ali@example.com', 'subject' => 'Delivery Issue', 'message' => 'My order arrived damaged, and I would like to request a replacement or refund. Please assist me with this issue.'],
            ['name' => 'Lama Issa', 'email' => 'lama@example.com', 'subject' => 'Website Feedback', 'message' => 'I visited your website, and I think the design could be improved for better navigation. I suggest adding a search feature and clearer product categories.'],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
