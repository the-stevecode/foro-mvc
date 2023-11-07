<?php
class UserModel extends Model implements IModel
{
    private $id;
    private $userName;
    private $email;
    private $password;
    private $registrationDate;

    public function __construct()
    {
        parent::__construct();
        $this->email = '';
        $this->userName = '';
        $this->password = '';
    }

    public function exist($username)
    {
        try {
            $pdo = $this->db->connect();
            $query = $pdo->prepare('SELECT * FROM usuario  WHERE usuario = :usuario ');
            $query->execute(['usuario' => $username]);
            if ($query->rowCount() > 0) {
                return true;
            }else {
                return false;
            }

        } catch (PDOException $e) {
            error_log('UserModel::exist ' . $e->getMessage());
            return false;
        }
    }

    public function getById($id)
    {
        try {
            $pdo = $this->db->connect();
            $query = $pdo->prepare('SELECT * FROM usuario  WHERE id =:id ');
            $query->execute(['id' => $id]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            $this->id = $user['id'];
            $this->userName = $user['usuario'];
            $this->email = $user['correo'];
            $this->password = $user['clave'];
            $this->registrationDate = $user['fecha_registro'];

            return $this;
        } catch (PDOException $e) {
            error_log('UserModel::getById ' . $e->getMessage());
            return false;
        }
    }

    public function save()
    {
        try {
            $pdo = $this->db->connect(); // Obtener la instancia de PDO
            $query = $pdo->prepare('INSERT INTO usuario (usuario, correo, clave) VALUES (:usuario, :correo , :clave)');
            $query->execute([
                'usuario' => $this->userName,
                'correo' => $this->email,
                'clave' => $this->password
            ]);
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log('UserModel::save ' . $e->getMessage());
            return false;
        }
    }

    public function update()
    {
        try {
            $pdo = $this->db->connect(); // Obtener la instancia de PDO
            $query = $pdo->prepare('UPDATE usuario SET usuario = :usuario, correo = :correo, clave = :clave, fecha_registro = :fecha_registro WHERE id = :id');
            $query->execute([
                'usuario' => $this->userName,
                'correo' => $this->email,
                'clave' => $this->password,
                'fecha_registro' => $this->registrationDate,
                'id' => $this->id
            ]);

            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log('UserModel::update ' . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $pdo = $this->db->connect(); // Obtener la instancia de PDO
            $query = $pdo->prepare('DELETE FROM usuario WHERE id = :id');
            $query->execute([
                'id' => $id
            ]);

            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log('UserModel::delete ' . $e->getMessage());
            return false;
        }
    }

    public function from($array)
    {
        $this->id = $array['id'];
        $this->email = $array['correo'];
        $this->password = $array['clave'];
        $this->registrationDate = $array['fecha_registro'];
    }

    // Métodos para acceder y establecer propiedades

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getUsername()
    {
        return $this->userName;
    }
    public function setUsername($username)
    {
        $this->userName = $username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    private function getHashedPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
    }
    //FIXME: validar si se requiere el parametro de hash
    public function setPassword($password, $hash = true)
    {
        if ($hash) {
            $this->password = $this->getHashedPassword($password);
        } else {
            $this->password = $password;
        }
    }

    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;
    }
}
