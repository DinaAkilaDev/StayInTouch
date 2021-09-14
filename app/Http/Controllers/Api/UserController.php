<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResources;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login()
    {
        $proxy = Request::create('oauth/token', 'POST');
        $response = Route::dispatch($proxy);
        $statusCode = $response->getStatusCode();
        $response = json_decode($response->getContent());

        if ($statusCode != 200) {
            $data = [
                'status' => false,
                'statusCode' => $statusCode,
                'message' => $response->message,
                'items' => $response,

            ];
            return response()->json($data);

        }
        $user = User::where('email', \request()->get('username'))->first();
        $data = [
            'status' => true,
            'statusCode' => $statusCode,
            'message' => 'Successfully Login!',
            'items' => [
                'token' => $response,
                'user' => $user,
            ],

        ];
        return response()->json($data);
    }

    public function signup(Request $request)
    {
        $valid = validator($request->only('email', 'name', 'password','photo','phone'), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'photo' => 'required',
            'phone' => 'required|max:10',
        ]);

        if ($valid->fails()) {

            $errors = [];
            $items = [];
            $temp = 0;
            $message = 'Validation Error';
            foreach ($valid->errors()->getMessages() as $key => $error) {
                $errors['fieldname'] = $key;
                $errors['message'] = $error[0];

                $items[] = $errors;

                if ($temp++ == 0) {
                    $message = $error[0];
                }
            }
            $data = [
                'status' => false,
                'statusCode' => 422,
                'message' => $message,
                'items' => $items,

            ];

            return response()->json($data);
        }

        $data = request()->only('email', 'name', 'password','photo','phone');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'photo' => $data['photo'],
            'phone' => $data['phone'],
        ]);

        $request->request->add(['username' => $data['email']]);
        return $this->login();
    }



    public function forgotPassword(Request $request)
    {
        $input = $request->only('email');
        $validator = Validator::make($input, [
            'email' => "required|email"
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $response = Password::sendResetLink($input);
        $message = $response == Password::RESET_LINK_SENT ? 'Mail send successfully' : 'SOMETHING_WRONG';
        if ($message== 'SOMETHING_WRONG'){
            $data = [
                'status' => false,
                'statusCode' => 400,
                'message' => $message,
                'items' => '',

            ];
        }
        if ($message== 'Mail send successfully'){
            $data = [
                'status' => true,
                'statusCode' => 200,
                'message' => $message,
                'items' => '',

            ];
        }
        return response()->json($data);
    }

    public function edit(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->photo=$request->input('photo');
        $user->phone=$request->input('phone');
        $user->save();
        $data = [
            'status' => true,
            'statusCode' => 200,
            'message' => 'Success',
            'items' =>new  UserResources($user),

        ];
        return response()->json($data);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        $data = [
            'status' => true,
            'statusCode' => 200,
            'message' => 'Successfully logged out',
            'items' => '',
        ];
        return response()->json($data);
    }
}
