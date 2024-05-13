<?php

namespace App\Http\Controllers\SettingEducation\Subject;

use Translation;
use App\Concretes\RequestHandler;

class SubjectRequestHandler extends RequestHandler
{

    public function handleCreate(): static
    {
        $this->bindCreatedBy();
        $this->handleActiveEnum();
        $this->translateSubject(null);
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->bindUpdatedBy();
        $this->handleActiveEnum();
        $this->translateSubject($model->subject);
        return $this;
    }

    public function translateSubject(?int $id): void
    {
        $this->data["subject"] = Translation::translate('subject', 'subjects', $this->data["subject"], $id);
    }
}
