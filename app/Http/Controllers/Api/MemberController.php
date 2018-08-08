<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Mrgoon\AliSms\AliSms;

class MemberController extends BaseController
{
    /**
     * 短信验证
     * @param Request $request
     * @return array
     */
    public function sms(Request $request)
    {
        $tel = $request->input('tel');
        //设置一个4位随机验证码
        $code = rand(1000, 9999);
        /*//存短信验证码
        Redis::set('tel_' . $tel, $code);
        //设置过期时间
        Redis::expire('tel_' . $tel, 300);*/
        //存短信验证码,设置过期时间
        cache(['tel_' . $tel => $code], 300);
        return [
            "status" => "true",
            "message" => "获取短信验证码成功" . $code
        ];
        //配置
        $config = [
            'access_key' => env('ALIYUN_SMS_AK'),
            'access_secret' => env('ALIYUN_SMS_AS'),
            'sign_name' => env('ALIYUN_SMS_SIGN_NAME'),
        ];
        $aliSms = new AliSms();
        $response = $aliSms->sendSms($tel, 'SMS_140670105', ['code' => $code], $config);
        if ($response->Message === 'ok') {
            return [
                "status" => "true",
                "message" => "获取短信验证码成功" . $code
            ];
        } else {
            return [
                "status" => "false",
                "message" => $response->Message
            ];
        }
    }

    /**
     * 用户注册
     * @param Request $request
     * @return array
     */
    public function reg(Request $request)
    {
        //接收参数
        $data = $request->all();
        //验证
        $validate = Validator::make($data, [
            'username' => 'required',
            'sms' => 'required|integer|min:1000|max:9999',
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/'
            ],
            'password' => 'required|min:6'
        ]);
        //验证是否有错
        if ($validate->fails()) {
            //返回错误信息
            return [
                'status' => 'false',
                'message' => $validate->errors()->first()
            ];
        }
        //取出验证码
        $code = cache('tel_' . $data['tel']);
        //判断验证码是否一致
        if ($code != $data['sms']) {
            return [
                'status' => 'false',
                'message' => '验证码错误'
            ];
        }
        //密码加密
        $data['password'] = bcrypt($data['password']);
        //插入数据
        Member::create($data);
        //返回数据
        return [
            'status' => 'true',
            'message' => '用户注册成功'
        ];
    }

    /**
     * 用户登录
     * @param Request $request
     * @return array
     */
    public function login(Request $request)
    {
        $member = Member::where('username', $request->post('name'))->first();
        //dd($member);
        //登录成功
        if ($member && Hash::check($request->post('password'), $member->password)) {
            return [
                'status' => 'true',
                'message' => '用户登录成功',
                'user_id' => $member->id,
                'username' => $member->username
            ];
        }
        return [
            'status' => 'false',
            'message' => '账号或密码错误'
        ];
    }

    /**
     * 重置密码
     * @param Request $request
     * @return array
     */
    public function forget(Request $request)
    {
        $data = $request->all();
        //验证
        $validate = Validator::make($data, [
            'sms' => 'required|integer|min:1000|max:9999',
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/'
            ]
        ]);
        //验证是否有错
        if ($validate->fails()) {
            //返回错误信息
            return [
                'status' => 'false',
                'message' => $validate->errors()->first()
            ];
        }
        //取出验证码
        $code = cache('tel_' . $data['tel']);
        //判断验证码是否一致
        if ($code != $data['sms']) {
            return [
                'status' => 'false',
                'message' => '验证码错误'
            ];
        }
        //通过手机找到用户
        $member = Member::where('tel', $data['tel'])->first();
        if ($member) {
            //密码加密
            $data['password'] = bcrypt($request->post('password'));
            $member->password = $data['password'];
            $member->save();
            return [
                'status' => 'true',
                'message' => '用户重置密码成功'
            ];
        }
    }

    /**
     * 修改密码
     * @param Request $request
     * @return array
     */
    public function change(Request $request)
    {
        $data = $request->post();
        //通过id得到对象
        $member = Member::findOrFail($data['id']);
        //判断旧密码与数据库的密码是否一致
        if (Hash::check($request->post('oldPassword'), $member->password)) {
            $member->password = bcrypt($data['newPassword']);
            $member->save();
            return [
                "status" => "true",
                "message" => "用户密码修改成功"
            ];
        }
    }

    /**
     * 查出当前用户的信息
     * @param Request $request
     * @return mixed
     */
    public function detail(Request $request)
    {
        return Member::find($request->input('user_id'));
    }
}
