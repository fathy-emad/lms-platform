<?php

namespace App\Http\Controllers\Setting\EduSubject;

use Translation;
use App\Concretes\RequestHandler;

class EduSubjectRequestHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->translateSubject(null);
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->translateSubject($model->subject);
        return $this;
    }

    public function translateSubject(?int $id): void
    {
        $this->data["subject"] = Translation::translate('subject', 'edu_subjects', $this->data["subject"], $id);
    }
}
