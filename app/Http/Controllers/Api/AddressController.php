<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddressController extends BaseController
{
    /**
     * 地址列表
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        //得到当前用户的id
        $memberId = $request->input('user_id');
        //得到当前用户的所有地址
        $addresses = Address::where('user_id', $memberId)->get();
        //dd($addresses);
        //返回数据
        return $addresses;
    }

    /**
     * 添加地址
     * @param Request $request
     * @return array
     */
    public function add(Request $request)
    {
        $data = $request->all();
        //验证
        $validate = Validator::make($data, [
            'name' => 'required',
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
        /*//判断
        if ($request->post('is_default')) {
            //把表里所的is_default设置0
            Address::where("is_default", 1)->where('user_id', $data['user_id'])->update(['is_default' => 0]);
        }*/
        //插入数据
        Address::create($data);
        //返回数据
        return [
            'status' => 'true',
            'message' => '地址添加成功'
        ];
    }

    /**
     * 编辑回显
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request)
    {
        //得到当前地址的id
        $addressId = $request->input('id');
        //得到当前地址信息
        $address = Address::where('id', $addressId)->first();
        //返回数据
        return $address;
    }

    /**
     * 修改地址
     * @param Request $request
     * @return array
     */
    public function update(Request $request)
    {
        $data = $request->all();
        //验证
        $validate = Validator::make($data, [
            'name' => 'required',
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
        //得到当前地址信息
        $address = Address::where('id', $data['id'])->first();
        //更新数据
        $address->update($data);
        //返回数据
        return [
            'status' => 'true',
            'message' => '地址修改成功'
        ];
    }
}
