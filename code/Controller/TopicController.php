<?php

namespace Controller;

use App;
use Model\Topic;

class TopicController
{
    public function indexAction()
    {
        $topicRepository = new \Model\TopicRepository();
        $themeId = $_GET['theme_id'];
        $view = new \View\TopicsList($topicRepository->getTopicsCollection($themeId), $themeId);

        $view->render();
    }

    public function newAction()
    {
        $topic = new Topic($_GET['theme_id']);
        $view = new \View\TopicsNew($topic);
        $view->render();
    }

    public function editAction()
    {
        $id = $_GET['id'];
        $topicRepository = new \Model\TopicRepository();
        $topic = $topicRepository->getTopicById($id);
        $view = new \View\TopicsNew($topic);
        $view->render();
    }

    public function saveAction()
    {
        if (isset($_POST['save']))
        {
            $topicRepository = new \Model\TopicRepository();
            if (!empty($_POST['id'])){
                $topic = $topicRepository->getTopicById($_POST['id']);
                $topic->setName($_POST['topic_name']);
                $topic->setContent($_POST['content']);
            } else{
                $topic = new \Model\Topic($_POST['theme_id'], $_POST['topic_name'], $_POST['content']);
            }
            $topicRepository->saveTopic($topic);
            $url = App::getUrlModel()->getUrl('topic/index', ['theme_id' => $_POST['theme_id']]);
            header("location: $url");
        }
    }

    public function deleteAction()
    {
        $id = $_GET['id'];
        $topicRepository = new \Model\TopicRepository();
        $topic = $topicRepository->getTopicById($id);
        $themeId = $topic->getThemeId();
        $topicRepository->deleteTopic($id);
        $url = App::getUrlModel()->getUrl('topic/index', ['theme_id' => $themeId]);
        header(" location: $url");
    }
}