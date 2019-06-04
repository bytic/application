<?php

namespace Nip\Application\Traits;

use Nip\Container\Container;
use Nip\I18n\Middleware\LocalizationMiddleware;
use Nip\I18n\Translator;

/**
 * Trait HasTranslationTrait
 * @package Nip\Application\Traits
 *
 * @method Container getContainer
 */
trait HasTranslationTrait
{
    public function setupTranslation()
    {
        $this->initLanguages();
        (new LocalizationMiddleware($this->getTranslator(), ['stages' => ['query', 'cookie']]))
            ->detect($this->getRequest());
    }

    public function initLanguages()
    {
    }

    /**
     * @return Translator
     */
    public function getTranslator()
    {
        if (!$this->getContainer()->has('translator')) {
            $this->initTranslator();
        }

        return $this->getContainer()->get('translator');
    }

    public function initTranslator()
    {
        $translator = $this->newTranslator();
        $translator->setRequest($this->getRequest());

        Container::getInstance()->set('translator', $translator);
    }

    /**
     * @return Translator
     */
    public function newTranslator()
    {
        return new Translator();
    }
}
