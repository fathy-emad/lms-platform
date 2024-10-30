<?php

namespace App\Http\Controllers\Setting\ReturnRefundPolicy;


use App\Concretes\RequestHandler;
use Translation;

class ReturnRefundPolicyRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->translateHeader(null);
        $this->translateBody(null);
        $this->handleActiveEnum();
        $this->bindCreatedBy();
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->translateHeader($model->header);
        $this->translateBody($model->body);
        $this->handleActiveEnum();
        $this->bindUpdatedBy();
        return $this;
    }

    public function translateHeader(?int $id): void
    {
        $this->data["header"] = Translation::translate('header', 'return_refund_policies', $this->data["header"], $id);
    }
    public function translateBody(?int $id): void
    {
        $this->data["body"] = Translation::translate('body', 'return_refund_policies', $this->data["body"], $id);
    }

}
