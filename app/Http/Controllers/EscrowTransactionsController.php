<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, DB};
use App\EscrowTransactions;

class EscrowTransactionsController extends Controller
{
    public function all() {
        return app('db')->select("SELECT * FROM escrow_transactions");
    }
    /*
     * Create a new escrow transaction
     * Function will validate form fields, and add a new collection to the database.
     * @return object
     */
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
           'sender_email'               =>      ['required', 'email'],
           'sender_phone'               =>      ['required', 'numeric'],

           'recipient_email'            =>      ['required', 'email'],
           'recipient_phone'            =>      ['required', 'numeric'],
           'title'                      =>      ['required', 'string'],
           'description'                =>      ['required', 'string'],
           'price'                      =>      ['required', 'numeric']
        ]);
        // Check if validator has errors
        if ( $validator->fails() ) {
            // return response with the erorrs and a status code
            return \response()->json([ 'message' => ['errors' => [$validator->errors()]]])->setStatusCode(400);
        } else {
            // prepare data for insert
            $escrow_transaction_data = [
                'sender_email'       => $request->sender_email,
                'sender_phone'       => $request->sender_phone,
                'recipient_email'    => $request->recipient_email,
                'recipient_phone'    => $request->recipient_phone,
                'payload'            => json_encode([
                    'title' => $request->title,
                    'description' => $request->description,
                    'price' => $request->price
                ]),
            ];

            DB::table('escrow_transactions')->insert($escrow_transaction_data);
            return \response()->json( ['message' => ['success' => true, 'data' => $escrow_transaction_data]])->setStatusCode(200);
        }
    }

    /*
     * Edit an escrow transaction
     * Function will check if transaction exists, validate the form fields then update the database collections.
     * @return object
     */
    public function edit(Request $request) {
        $validator = Validator::make($request->all(), [
            'id'                         =>      ['required', 'exists:escrow_transactions'],
            'sender_email'               =>      ['required', 'email'],
            'sender_phone'               =>      ['required', 'numeric'],

            'recipient_email'            =>      ['required', 'email'],
            'recipient_phone'            =>      ['required', 'numeric'],
            'title'                      =>      ['required', 'string'],
            'description'                =>      ['required', 'string'],
            'price'                      =>      ['required', 'numeric']
        ]);
        // Check if validator has errors
        if ( $validator->fails() ) {
            // return response with the erorrs and a status code
            return \response()->json([ 'message' => ['errors' => [$validator->errors()]]])->setStatusCode(400);
        } else {
            // prepare data for insert
            $escrow_transaction_data = [
                'sender_email'       => $request->sender_email,
                'sender_phone'       => $request->sender_phone,
                'recipient_email'    => $request->recipient_email,
                'recipient_phone'    => $request->recipient_phone,
                'payload'            => json_encode([
                    'title' => $request->title,
                    'description' => $request->description,
                    'price' => $request->price
                ]),
            ];

            EscrowTransactions::find($request->id)->update($escrow_transaction_data);
            return \response()->json( ['message' => ['success' => true, 'data' => $escrow_transaction_data]])->setStatusCode(200);
        }
    }

    /*
     * Delete transaction
     * Function will delete a transaction from the database collection
     * @return boolean
     */
    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id'                         =>      ['required', 'exists:escrow_transactions'],
        ]);
        // Check if validator has errors
        if ( $validator->fails() ) {
            // return response with the erorrs and a status code
            return \response()->json([ 'message' => ['errors' => [$validator->errors()]]])->setStatusCode(400);
        } else {
            DB::table('escrow_transactions')->where('id', $request->id)->delete();
            return \response()->json( ['message' => ['success' => true]])->setStatusCode(200);
        }
    }
}
