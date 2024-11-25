<?php

namespace App\Controller\Front;

use App\Controller\AbstractController;
use App\Core\Session;
use App\Repository\TopicRepository;

class TopicController extends AbstractController
{
    public function showTopic(array $params)
    {
        $id = $params['id'];

        $repository = new TopicRepository();
        $messages = $repository->findAllMessageByTopicId($id);

        $this->render('front/topic', ['messages' => $messages, 'id' => $id]);
    }

    public function processAddMessageForm()
    {
        $topicId = htmlspecialchars($_POST['id']);
        $session = new Session();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location:/code-et-compote/topic/' . $topicId);
            exit;
        }

        if (!isset($_POST['message']) || empty($_POST['message'])) {
            $session->createFlashMessage('Veuillez ajouter un message');

            header('Location:/code-et-compote/topic/' . $topicId);
            exit;
        }

        $message = trim($_POST['message']);
        $userId = $_SESSION['id'];

        $repository = new TopicRepository();
        $repository->addMessageByTopicId($message, $userId, $topicId);

        header('Location:/code-et-compote/topic/' . $topicId);
        exit;
    }
}
