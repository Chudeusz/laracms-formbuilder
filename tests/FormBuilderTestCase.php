<?php

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Validation\Factory;
use Chudeusz\LaraCMSFormBuilder\FormBuilder;
use Chudeusz\LaraCMSFormBuilder\FormHelper;
use Chudeusz\LaraCMSFormBuilder\Form;
use Orchestra\Testbench\TestCase;
use Illuminate\Database\Eloquent\Model;
use Chudeusz\LaraCMSFormBuilder\Filters\FilterResolver;

class TestModel extends Model {
    protected $fillable = ['m', 'f'];
}

abstract class FormBuilderTestCase extends TestCase {

    /**
     * @var \Illuminate\View\Factory
     */
    protected $view;

    /**
     * @var \Illuminate\Translation\Translator
     */
    protected $translator;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var FormHelper
     */
    protected $formHelper;

    /**
     * @var Container
     */
    protected $container;

    /**
     * Model
     */
    protected $model;

    /**
     * @var FormBuilder
     */
    protected $formBuilder;

    /**
     * @var Factory
     */
    protected $validatorFactory;

    /**
     * @var EventDispatcher
     */
    protected $eventDispatcher;

    /**
     * @var Form
     */
    protected $plainForm;

    /**
     * @var FilterResolver $filtersResolver
     */
    protected $filtersResolver;

    public function setUp()
    {
        parent::setUp();

        $this->view = $this->app['view'];
        $this->translator = $this->app['translator'];
        $this->request = $this->app['request'];
        $this->request->setLaravelSession($this->app['session.store']);
        $this->validatorFactory = $this->app['validator'];
        $this->eventDispatcher = $this->app['events'];
        $this->model = new TestModel();
        $this->config = include __DIR__.'/../src/config/config.php';

        $this->formHelper = new FormHelper($this->view, $this->translator, $this->config);
        $this->formBuilder = new FormBuilder($this->app, $this->formHelper, $this->eventDispatcher);

        $this->plainForm = $this->formBuilder->plain();

        $this->filtersResolver = new FilterResolver();
    }

    public function tearDown()
    {
        $this->view = null;
        $this->request = null;
        $this->container = null;
        $this->model = null;
        $this->config = null;
        $this->formHelper = null;
        $this->formBuilder = null;
        $this->plainForm = null;
        $this->filtersResolver = null;
    }

    protected function getDefaults($attr = [], $label = '', $defaultValue = null, $helpText = null)
    {
        return [
            'wrapper' => ['class' => 'form-group'],
            'attr' => array_merge(['class' => 'form-control'], $attr),
            'help_block' => ['text' => $helpText, 'tag' => 'p', 'attr' => [
                'class' => 'help-block'
            ]],
            'value' => $defaultValue,
            'default_value' => null,
            'label' => $label,
            'label_show' => true,
            'is_child' => false,
            'label_attr' => ['class' => 'control-label'],
            'errors' => ['class' => 'text-danger'],
            'wrapperAttrs' => 'class="form-group" ',
            'errorAttrs' => 'class="text-danger" ',
            'rules' => [],
            'error_messages' => []
        ];
    }

    protected function getPackageProviders($app)
    {
        return ['Chudeusz\LaraCMSFormBuilder\FormBuilderServiceProvider'];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Acme' => 'Chudeusz\LaraCMSFormBuilder\Facades\FormBuilder'
        ];
    }
}
