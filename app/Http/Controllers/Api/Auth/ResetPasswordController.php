<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\ResetPasswordController as Reset;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Support\Facades\Password;
use App\Models\Auth\User;

class ResetPasswordController extends Reset
{
    use RedirectsUsers;
    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
            'token.required' => 'El :attribute es un campo requerido',
            'email.required' => 'El :attribute es un campo requerido',
            'email.email' => 'El :attribute debe ser un email valido',
            'password.required' => 'El :attribute es un campo requerido',
            'password.required' => 'El :attribute es un campo requerido'
        ];
    }
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8'
        ];
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $result = \DB::select("SELECT token FROM password_resets where email = ?;",[$request->email]);
        if (count($result)) {
            $token = $result[0]->token;
            $result = password_verify($request->token, $token);
            //buscar password
            if ($result) {
                $password = User::where('email',$request->email)->first('password');
                $samePassword = password_verify($request->password, $password->password);
                if ($samePassword) {
                    return $this->sendResetFailedResponse($request, trans('passwords.old'));
                }
                
            }
        }

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == Password::PASSWORD_RESET
                    ? $this->sendResetResponse($request, $response)
                    : $this->sendResetFailedResponse($request, $response);
    }
    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json(['message' => trans($response)]);
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['message' => trans($response)], 422);
    }


}
