<?php

namespace App\Http\Controllers\Setting\TermsCondition;


use App\Concretes\RequestHandler;
use Translation;

class TermsConditionRequestHandler extends RequestHandler
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
        $this->data["header"] = Translation::translate('header', 'terms_conditions', $this->data["header"], $id);
    }
    public function translateBody(?int $id): void
    {
        $this->data["body"] = Translation::translate('body', 'terms_conditions', $this->data["body"], $id);
    }

}
