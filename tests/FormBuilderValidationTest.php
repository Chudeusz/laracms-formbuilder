<?php

namespace {

    use Chudeusz\LaraCMSFormBuilder\Events\AfterFieldCreation;
    use Chudeusz\LaraCMSFormBuilder\Events\AfterFormCreation;
    use Chudeusz\LaraCMSFormBuilder\Form;
    use Chudeusz\LaraCMSFormBuilder\FormBuilder;
    use Chudeusz\LaraCMSFormBuilder\FormHelper;

    class FormBuilderValidationTest extends FormBuilderTestCase
    {
        public function setUp()
        {
            parent::setUp();
            $this->app
                ->make('Illuminate\Contracts\Http\Kernel')
                ->pushMiddleware('Illuminate\Session\Middleware\StartSession');
        }

        public function testItValidatesWhenResolved()
        {
            Route::post('/test', TestController::class.'@validate');

            $this->post('/test', ['email' => 'foo@bar.com'])
                ->assertRedirect('/')
                ->assertSessionHasErrors(['name']);
        }

        public function testItDoesNotValidateGetRequests()
        {
            Route::get('/test', TestController::class.'@validate');

            $this->get('/test', ['email' => 'foo@bar.com'])
                ->assertStatus(200);
        }
    }
}
