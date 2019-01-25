<?php namespace Keerill\Widgets\Forms\Types\Helpers;

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

     /**
     * Возвращает атрибуты для комментария поля
     * @return array
     */
    public function getCommentAttributes()
    {
        $cssClasses = array_wrap(config('widgets.attributes.comment'));

        if (
            ($customAttributes = config("widgets.customAttributes.{$this->getType()}.comment")) &&
            is_array($customAttributes)
        ) {
            $cssClasses = array_merge($cssClasses, $customAttributes);
        }

        if ($this->getCommentClass() !== null) {
            $cssClasses['class'][] = $this->getCommentClass();
        }

        return $cssClasses;
    }
}