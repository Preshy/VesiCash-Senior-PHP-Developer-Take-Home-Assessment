<?php

class EscrowTransactionsTest extends TestCase {
    /**
     * /escrow/transactions/create [POST]
     */
    public function testShouldCreateEscrowTransaction() {
        $parameters = [
            'sender_phone'      => '2348130184305',
            'sender_email'      => 'johndoe@gmail.com',
            'recipient_phone'   => '2347030184305',
            'recipient_email'   => 'marydoe@gmail.com',
            'title'             => 'iPhone X Purchase',
            'description'       => 'Purchase of iPhone X from John',
            'price'             => 300000
        ];

        $this->post("/escrow/transaction/create", $parameters, []);
        $this->seeStatusCode(200);
    }

    /**
     * /escrow/transactions/edit [PUT]
     */
    public function testShouldEditEscrowTransaction() {
        $parameters = [
            'id'                => 1,
            'sender_phone'      => '2348130184305',
            'sender_email'      => 'johndoe@gmail.com',
            'recipient_phone'   => '2347030184305',
            'recipient_email'   => 'marydoe@gmail.com',
            'title'             => 'iPhone XR Purchase',
            'description'       => 'Purchase of iPhone XR from John',
            'price'             => 300000
        ];

        $this->put("/escrow/transaction/edit", $parameters, []);
        $this->seeStatusCode(200);
    }

    /**
     * /escrow/transactions/delete [DELETE]
     */
    public function testShouldDeleteEscrowTransaction() {
        $parameters = [
            'id'    => 1 // Id has to exists else test will fail.
        ];

        $this->delete("/escrow/transaction/delete", $parameters, []);
        $this->seeStatusCode(200);
    }
}