<?php

namespace App\Http\Controllers\Web;

use Auth;
use Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthenticationController extends Controller
{
    //重定向到第三方 OAuth 服务授权页面并获取授权码
    public function getSocialRedirect($account)
    {
        try {
            return Socialite::with($account)->redirect();
        } catch (\InvalidArgumentException $e) {
            return redirect('/');
        }
    }

    //从第三方 OAuth 回调中获取用户信息
    public function getSocialCallback($account)
    {
        $socialUser = Socialite::with($account)->user();

        //在本地 users 表中查询该用户并判断是否存在
        $user = User::where( 'provider_id', '=', $socialUser->id )
            ->where( 'provider', '=', $account )
            ->first();
        if ($user == null) {

            //如果该用户不存在则将其保存到 users 表
            $newUser = new User();

            $newUser->name        = $socialUser->getName();
            $newUser->email       = $socialUser->getEmail() == '' ? '' : $socialUser->getEmail();
            $newUser->avatar      = $socialUser->getAvatar();
            $newUser->password    = '';
            $newUser->provider    = $account;
            $newUser->provider_id = $socialUser->getId();

            $newUser->save();
            $user = $newUser;
        }

        //手动登录该用户
        Auth::login($user);

        //登录成功后将用户重定向到首页
        return redirect('/#/cafes');
    }
}
