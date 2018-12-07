<?php

use Chudeusz\LaraCMSFormBuilder\Form;
use Chudeusz\LaraCMSFormBuilder\Traits\ValidatesWhenResolved;

class TestForm extends Form
{
    use ValidatesWhenResolved;

    public function buildForm()
    {
        $this->add('name', 'text', ['rules' => ['required', 'min:3']]);
        $this->add('email', 'text', ['rules' => ['required', 'email', 'min:3']]);
    }

}