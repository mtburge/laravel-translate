<?php
echo 'This is a file which uses the ' . trans('trans') . ' method ' . trans("twice")
    . '. An underscore one is used' . __('You\'re seeing an underscore')
    . 'Parameterised methods are also allowed: ' . __('parameter :name', ['name' => 'Matt']);
