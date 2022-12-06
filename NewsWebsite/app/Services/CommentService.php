<?php

namespace App\Services;

use App\Providers\HelperServiceProvider;
use App\Categories;
use App\Repositories\CommentRepository;
use App\Helpers;
use App\Comments;
use App\Post;
use Illuminate\Http\Request;

class CommentService
{
    protected $commentRepository;
    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function listComment($comment)
    {
        $comment = $this->commentRepository->list($comment);
        return $comment;
    }

    public function editComment($id)
    {
        return $this->commentRepository->edit($id);
    }

    public function activeComment()
    {
        return $this->commentRepository->active();
    }

    public function deleteComment($id)
    {
        return $this->commentRepository->delete($id);
    }

    public function detailsComment($id)
    {
        return $this->commentRepository->details($id);
    }

    public function addComment($atrributes, $id)
    {
        return $this->commentRepository->add($atrributes, $id);
    }

    public function storeComment($atrributes, $id)
    {
        return $this->commentRepository->store($atrributes, $id);
    }
}