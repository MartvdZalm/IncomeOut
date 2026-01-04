<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultCategories = [
            // Income Categories
            [
                'name'       => 'Salary',
                'type'       => 'income',
                'color'      => '#10B981',
                'is_default' => true,
                'order'      => 1,
            ],
            [
                'name'       => 'Freelance',
                'type'       => 'income',
                'color'      => '#059669',
                'is_default' => true,
                'order'      => 2,
            ],
            [
                'name'       => 'Investment',
                'type'       => 'income',
                'color'      => '#047857',
                'is_default' => true,
                'order'      => 3,
            ],
            [
                'name'       => 'Business',
                'type'       => 'income',
                'color'      => '#065F46',
                'is_default' => true,
                'order'      => 4,
            ],
            [
                'name'       => 'Gift',
                'type'       => 'income',
                'color'      => '#034E3A',
                'is_default' => true,
                'order'      => 5,
            ],
            [
                'name'       => 'Other Income',
                'type'       => 'income',
                'color'      => '#022C22',
                'is_default' => true,
                'order'      => 99,
            ],

            // Expense Categories
            [
                'name'       => 'Food & Dining',
                'type'       => 'expense',
                'color'      => '#EF4444',
                'is_default' => true,
                'order'      => 1,
            ],
            [
                'name'       => 'Shopping',
                'type'       => 'expense',
                'color'      => '#DC2626',
                'is_default' => true,
                'order'      => 2,
            ],
            [
                'name'       => 'Transportation',
                'type'       => 'expense',
                'color'      => '#B91C1C',
                'is_default' => true,
                'order'      => 3,
            ],
            [
                'name'       => 'Bills & Utilities',
                'type'       => 'expense',
                'color'      => '#991B1B',
                'is_default' => true,
                'order'      => 4,
            ],
            [
                'name'       => 'Entertainment',
                'type'       => 'expense',
                'color'      => '#7F1D1D',
                'is_default' => true,
                'order'      => 5,
            ],
            [
                'name'       => 'Healthcare',
                'type'       => 'expense',
                'color'      => '#F59E0B',
                'is_default' => true,
                'order'      => 6,
            ],
            [
                'name'       => 'Education',
                'type'       => 'expense',
                'color'      => '#D97706',
                'is_default' => true,
                'order'      => 7,
            ],
            [
                'name'       => 'Travel',
                'type'       => 'expense',
                'color'      => '#B45309',
                'is_default' => true,
                'order'      => 8,
            ],
            [
                'name'       => 'Personal Care',
                'type'       => 'expense',
                'color'      => '#92400E',
                'is_default' => true,
                'order'      => 9,
            ],
            [
                'name'       => 'Subscriptions',
                'type'       => 'expense',
                'color'      => '#78350F',
                'is_default' => true,
                'order'      => 10,
            ],
            [
                'name'       => 'Transfer',
                'type'       => 'expense',
                'color'      => '#6B7280',
                'is_default' => true,
                'order'      => 11,
            ],
            [
                'name'       => 'Other Expense',
                'type'       => 'expense',
                'color'      => '#4B5563',
                'is_default' => true,
                'order'      => 99,
            ],
        ];

        foreach ($defaultCategories as $category) {
            Category::firstOrCreate(
                [
                    'name'       => $category['name'],
                    'type'       => $category['type'],
                    'is_default' => true,
                ],
                $category
            );
        }
    }
}
