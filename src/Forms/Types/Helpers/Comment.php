<?php namespace Keerill\Widgets\Forms\Types\Helpers;

use Illuminate\Support\Arr;

trait Comment {
    /**
     * @var string Классы для описания поля
     */
    protected $commentClass = null;

    /**
     * @var string Описание поля
     */
    protected $comment = null;

    /**
     * Возвращает комментарий для поля
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Задает комментарий для поля
     * @param string $comment
     * @return self
     */
    public function setComment(string $comment = null)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * Возвращает классы комментария
     * @return string
     */
    public function getCommentClass()
    {
        return $this->commentClass;
    }

    /**
     * Изменяет классы для комментария
     * @param string
     * @return self
     */
    public function setCommentClass(string $commentClass)
    {
        $this->commentClass = $commentClass;
        return $this;
    }
}