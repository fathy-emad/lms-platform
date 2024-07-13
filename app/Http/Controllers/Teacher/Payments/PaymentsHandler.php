<?php

namespace App\Http\Controllers\Teacher\Payments;

use ApiResponse;
use App\Models\TeacherPayment;
use App\Concretes\RequestHandler;
use App\Enums\TeacherPaymentStatusEnum;
use Illuminate\Http\Exceptions\HttpResponseException;

class PaymentsHandler extends RequestHandler
{
    public function handleCreate(): static
    {
        $this->getPaymentData();
        $this->changePaymentTeacherStatus();
        return $this;
    }

    public function handleUpdate($model): static
    {
        $this->changePaymentTeacherStatus($model);
        return $this;
    }

    public function getPaymentData(): void
    {
        $model = TeacherPayment::where(["teacher_id" => $this->data["teacher_id"], "TeacherPaymentStatusEnum" => 'pending'])->get();
        $this->data["totalAmount"] = $model->sum("cost");
        $this->data["countItems"] = $model->count();
    }

    public function changePaymentTeacherStatus($model = null): void
    {

        if (!$model)
        {
            $status = TeacherPaymentStatusEnum::INReview->value;
            $searchStatus = TeacherPaymentStatusEnum::Pending->value;
            $teacher_id = $this->data["teacher_id"];
        }

        else
        {
            $teacher_id = $model->teacher_id;
            $searchStatus = $model->TeacherPaymentStatusEnum->value;
            $indexOfEnum = array_search($searchStatus, TeacherPaymentStatusEnum::values()) + 1;

            if ($indexOfEnum == 4)
                throw new HttpResponseException(ApiResponse::sendError(["Payment Request error" => ["Not Found Teacher Payments Already All Payment Paid For This Request"]], 'Payment Request Error', null));

            $status = TeacherPaymentStatusEnum::values()[$indexOfEnum];

        }

        try {
            $models = TeacherPayment::where(["teacher_id" => $teacher_id, "TeacherPaymentStatusEnum" => $searchStatus])->update([
                "TeacherPaymentStatusEnum" => $status
            ]);

            if (!$models)
                throw new HttpResponseException(ApiResponse::sendError(["Payment Request error" => ["Not Found Teacher Payments Records"]], 'Payment Request error please try again later', null));

        } catch (\Exception $e) {
            throw new HttpResponseException(ApiResponse::sendError(["Payment Request error" => ["please try again later"]], 'Payment Request error please try again later', null));
        }


    }

}
