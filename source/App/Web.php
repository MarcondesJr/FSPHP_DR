<?php

namespace Source\App;

use Source\Core\Controller;

/**
 * Web controller
 * @package Source\App
 */
class Web extends Controller
{
    /**
     * Web constructor
     */
    public function __construct()
    {
        parent::__construct( __DIR__ . "/../../themes/". CONF_VIEW_THEME ."/");
    }

    /**
     * SITE HOME
     * @return void
     */
    public function home(): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            url("/assets/images/share.jpg")
        );

        echo $this->view->render("home", [
            "head" => $head,
            "video" => "wjYZcGdPHJo"
        ]);
    }

    /**
     * SITE ABOUT
     * @return void
     */
    public function about(): void
    {
        $head = $this->seo->render(
            "Descubra o " . CONF_SITE_NAME . " - " . CONF_SITE_DESC,
            CONF_SITE_DESC,
            url("/sobre"),
            url("/assets/images/share.jpg")
        );

        echo $this->view->render("about", [
            "head" => $head,
            "video" => "wjYZcGdPHJo"
        ]);
    }

    /**
     * SITE TERMS
     * @return void
     */
    public function terms(): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - Termos de USO",
            CONF_SITE_DESC,
            url("/termos"),
            url("/assets/images/share.jpg")
        );

        echo $this->view->render("terms", [
            "head" => $head
        ]);
    }

    /**
     * SITE NAV ERROR
     * @param array $data
     * @return void
     */
    public function error(array $data): void
    {
        $error = new \stdClass();
        $error->code = $data['errcode'];
        $error->title = "Oooops - Conteúdo Indisponível :/";
        $error->message = "Sentimos muito, mas o conteúdo que você tentou acessar não existe, está indisponível no momento ou foi removido :/";
        $error->linkTitle = "Continue Navegando";
        $error->link = url_back();

        $head = $this->seo->render(
            "{$error->code} | {$error->title}",
            $error->message,
            url_back("/ops/{$error->code}"),
            url("/assets/images/share.jpg"),
            false
        );

        echo $this->view->render("error", [
            "head" => $head,
            "error" => $error
        ]);
    }
}