<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class RegencyScopes implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */

     public $config_id;

     public function __construct($config_id) {
        $this->config_id = $config_id;
     }

    public function apply(Builder $builder, Model $model)
    {
        if ($this->config_id != "") {
            $builder->where('saksi_data.regency_id', $this->config_id);
        }
    }
}