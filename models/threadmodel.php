<?php
class ThreadModel extends Model implements IModel
{
    private $id;
    private $title;
    private $content;
    private $creationDate;
    private $userId;

    public function __construct()
    {
        parent::__construct();
    }

    public function getThreadLimit($n, $toArray = false)
    {
        $items = [];
        try {
            $pdo = $this->db->connect(); // Obtener la instancia de PDO
            $query = $pdo->prepare('SELECT * FROM hilo ORDER BY fecha_creacion DESC LIMIT :n');
            $query->execute(['n' => $n]);
            if ($query->rowCount() > 0) {
                while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                    $item = new ThreadModel();
                    $item->from($p);

                    if ($toArray) {
                        $item = $item->toArray();
                    }

                    array_push($items, $item);
                }
                return $items;
            } else {
                return null;
            }
        } catch (PDOException $e) {

            return false;
        }
    }
    public function getById($id)
    {
        try {
            $pdo = $this->db->connect(); // Obtener la instancia de PDO
            $query = $pdo->prepare('SELECT * FROM hilo WHERE id = :id');
            $query->execute(['id' => $id]);
            if ($query->rowCount() > 0) {
                $thread = $query->fetch(PDO::FETCH_ASSOC);
                $this->id = $thread['id'];
                $this->title = $thread['titulo'];
                $this->content = $thread['contenido'];
                $this->creationDate = $thread['fecha_creacion'];
                $this->userId = $thread['usuario_id'];                
                return $this;
            }else{
                return null;
            }

        
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }
    public function save()
    {
        try {
            $pdo = $this->db->connect(); // Obtener la instancia de PDO
            $query = $pdo->prepare('INSERT INTO hilo (titulo, contenido, usuario_id) VALUES(:titulo, :contenido, :usuario_id)');
            $query->execute([
                'titulo' => $this->title,
                'contenido' => $this->content,
                'usuario_id' => $this->userId
            ]);
            if ($query->rowCount() > 0) {
                return $pdo->lastInsertId();
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function update()
    {
        try {
            $pdo = $this->db->connect(); // Obtener la instancia de PDO
            $query = $pdo->prepare('UPDATE FROM hilo SET titulo = :titulo, contenido = :ontenido, fecha_creacion = :fecha_creacion, usuario_id = :usuario_id  WHERE id = :id');
            $query->execute([
                'titulo' => $this->title,
                'contenido' => $this->content,
                'usuario_id' => $this->userId,
                'fecha_creacion' => $this->creationDate,
                'id' => $this->id
            ]);
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    public function delete($id)
    {
        try {
            $pdo = $this->db->connect(); // Obtener la instancia de PDO
            $query = $pdo->prepare('DELETE FROM hilo WHERE id = :id');
            $query->execute([
                'id' => $id,
            ]);
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function from($array)
    {
        $this->id = $array['id'];
        $this->title = $array['titulo'];
        $this->content = $array['contenido'];
        $this->creationDate = $array['fecha_creacion'];
        $this->userId = $array['usuario_id'];
    }
    public function toArray()
    {
        $array = [];
        $array['id'] = $this->id;
        $array['titulo'] = $this->title;
        $array['contenido'] = $this->content;
        $array['fecha_creacion'] = $this->creationDate;
        $array['usuario'] = $this->userId;

        return $array;
    }

    // Métodos para acceder y establecer propiedades

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getuserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}
