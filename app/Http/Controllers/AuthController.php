<?php

namespace App\Http\Controllers;

use App\Http\Requests\Front\Auth\LoginRequest;
use App\Http\Requests\Front\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the login page
     *
     * @return RedirectResponse | View
     */
    public function index(): RedirectResponse | View
    {
        if (Auth::check()) {
            return redirect()->route('front.homepage');
        }

        $data = [
            '__title' => 'Giriş Yap',
            '__breadcrumbs' => [
                ['title' => 'Ana Sayfa', 'url' => route('front.homepage')],
                ['title' => 'Giriş Yap']
            ],
        ];
        return view('front.pages.auth.login', $data);
    }

    /**
     * Login the user
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $request->session()->regenerate();

            return redirect()->route('front.homepage');
        } catch (\Exception $ex) {
            return redirect()->back()->withInput()->withErrors(['email' => 'Giriş yaparken bir hata oluştu. Lütfen tekrar deneyin.']);
        }
    }

    /**
     * Show the register page
     *
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'birthday' => $request->input('birthday'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
            Auth::login($user);
            return redirect()->route('front.homepage');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['email' => 'Kayıt olurken bir hata oluştu. Lütfen tekrar deneyin.']);
        }
    }

    /**
     * Logout the user
     *
     * @return RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('front.homepage');
    }
}
