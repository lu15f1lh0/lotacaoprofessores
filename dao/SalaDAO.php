<?php
// @arquivo = /dao/SalaDAO.php
// MVC = controller
// objeto = Sala

  require_once($_SERVER['DOCUMENT_ROOT'] . '/model/Sala.class.php');
  require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/BD.class.php');

	class SalaDAO {
    
    public function register (Sala $sala) {

      try {
        $dbh = Connection::connect();

        $sql = "INSERT INTO tab_sla (sla_cod, sla_nom, sla_cap) VALUES (NULL, ?, ?)";

        $register = $dbh->prepare($sql);
        $register->bindValue(1, $sala->__get("sla_nom"));
        $register->bindValue(2, $sala->__get("sla_cap"));
        $register->execute();

        return 1;
      } catch (Exception $e) {
        //echo "Failed: " . $e->getMessage();
      }

    }
    
    public function update (Sala $sala) {

      try {
        $dbh = Connection::connect();

        $sql = "UPDATE tab_sla
                SET    sla_nom = ?,
                       sla_cap = ?
                WHERE  sla_cod = ?";

        $update = $dbh->prepare($sql);
        $update->bindValue(1, $sala->__get("sla_nom"));
        $update->bindValue(2, $sala->__get("sla_cap"));
        $update->bindValue(3, $sala->__get("sla_cod"));
        $update->execute();

        return 1;
      } catch (Exception $e) {
        //die("Unable to connect: " . $e->getMessage());
      }

      return 0;
    }
    
    public function remove ($sla_cod) {
      try {
        $dbh = Connection::connect();

        $sql = "DELETE FROM tab_sla WHERE sla_cod = ?";

        $remove = $dbh->prepare($sql);
        $remove->bindValue(1, $sla_cod);
        $remove->execute();

        return 1;
      } catch (Exception $e) {
        //echo "Failed: " . $e->getMessage();
      }

      return 0;
    }

    public function search($id) {

      try {
        $dbh = Connection::connect();

        $sql = "SELECT * FROM tab_sla WHERE sla_cod = ?";

        $search = $dbh->prepare($sql);
        $search->bindValue(1, $id);
        $search->execute();

        $sla = $search->fetch(PDO::FETCH_ASSOC);
        $aux = new Sala();
        $aux->setAll($sla["sla_cod"], $sla["sla_nom"], $sla["sla_cap"]);

        return $aux;
      } catch (Exception $e) {
        //die("Unable to connect: " . $e->getMessage());
      }

      return 0;
    }

    public function searchAll() {

      try {
        $dbh = Connection::connect();

        $sql = "SELECT * FROM tab_sla";

        $search = $dbh->prepare($sql);
        $search->execute();

        while ($sla = $search->fetch(PDO::FETCH_ASSOC)) {
          $aux = new Sala();
          $aux->setAll($sla["sla_cod"], $sla["sla_nom"], $sla["sla_cap"]);
          $slas[] = $aux;
        }

        return $slas;
      } catch (Exception $e) {
        //die("Unable to connect: " . $e->getMessage());
      }

      return 0;
    }
  }
?>