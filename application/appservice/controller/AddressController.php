<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/25
 * Time: 上午11:08
 */

namespace app\appService\controller;

use app\appService\model\Address;
use think\Controller;
use think\Request;

class AddressController extends Controller
{
    /*
     * user_id
     * */
    public function add(Request $request) {
        $address = new Address($request->param());
        $result = $address->allowField(true)->save();
        if ($result) {
            return json_encode([
                'code' => 1,
                'message' => '添加成功'
            ]);
        }else {
            return json_encode([
                'code' => 0,
                'message' => '添加失败'
            ]);
        }
    }

    /*
     *user_id/address_id
     * */
    public function delete(Request $request) {
        $address = Address::get(['id' => $request->param('address_id'),
        'user_id'=>'user_id']);
        if ($address->delete()) {
            return json_encode([
                'code' => 1,
                'message' => '删除成功'
            ]);
        }else {
            return json_encode([
                'code' => 0,
                'message' => '删除失败'
            ]);
        }
    }

    /*
     *user_id/address_id
     * */
    public function update(Request $request) {
        $address = Address::get(['id' => $request->param('address_id')]);
        $result = $address->allowField(true)->isUpdate(true)->save($request->param());
        if ($result) {
            return json_encode([
                'code' => 1,
                'message' => '更新成功'
            ]);
        }else {
            return json_encode([
                'code' => 0,
                'message' => '更新失败'
            ]);
        }
    }
}