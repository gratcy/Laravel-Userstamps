<?php

namespace Wildside\Userstamps\Listeners;

use Illuminate\Support\Facades\Auth;
use \MongoDB\BSON\ObjectId;

class Creating
{
    /**
     * When the model is being created.
     *
     * @param Illuminate\Database\Eloquent $model
     * @return void
     */
    public function handle($model)
    {
        if (! $model->isUserstamping() || is_null($model->getCreatedByColumn())) {
            return;
        }

        if (is_null($model->{$model->getCreatedByColumn()})) {
            $model->{$model->getCreatedByColumn()} = new ObjectId(Auth::id());
        }

        if (is_null($model->{$model->getUpdatedByColumn()}) && ! is_null($model->getUpdatedByColumn())) {
            $model->{$model->getUpdatedByColumn()} = new ObjectId(Auth::id());
        }
    }
}
