<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoneyTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = [
            // --- BOOKING 1 (Completed Trip) ---
            [
                'booking_id'       => 1,
                'transaction_date' => '2026-05-01 09:15:00',
                'amount'           => 600.00,
                'transaction_type' => 0,
                'atm'              => true,
                'notes'            => 'تم تحصيل كامل قيمة الإيجار عبر البطاقة عند استلام السيارة',
            ],
            [
                'booking_id'       => 1,
                'transaction_date' => '2026-05-05 17:30:00',
                'amount'           => 50.00,
                'transaction_type' => 1,
                'atm'              => false,
                'notes'            => 'مصروفات غسيل وتجهيز السيارة بعد عودتها من العميل',
            ],

            // --- BOOKING 2 (Completed Trip) ---
            [
                'booking_id'       => 2,
                'transaction_date' => '2026-05-12 10:45:00',
                'amount'           => 300.00,
                'transaction_type' => 0,
                'atm'              => false, // Online payment gateway, not a physical machine
                'notes'            => 'دفع إلكتروني كامل القيمة عبر الموقع للطلب رقم #2',
            ],

            // --- BOOKING 3 (Cancelled Trip Scenario) ---
            [
                'booking_id'       => 3,
                'transaction_date' => '2026-05-19 14:00:00',
                'amount'           => 200.00,
                'transaction_type' => 0,
                'atm'              => true,
                'notes'            => 'دفعة مقدمة حجز السيارة عبر جهاز الدفع',
            ],
            [
                'booking_id'       => 3,
                'transaction_date' => '2026-05-20 11:15:00',
                'amount'           => 200.00,
                'transaction_type' => 1, // صرف
                'atm'              => false,
                'notes'            => 'رد المبلغ بالكامل للحساب البنكي بسبب إلغاء الحجز من قبل العميل',
            ],

            // --- BOOKING 5 (Active Trip Right Now) ---
            [
                'booking_id'       => 5,
                'transaction_date' => '2026-06-08 08:45:00',
                'amount'           => 750.00,
                'transaction_type' => 0,
                'atm'              => true,
                'notes'            => 'دفعة مقدمة لبداية الإيجار النشط حالياً',
            ],

            // --- BOOKING 6 (Active Trip with Maintenance Issue) ---
            [
                'booking_id'       => 6,
                'transaction_date' => '2026-06-09 11:15:00',
                'amount'           => 500.00,
                'transaction_type' => 0,
                'atm'              => false,
                'notes'            => 'استلام قيمة الإيجار نقداً',
            ],
            [
                'booking_id'       => 6,
                'transaction_date' => '2026-06-10 15:20:00',
                'amount'           => 120.00,
                'transaction_type' => 1,
                'atm'              => false,
                'notes'            => 'تعويض العميل نقداً بسبب بنشر أو عطل طارئ للإطار أثناء الرحلة',
            ],
        ];

        foreach ($transactions as $transaction) {
            \App\Models\MoneyTransaction::create($transaction);
        }
    }
}
