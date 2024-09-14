<?php

namespace App\Http\Controllers\Setting\FAQ;


use App\Concretes\RequestHandler;
use Translation;

class FAQRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->translateQuestion(null);
        $this->translateAnswer(null);
        $this->handleActiveEnum();
        $this->bindCreatedBy();
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->translateQuestion($model->question);
        $this->translateAnswer($model->answer);
        $this->handleActiveEnum();
        $this->bindUpdatedBy();
        return $this;
    }

    public function translateQuestion(?int $id): void
    {
        $this->data["question"] = Translation::translate('question', 'faqs', $this->data["question"], $id);
    }
    public function translateAnswer(?int $id): void
    {
        $this->data["answer"] = Translation::translate('answer', 'faqs', $this->data["answer"], $id);
    }

}
