<?php

namespace Nrz\Payment\Gateways\Zarinpal;

use Illuminate\Http\Request;
use Nrz\Payment\Contracts\GatewayContract;
use Nrz\Payment\Models\Payment;

class ZarinpalAdaptor implements GatewayContract
{

    private $url;
    private $zp;

    public function request($amount, $title)
    {
        $this->zp = new zarinpal();
        $callbackUrl = route('payments.callback');
        $result = $this->zp->request("xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx", $amount, $title, "", "", $callbackUrl, true);
        if (isset($result["Status"]) && $result["Status"] == 100) {
            $this->url = $result["StartPay"];
            return $result["Authority"];
        } else {
            return [
                "status" => $result["Status"],
                "message" => $result["Message"]
            ];
        }
    }

    public function verify(Payment $payment)
    {
        $this->zp = new zarinpal();
        $result = $this->zp->verify("xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx", $payment->amount, true);
        if (isset($result["Status"]) && $result["Status"] == 100) {
            return $result["RefID"];
        } else {
            return [
                "status" => $result["Status"],
                "message" => $result["Message"]
            ];
        }
    }

    public function redirect()
    {
        $this->zp->redirect($this->url);
    }

    public function getName()
    {
        return "Zarinpal";
    }

    public function getInvoiceId(Request $request)
    {
        return $request->Authority;
    }
}
