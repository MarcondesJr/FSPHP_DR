<?php

namespace Source\Core;

use Source\Support\Message;
use Source\Support\Seo;

/**
 * FSPHP | Class Controller
 *
 * @author Robson V. Leite <cursos@upinside.com.br>
 * @package Source\Core
 */
class Controller
{
    /** @var View */
    protected View $view;

    /** @var Seo */
    protected Seo $seo;

    /** @var Message */
    protected Message $message;

    /**
     * @param string|null $pathToViews
     */
    public function __construct(string $pathToViews = null)
    {
        $this->view = new View($pathToViews);
        $this->seo = new Seo();
        $this->message = new Message();
    }
}