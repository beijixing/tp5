<?php
/**
 * Created by PhpStorm.
 * User: zgl
 * Date: 2017/6/6
 * Time: 下午10:39
 */

namespace app\admin\controller;

use \think\Controller;

class ConfigureController extends Controller
{
    public function getUserNotes() {
        return $this->fetch('configure/userNotes');
    }


    public function getDistributedInstructions ()
    {
        return $this->fetch('configure/distributedInstructions');
    }

    public function getPaymentDescription() {

        return $this->fetch('configure/paymentDescription');
    }

    public function getAfterSaleService() {

        return $this->fetch('configure/afterSaleService');
    }

    public function getAboutUs() {
        return $this->fetch('configure/aboutUs');
    }
}