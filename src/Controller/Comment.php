<?php

namespace Masterclass\Controller;

use Aura\Web\Request;
use Aura\Web\Response;
use Masterclass\Model\Comment as CommentModel;

class Comment {

    /**
     * @var commentModel
     */
    protected $commentModel;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    public function __construct(CommentModel $comment, Request $request, Response $response)
    {
        $this->commentModel = $comment;
        $this->request = $request;
        $this->response = $response;
    }

    
    public function create() {
        if(!isset($_SESSION['AUTHENTICATED'])) {
            die('not auth');
            header("Location: /");
            exit;
        }

        $username = $_SESSION['username'];
        $storyID = $this->request->post->get('story_id');
        $comment = $this->request->post->get('comment');

        $this->commentModel->postNewComment($username, $storyID, $comment);
        $this->response->redirect->to('/story?id=' . (int)storyID);
        return $this->response;
    }
    
}