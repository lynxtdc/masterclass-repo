<?php

namespace Masterclass\Controller;
use Masterclass\Model\Story as StoryModel;
use Masterclass\Model\Comment;
use Aura\Web\Request;
use Aura\Web\Response;
use Aura\View\View;

class Story {

    /**
     * @var StoryModel
     */
    protected $storyModel;

    protected $request;

    protected $response;

    protected $tempate;

    public function __construct(StoryModel $story, Comment $comment, Request $request, Response $response, View $view)
    {
        $this->storyModel = $story;
        $this->commentModel = $comment;
        $this->request = $request;
        $this->response = $response;
        $this->template = $view;
    }
    
    public function index() {
        $id = $this->request->query->get('id');

        if (!$id){
            $this->response->redirect->to('/');
            return $this->response;
        }
        
        $story = $this->storyModel->getStory($id);
        if(!$story) {
            $this->response->redirect->to('/');
            return $this->response;
        }

        $comments = $this->commentModel->getCommentsForStory($story['id']);
        $story['comment_count'] = count($comments);

        $this->template->setData(['story' => $story, 'comments' => $comments]);
        $this->template->setView('story');
        $this->template->setLayout('layout');
        $this->response->content->set($this->template->__invoke());
        return $this->response;
    }
    
    public function create() {
        if(!isset($_SESSION['AUTHENTICATED'])) {
            header("Location: /user/login");
            exit;
        }

        $headline = $this->request->post->get('headline');
        $url = $this->request->post->get('url');
        
        $error = '';
        if(isset($_POST['create'])) {
            if(!$headline || !$url || !filter_var($url, FILTER_VALIDATE_URL)) {
                $error = 'You did not fill in all the fields or the URL did not validate.';       
            } else {
                $id = $this->storyModel->createNewStory($headline, $url, $_SESSION['username']);
                $this->response->redirect->to("/story?id=$id");
                return $this->response;
            }
        }

        $this->template->setView('story_create');
        $this->template->setLayout('layout');
        $this->template->setData(['error' => $error]);
        $this->response->content->set($this->template->__invoke());
        return $this->response;
    }
    
}