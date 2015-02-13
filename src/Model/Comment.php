<?php

namespace Masterclass\Model;

use Masterclass\Dbal\AbstractDb;

class Comment
{

    /**
     * @var AbstractDb
     */
    protected $db;

    public function __construct(AbstractDb $db) {
        $this->db = $db;
    }

    /**
     * @param $id
     * @return array
     */
    public function getCommentsForStory($id){
        $comment_sql = 'SELECT * FROM comment WHERE story_id = ?';
        $comments = $this->db->fetchAll($comment_sql, [$id]);
        return $comments;
    }

    /**
     * @param $username
     * @param $story_id
     * @param $comment
     * @return bool
     */
    public function postNewComment($username, $story_id, $comment)
    {
        $sql = 'INSERT INTO comment (created_by, created_on, story_id, comment) VALUES (?, NOW(), ?, ?)';
        return $this->db->execute($sql, array(
            $username,
            $story_id,
            filter_var($comment, FILTER_SANITIZE_FULL_SPECIAL_CHARS)
        ));
    }

}