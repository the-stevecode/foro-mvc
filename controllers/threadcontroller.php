<?php
final class ThreadController extends SessionController
{
    public function __construct()
    {
        parent::__construct();
        $this->requireModel(['thread', 'answer', 'answer']);
    }
    function index()
    {
        $threads = $this->getThreadsAll();
        $threadsAllInfo = [];

        foreach ($threads as $thread) {
            $thread['usuario'] = $this->getUser($thread['usuario']);
            $thread['respuestas'] = $this->countAnswers($thread['id']);
            array_push($threadsAllInfo, $thread);
        }

        $this->view->render('thread/index', ['user' => $this->user, 'threads' => $threadsAllInfo]);
    }

    function info($params)
    {
        $thread =  $this->getThreadAllInfo($params[0]);
        if (!$thread) {
            $this->redirect('thread');
        } else {
            $this->view->render('thread/info', ['user' => $this->user, 'thread' => $thread]);
        }
    }
    function newthread()
    {
        $title = $this->getPost('title');
        $content = $this->getPost('content');

        if (empty($title) && empty($content)) {
            $this->redirect('thread');
            return;
        }

        $thread = new ThreadModel();
        $thread->setTitle($title);
        $thread->setContent($content);
        $thread->setUserId($this->user->getId());
        $id = $thread->save();
        if ($id != false) {
            $this->redirect('thread/info/' . $id);
        }
    }

    public function respondToThread($threadId)
    {
        $threadId = $threadId[0];
        if (empty($threadId)) {
            $this->redirect('thread');
            return;
        }

        $content = trim($this->getPost('content'));

        if (empty($content)) {
            $this->redirect('thread/info/' . $threadId);
            return;
        }

        $answer = new AnswerModel();

        $answer->setContent($content);
        $answer->setThreadId($threadId);
        $answer->setUserId($this->user->getId());

        if ($answer->save()) {
            $this->redirect('thread/info/' . $threadId,);
        } else {
            $this->redirect('thread/info/' . $threadId,);
        }
    }

    public function deleteAnswer($answerId)
    {
        $answerId = $answerId[0];
        $answer = new AnswerModel();
        $answer->getById($answerId);
        $threadId = $answer->getThreadId();

        if ($answer->delete($answerId)) {
            $this->redirect('thread/info/' . $threadId,);
        }
    }


    private function getThreadAllInfo($threadId)
    {
        $threadObj = new ThreadModel();
        if(!$threadObj->getById($threadId)){
            return null;
        }
        $thread = $threadObj->getById($threadId)->toArray();
        $thread['usuario'] = $this->getUser($thread['usuario']);
        $thread['respuestas'] = $this->getAnswersByThreadId($thread['id']);

        return $thread;
    }

    private function getThreadsAll($n = 10)
    {
        $thread = new ThreadModel();
        return $thread->getThreadLimit($n, true);
    }

    private function getUser($userId)
    {
        $user = new UserModel();
        $user->getById($userId);
        $userInfo = [];
        $userInfo['id'] = $user->getId();
        $userInfo['usuario'] = $user->getUsername();

        return $userInfo;
    }

    private function countAnswers($threadId)
    {
        $answer = new AnswerModel();
        return $answer->countAnswersByThreadId($threadId);
    }

    private function getAnswersByThreadId($threadId)
    {
        $answerObj = new AnswerModel();
        $answers = $answerObj->getAllByThreadId($threadId, true);
        if (!$answers) {
            return null;
        }
        $answersAllInfo = [];

        foreach ($answers as $answer) {
            $answer['usuario'] = $this->getUser($answer['usuario']);
            array_push($answersAllInfo, $answer);
        }
        return $answersAllInfo;
    }
}
