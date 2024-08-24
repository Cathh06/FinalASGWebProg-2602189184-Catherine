<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|max:255|min:3|unique:users',
            'password' => 'required|min:8|max:255',
            'gender' => 'required',
            'hobby' => 'required|array|min:3',
            'username_ig' => 'required',
            'phonenumber' => 'required',
            'profile' => 'required|mimes:jpg,png,jpeg,gif|max:2046'
        ]);

        $hobbies = implode(',', (array) $request->input('hobby'));

        $profile = $request->file('profile');
        $namaprofile = time() . "." . $profile->getClientOriginalExtension();
        $pathfileLampiran = Storage::disk('public')->putFileAs('fileLampiran', $profile, $namaprofile);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'gender' => $validatedData['gender'],
            'username_ig' => $validatedData['username_ig'],
            'hobby' => $hobbies,
            'phonenumber' => $validatedData['phonenumber'],
            'register_price' => rand(100000, 125000),
            'profile' => $pathfileLampiran
        ]);

        $price = $user->register_price;
        $user_id = $user->id;

        return redirect()->route('payment', ['price' => $price, 'user_id' => $user_id]);
    }

    public function showpayment(Request $request)
    {
        $price = $request->query('price');
        $user_id = $request->query('user_id');

        // dd($user_id);

        return view('payment', compact('price', 'user_id'));
    }

    public function payment(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'price' => 'required|numeric',
            'user_id' => 'required|exists:users,id'
        ]);

        $user = User::findOrFail($validatedData['user_id']);
        $user_id = $validatedData['user_id'];
        $payment_amount = $validatedData['amount'];
        $price = $validatedData['price'];
        $diff = $payment_amount - $price;

        // dd($user);
        if ($payment_amount < $price) {
            return redirect()->back()->with('error', "You are still underpaid " . number_format(-$diff));
        } else if ($payment_amount > $price) {
            return redirect()->back()->with([
                'overpaid' => true,
                'overpaidAmount' => number_format($diff),
                'price' => $price,
                'user_id' => $user_id,
            ]);
        } else {
            $user->has_paid = true;
            $user->save();
            return redirect()->route('login')->with('success', 'Payment successful!');
        }
    }

    public function storebalance(Request $request)
    {
        $validatedData = $request->validate([
            'overpaidAmount' => 'required|numeric',
            'user_id' => 'required|exists:users,id'
        ]);

        $overpaidAmount = $validatedData['overpaidAmount'];
        $user = User::findOrFail($validatedData['user_id']);

        // Update user's coin balance
        $user->coins += $overpaidAmount;
        $user->save();

        return redirect()->route('user.index')->with('success', 'Overpaid amount has been added to your wallet balance.');
    }

}
