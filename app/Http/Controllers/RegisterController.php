<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'Fname' => 'string|max:255',
            'Lname' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'business_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'business_type' => 'string|max:255',
            'business_email' => 'required|string|email|max:255|unique:users',
            'country' => 'required|string|max:255',
            'business_identification' => 'required|string|max:255|unique:users',
            'address' => 'required|string|max:255',
        ]);
    }

    public function register(Request $request)
    {
        // Validation
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the user
        $user = User::create([
            'Fname' => $request->input('Fname'),
            'Lname' => $request->input('Lname'),
            'business_name' => $request->input('business_name'),
            'business_logo' => $request->file('business_logo')->store('logos', 'public'),
            'business_type' => $request->input('business_type'),
            'business_email' => $request->input('business_email'),
            'country' => $request->input('country'),
            'business_identification' => $request->input('business_identification'),
            'address' => $request->input('address'),
        ]);
        // $user-save();

        return response()->json("success");
        // return redirect('/'); // Redirect to the desired page after successful registration
    }


    public function register1(Request $request)
{
    // Validate the request data
    $credentials = $request->validate([
        'Fname' => 'required|string|max:255',
        'Lname' => 'required|string|max:255',
    ]);

    // Create a new User instance and set the 'Fname' and 'Lname' attributes
    $user = new User();
    $user->Fname = $credentials['Fname'];
    $user->Lname = $credentials['Lname'];

    // Save the user to the database
    $user->save();

    // Return a success response
    return response()->json("success");
}

}
