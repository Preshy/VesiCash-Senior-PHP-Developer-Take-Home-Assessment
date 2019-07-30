<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class EscrowTransactions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $parameters = [
            'sender_phone'      => '2348130184305',
            'sender_email'      => 'johndoe@gmail.com',
            'recipient_phone'   => '2347030184305',
            'recipient_email'   => 'marydoe@gmail.com',
            'title'             => 'iPhone X Purchase',
            'description'       => 'Purchase of iPhone X from John',
            'price'             => 300000
        ];

        DB::table('escrow_transactions')->insert($data);
    }
}
