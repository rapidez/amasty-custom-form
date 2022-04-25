<?php

namespace Rapidez\AmastyCustomForm\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Rapidez\Core\Models\Scopes\IsActiveScope;

class AmastyCustomForm extends Model
{
    protected $table = 'amasty_customform_form';

    protected $primaryKey = 'form_id';

    protected static function booting()
    {
        static::addGlobalScope(new IsActiveScope('status'));
        static::addGlobalScope('for-current-store', function (Builder $builder) {
            $builder->whereRaw('? IN (store_id)', [0])->orWhereRaw('? IN (store_id)', [config('rapidez.store')]);
        });
    }
}
