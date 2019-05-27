<?php

namespace Controller;

use App;
use Model\Theme;

class ThemeController
{
    public function indexAction()
    {
        $themeRepository = new \Model\ThemeRepository();

        $view = new \View\ThemesList($themeRepository->getThemesCollection());

        $view->render();
    }

    public function newAction()
    {
        $theme = new Theme();
        $view = new \View\ThemesNew($theme);
        $view->render();
    }

    public function editAction()
    {
        $id = $_GET['id'];
        $themeRepository = new \Model\ThemeRepository();
        $theme = $themeRepository->getThemeById($id);
        $view = new \View\ThemesNew($theme);
        $view->render();
    }

    public function saveAction()
    {
        if (isset($_POST['save'])) {
            $themeRepository = new \Model\ThemeRepository();
            if (!empty($_POST['id'])) {
                $theme = $themeRepository->getThemeById($_POST['id']);
                $theme->setName($_POST['theme_name']);
                $theme->setDescription($_POST['description']);
            } else {
                $theme = new \Model\Theme($_POST['theme_name'], $_POST['description']);
            }
            $themeRepository->saveTheme($theme);
            $url = App::getUrlModel()->getUrl('theme/index', []);
            header("location: $url");
        }
    }

    public function deleteAction()
    {
        $id = $_GET['id'];
        $themeRepository = new \Model\ThemeRepository();
        $themeRepository->deleteTheme($id);
        $url = App::getUrlModel()->getUrl('theme/index', []);
        header("location: $url");
    }
}
