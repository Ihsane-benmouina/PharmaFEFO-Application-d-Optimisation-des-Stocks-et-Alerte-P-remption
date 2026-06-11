
<?php
require_once __DIR__ . '/../../config/database.php';

class MouvementRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    
    public function logMouvement($lotStockId, $type, $quantite) {
        $stmt = $this->db->prepare("
            INSERT INTO mouvements (lot_stock_id, type, quantite) 
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$lotStockId, $type, $quantite]);
    }

   
}