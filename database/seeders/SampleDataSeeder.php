<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\SupportTicket;
use App\Models\User;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('Adding sample orders and tickets...');

        // Get existing user (jo UserSeeder ne create kiya)
        $user = User::where('email', 'user@crm.com')->first();

        if (!$user) {
            $this->command->error('User not found! Please run UserSeeder first.');
            return;
        }

        // SIRF ORDERS CREATE KAREN (agar nahi hain toh)
        if (Order::count() === 0) {
            $orders = [
                [
                    'total_amount' => 2499,
                    'status' => 'completed',
                    'notes' => 'First order placed successfully'
                ],
                [
                    'total_amount' => 1599,
                    'status' => 'pending',
                    'notes' => 'Waiting for payment confirmation'
                ],
                [
                    'total_amount' => 3499,
                    'status' => 'completed',
                    'notes' => 'Premium package order'
                ],
                [
                    'total_amount' => 899,
                    'status' => 'completed',
                    'notes' => 'Basic service order'
                ],
                [
                    'total_amount' => 1999,
                    'status' => 'cancelled',
                    'notes' => 'Order cancelled by user'
                ]
            ];

            foreach ($orders as $orderData) {
                Order::create(array_merge($orderData, ['user_id' => $user->id]));
            }

            $this->command->info('✅ Sample orders added successfully!');
        } else {
            $this->command->info('📦 Orders already exist: ' . Order::count());
        }

        // SIRF SUPPORT TICKETS CREATE KAREN (agar nahi hain toh)
        if (SupportTicket::count() === 0) {
            $tickets = [
                [
                    'subject' => 'Payment Issue',
                    'description' => 'I am having trouble with my payment processing. The transaction is failing every time.',
                    'status' => 'open',
                    'priority' => 'high'
                ],
                [
                    'subject' => 'Product Inquiry',
                    'description' => 'I would like to know more about your premium features and pricing.',
                    'status' => 'in_progress',
                    'priority' => 'medium'
                ],
                [
                    'subject' => 'Feature Request',
                    'description' => 'Can you add dark mode theme to the dashboard interface?',
                    'status' => 'open',
                    'priority' => 'low'
                ],
                [
                    'subject' => 'Bug Report',
                    'description' => 'Mobile app crashes when uploading profile pictures from gallery.',
                    'status' => 'resolved',
                    'priority' => 'high'
                ]
            ];

            foreach ($tickets as $ticketData) {
                SupportTicket::create(array_merge($ticketData, ['user_id' => $user->id]));
            }

            $this->command->info('✅ Sample support tickets added successfully!');
        } else {
            $this->command->info('🎫 Support tickets already exist: ' . SupportTicket::count());
        }

        $this->command->info('🎉 Sample data seeding completed!');
    }
}