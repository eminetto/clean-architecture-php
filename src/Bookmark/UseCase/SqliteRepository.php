<?php

namespace Bookmark\UseCase;

use Bookmark\Entity\Bookmark;

class SqliteRepository implements RepositoryInterface
{
    private $conn;

    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
        $this->conn->exec("CREATE TABLE IF NOT EXISTS bookmarks (
                    id INTEGER PRIMARY KEY, 
                    name TEXT, 
                    description TEXT, 
                    link TEXT,
                    tags TEXT,
                    favorite integer)");
    }

    public function find(int $id) : Bookmark
    {
        $result = $this->conn->query("SELECT * FROM bookmarks where id =$id");
        $b = new Bookmark;
        $b->id = $m[0]['id'];
        $b->name = $m[0]['name'];
        $b->description = $m[0]['description'];
        $b->link = $m[0]['link'];
        $b->tags = explode(",", $m[0]['tags']);
        $b->favorite = $m[0]['favorite'];
        return $b;
    }

    //@todo implement exception
    public function search(string $query)
    {
        $all = [];
        $result = $this->conn->query("SELECT * FROM bookmarks where name like '%$query%'");
        foreach ($result as $m) {
            $b = new Bookmark;
            $b->id = $m['id'];
            $b->name = $m['name'];
            $b->description = $m['description'];
            $b->link = $m['link'];
            $b->tags = explode(",", $m['tags']);
            $b->favorite = $m['favorite'];
            $all[] = $b;
        }
        return $all;
    }

    public function findAll()
    {
        $all = [];
        $result = $this->conn->query('SELECT * FROM bookmarks');
        foreach ($result as $m) {
            $b = new Bookmark;
            $b->id = $m['id'];
            $b->name = $m['name'];
            $b->description = $m['description'];
            $b->link = $m['link'];
            $b->tags = explode(",", $m['tags']);
            $b->favorite = $m['favorite'];
            $all[] = $b;
        }
        return $all;
    }

    public function store(Bookmark $bookmark): int
    {
        $stmt = $this->conn->prepare('insert into bookmarks (name, description, link, tags, favorite) values (:name, :description, :link, :tags, :favorite)');
        $stmt->bindParam(':name',$bookmark->name);
        $stmt->bindParam(':description', $bookmark->description);
        $stmt->bindParam(':link', $bookmark->link);
        $tags = implode(",", $bookmark->tags);
        $stmt->bindParam(':tags', $tags);
        $stmt->bindParam(':favorite', $bookmark->favorite);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function delete(int $id) : bool
    {
        $result = $this->conn->query("delete FROM bookmarks where id =$id");
        return true;
    }
}