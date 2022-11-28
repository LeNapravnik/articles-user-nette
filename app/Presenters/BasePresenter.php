<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Forms\FormFactory;
use Nette\Application\AbortException;
use Nette\Application\UI\Presenter;

/**
 * Base presenter for other application presenters
 * @package App\Presenters
 */
abstract class BasePresenter extends Presenter {
    /** @var FormFactory factory for creating forms */
    protected FormFactory $formFactory;

    /**
     * Gets form factory using DI.
     * @param FormFactory $formFactory injected form factory
     */
    public final function injectFormFactory(FormFactory $formFactory) {
        $this->formFactory = $formFactory;
    }

}