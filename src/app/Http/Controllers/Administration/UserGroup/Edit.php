<?php

namespace LaravelEnso\Core\App\Http\Controllers\Administration\UserGroup;

use Illuminate\Routing\Controller;
use LaravelEnso\Core\App\Forms\Builders\UserGroupForm;
use LaravelEnso\Core\App\Models\UserGroup;

class Edit extends Controller
{
    public function __invoke(UserGroup $userGroup, UserGroupForm $form)
    {
        return ['form' => $form->edit($userGroup)];
    }
}
