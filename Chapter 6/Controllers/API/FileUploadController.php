<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Http\Controllers\Controller;

class FileUploadController extends Controller
{
    // function to store file in 'upload' folder
    public function fileStore(Request $request)
    {
        // $upload_path = public_path('upload');
        // $file_name = $request->file->getClientOriginalName();
        // $generated_new_name = time() . '.' . $request->file->getClientOriginalExtension();
        // $request->file->move($upload_path, $generated_new_name);

        $data['transaction_proof'] = $request->file('file')->store(
            'assets/product', 'public'
        );

        $file_name = $request->file->getClientOriginalName();

        $check = Transaction::where('id', $request->input('transaction_id'))->update([
            'transaction_proof' => $data['transaction_proof']
        ]);
        return response()->json(['success' => 'You have successfully uploaded "' . $file_name . '"']);
    }
}
