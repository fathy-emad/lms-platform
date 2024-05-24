<?php

namespace App\Http\Controllers\SettingEducation\EduSubject;

use App\Concretes\RequestHandler;
use Translation;

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
