<?php


namespace Nrz\Payment\Repositories;


use Nrz\Payment\Models\Settlement;

class SettlementRepo
{
    private $query;

    public function __construct()
    {
        $this->query = Settlement::query();
    }

    public function store($data)
    {
        return $this->query->create([
            "to" => [
                "cart" => $data['cart'],
                "name" => $data['name']
            ],
            "amount" => $data['amount'],
            "user_id" => auth()->id()

        ]);
    }

    public function paginate()
    {
        return $this->query->paginate(15);
    }

    public function settled()
    {
        return $this->query->where("status", Settlement::STATUS_SETTLED);
    }

    public function update($settlement, $data)
    {
        return $settlement->update([
            "to" => [
                "cart" => $data['to']['cart'],
                "name" => $data['to']['name']
            ],
            "from" => [
                "cart" => $data['from']['cart'],
                "name" => $data['from']['name']
            ],
            "status"=>$data['status']
        ]);
    }

}
