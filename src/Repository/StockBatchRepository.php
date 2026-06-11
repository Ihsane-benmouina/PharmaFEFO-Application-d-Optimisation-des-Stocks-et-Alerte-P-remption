<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/MouvementRepository.php'; // N-importiw l-MouvementRepository

class StockBatchRepository {
    private PDO $db;
    private MouvementRepository $mouvementRepo;

    public function __construct() {
        $this->db = Database::getConnection();
        $this->mouvementRepo = new MouvementRepository(); // Instanciation dyal repo l-mouvements
    }

    public function getAllProducts() {
        return $this->db->query("SELECT * FROM produits ORDER BY nom ASC")->fetchAll();
    }

    
    public function saveInputBatch($productId, $lotNumber, $quantity, $expiryDate) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("
                INSERT INTO lot_stocks (produit_id, numero_lot, quantite, date_peremption, statut) 
                VALUES (?, ?, ?, ?, 'OK')
            ");
            $stmt->execute([$productId, $lotNumber, $quantity, $expiryDate]);
            $lotId = $this->db->lastInsertId();

            $this->mouvementRepo->logMouvement($lotId, 'ENTREE', $quantity);

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

   
   
}