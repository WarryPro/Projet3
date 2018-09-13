/*
### LISTE DE REQUETES SQL POUR LE BLOG (CRUD) ###*/

/*episodes*/
    -- creer episode
    INSERT INTO users(user, email, pass, user_role) VALUES ('Daking', 'daking@hotmail.com', MD5('MonMotdePasse'), 'User');

    -- màj episode
    UPDATE episodes SET content = '', title = '', modif_date = NOW() WHERE id = ':id'; 

    -- supprimer episode
    DELETE FROM episodes WHERE id = ':id';

    -- rechercher tous les episodes
    SELECT * FROM episodes;

    -- rechercher un episode par son title
    SELECT title, content, create_date FROM episodes WHERE title = ':title';


-- comments
--      creer commentaire
        INSERT INTO comments SET comment = $comment, id = $post_id, comment_date = NOW(), episode_id = $episode_id, user = $user;

--      supprimer commentaire
        DELETE FROM comments WHERE id = ':id';

--      rechercher tous les commentaires
        SELECT * FROM comments;

--      rechercher un commentaire par son id
        SELECT * FROM comments WHERE id = ':id';

--      rechercher un commentaire par son user
        SELECT * FROM comments WHERE user = ':user';


-- users
--      creer user
        INSERT INTO users SET user = '', email = '', pass = MD5('monPass'), user_role = '';

--      MàJ user
--          màj données generales 
            UPDATE users SET user_role = '' WHERE user = ':user' AND email = ':email';

--          password
            UPDATE users SET pass = MD5('nouveauPass') WHERE user = ':user' AND email = ':email';

--      supprimer user
        DELETE FROM users WHERE user = ':user' AND email = ':email';

--      rechercher tous les users
        SELECT * FROM users;

--      rechercher un user pour son: 
            -- user
            SELECT * FROM users WHERE user = ':user';

            -- email
            SELECT * FROM users WHERE email = ':email';

            -- user role
            SELECT * FROM users WHERE user_role = ':user_role';
