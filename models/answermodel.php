<?php
class AnswerModel extends Model implements IModel
{
    private $id;
    private $content;
    private $creationDate;
    private $userId;
    private $threadId;

    public function __construct()
    {
        parent::__construct();
        $this->content = '';
        $this->creationDate = '';
        $this->userId = '';
        $this->threadId = '';
    }

    public function countAnswersByThreadId($threadId)
    {
        try {
            $pdo = $this->db->connect(); // Obtener la instancia de PDO
            $query = $pdo->prepare('SELECT COUNT(*) AS n FROM respuesta WHERE hilo_id = :hilo_id');
            $query->execute(['hilo_id' => $threadId]);
            $p = $query->fetch(PDO::FETCH_ASSOC);
            return $p['n'];
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
    public function getAllByThreadId($threadId, $toArray = false)
    {
        $items = [];
        try {
            $pdo = $this->db->connect(); // Obtener la instancia de PDO
            $query = $pdo->prepare('SELECT * FROM respuesta WHERE hilo_id= :hilo_id');
            $query->execute(['hilo_id' => $threadId]);
            if ($query->rowCount() > 0) {

                while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                    $item = new AnswerModel();
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
            error_log($e->getMessage());
            return false;
        }
    }

    public function getById($id)
    {
        $items = [];
        try {
            $pdo = $this->db->connect(); // Obtener la instancia de PDO
            $query = $pdo->prepare('SELECT * FROM respuesta WHERE id = :id');
            $query->execute(['id' => $id]);
            $answers = $query->fetch(PDO::FETCH_ASSOC);

            $this->id = $answers['id'];
            $this->content = $answers['contenido'];
            $this->creationDate = $answers['fecha_creacion'];
            $this->userId = $answers['usuario_id'];
            $this->threadId = $answers['hilo_id'];

            return $this;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function save()
    {
        try {
            $pdo = $this->db->connect(); // Obtener la instancia de PDO
            $query = $pdo->prepare('INSERT INTO respuesta (contenido, usuario_id, hilo_id) VALUES (:contenido, :usuario_id, :hilo_id)');
            $query->execute([
                'contenido' => $this->content,
                'usuario_id' => $this->userId,
                'hilo_id' => $this->threadId
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

    public function update()
    {
        try {
            $pdo = $this->db->connect(); // Obtener la instancia de PDO
            $query = $pdo->prepare('UPDATE FROM respuesta SET contenido = :contenido, usuario_id = :usuario_id, hilo_id = :hilo_id) WHERE id= :id)');
            $query->execute([
                'contenido' => $this->content,
                'usuario_id' => $this->userId,
                'hilo_id' => $this->threadId,
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
            $query = $pdo->prepare('DELETE FROM respuesta WHERE id = :id');
            $query->execute(['id' => $id ]);
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
        $this->content = $array['contenido'];
        $this->creationDate = $array['fecha_creacion'];
        $this->userId = $array['usuario_id'];
        $this->threadId = $array['hilo_id'];
    }
    public function toArray()
    {
        $array = [];
        $array['id'] = $this->id;
        $array['contenido'] = $this->content;
        $array['fecha_creacion'] = $this->creationDate;
        $array['usuario'] = $this->userId;
        $array['hilo_id'] = $this->threadId;

        return $array;
    }

    // Métodos para acceder y establecer propiedades

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        return $this->id = $id;
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
    public function getThreadId()
    {
        return $this->threadId;
    }
    public function setThreadId($threadId)
    {
        $this->threadId = $threadId;
    }
}
