<?php
echo 'This is a file which uses the ' . trans('trans') . ' method ' . trans("twice")
    . '. An underscore one is used' . __('underscore')
    . 'Parameterised methods are also allowed: ' . __('parameter :name', ['name' => 'Matt']);
