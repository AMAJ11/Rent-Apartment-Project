<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\TemporaryUser;
use App\Models\User;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    
    function register(StoreUserRequest $request) {
        $validatedData = $request->validated();
        $phone = User::where('phone',$request->phone)->first();
        if ($phone) {
            return response()->json(['message'=>'the phone is already exist'],200);
        }
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image')->store('users/profiles','public');
            $validatedData['profile_image'] = $image;
        }

        if ($request->hasFile('id_image')) {
            $image = $request->file('id_image')->store('users/identities','public');
            $validatedData['id_image'] = $image;
        }

        $validatedData['password'] =Hash::make($request->password);
        $user = TemporaryUser::create($validatedData);
        return response()->json(['message'=>'User Registered Successfully, We will contact you soon', $user], 201);
    }

   // ترجع بيانات فقط (Collection)
public function temporaryIndex() {
    return TemporaryUser::all();
}


function acceptUser(Request $request, int $id) {
    $user = TemporaryUser::findOrFail($id);

    // التحقق مما إذا كان الزر المضغوط هو زر القبول (value="1")
    if ($request->input('isAccept') == "1") {
        User::create($user->toArray());
        $user->delete();
        
        // بعد النجاح، نعود للصفحة السابقة مع رسالة نجاح
        return back()->with('success', 'User has been accepted');
    } 
    else {
        // إذا كان زر الرفض (value="0")
        $user->delete();
        return back()->with('info', 'User rejected');
    }

}


    function login(Request $request) {
        $request->validate([
            'phone'=>'required|digits:8|string',
            'password'=>'required|string|min:8',
        ]);
        $phone = TemporaryUser::where('phone',$request->phone)->first();
        if ($phone) {
            return response()->json(['message'=>'the admin hasn\'t accepted you yet, please try again later'],404);
        }
        if (!Auth::attempt($request->only('phone','password'))) {
            return response()->json(['message'=>'Unauthurized'],401);
        }
        $user = User::where('phone',$request->phone)->first();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['message'=>'User Login Successfully','user'=>$user,'token'=> $token],200);
    }
//    public function loginAdmin(Request $request) {
//         $credentials = $request->only('phone', 'password');
//  if (!Auth::attempt($request->only('phone','password'))) {
//             return response()->json(['message'=>'Unauthurized'],401);
//         }
// $request->session()->regenerate();
//         return redirect()->intended('/admin');
        
//     }
public function loginAdmin(Request $request) {
    $user = \App\Models\User::where('phone', $request->phone)->first();

    if (!$user) {
        return response()->json(['message' => $request->phone], 401);
    }

    if (!\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'password error'], 401);
    }

    Auth::login($user); 
    $request->session()->regenerate();
    return redirect()->intended('/admin');
}
    
    function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message'=>'User Logout Successfully'], 200);
    }

    function index() {
        $users = User::all();
        return response()->json(['users'=>$users],200);
    }

    function destroy(int $id) {
        $user = User::findOrFail($id);
        $user->delete();
        
        return back()->with('success', 'تم حذف المستخدم بنجاح');
    }

    function destroyappartment(int $id) {
         $Apartment = Apartment::findOrFail($id);
         $Apartment->delete();
        return back()->with('success', 'تم حذف الشقة بنجاح');
    }

    function addBalance(int $id, Request $request) {
        $user = User::findOrFail($id);
        $user->balance += $request->amount;
        $user->save();
        return back()->with('success', 'تمت زيادة الرصيد بنجاح');
    }

    function show(int $id) {
        $user = User::findOrFail($id);
        return response()->json(['user'=>$user],200);
    }

}
