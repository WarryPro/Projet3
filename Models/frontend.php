<?php

require_once('Manager.php');

function getPosts()
{
    $db = dbConnect();

    $req = $db->query('SELECT 
                            id, 
                            title, 
                            content, 
                            image_episode,
                            DATE_FORMAT(created_date, \'%d/%m/%Y à %Hh%imin%ss\') 
                            AS created_date_fr FROM episodes ORDER BY created_date DESC LIMIT 0, 6');

    return $req;
}

function getPost($postId)
{
    $db = dbConnect();

    $req = $db->prepare('SELECT 
                              id, 
                              title, 
                              content, 
                              image_episode,
                              DATE_FORMAT(created_date, \'%d/%m/%Y à %Hh%imin%ss\') 
                              AS created_date_fr FROM episodes WHERE id = ?');

    $req->execute(array($postId));

    $post = $req->fetch();

    return $post;
}

function getComments($postId)
{
    $db = dbConnect();
    $comments = $db->prepare('SELECT 
                                  id, 
                                  user, 
                                  comment, 
                                  DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') 
                                  AS comment_date_fr FROM comments WHERE episode_id = ? ORDER BY comment_date DESC');

    $comments->execute(array($postId));

    return $comments;
}
