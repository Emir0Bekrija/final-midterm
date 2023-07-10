<?php
require_once "BaseDao.php";

class MidtermDao extends BaseDao {

    public function __construct(){
        parent::__construct();
    }

    /** TODO
    * Implement DAO method used to add content to database
    */
    public function input_data($data){
        $array = json_decode('../IP2LOCATION.json');
        foreach ($data as $key => $jsons) { // This will search in the 2 jsons
            $sql = "INSERT INTO nova (from, to, code, Country, Region, City) 
            VALUES (:from, :to, :code, :Country, :Region, :City)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':from', $jsons['from']);
            $stmt->bindParam(':to', $jsons['to']);
            $stmt->bindParam(':code', $jsons['code']);
            $stmt->bindParam(':Country', $jsons['Country']);
            $stmt->bindParam(':Region', $jsons['Region']);
            $stmt->bindParam(':City', $jsons['City']);
            $stmt->execute();
       }

        
        
    }

    /** TODO
    * Implement DAO method to return summary as requested within route /midterm/summary
    */
    public function summary(){
        $sql = "SELECT COUNT(Country), COUNT(Region), COUNT(City) FROM nova";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    /** TODO
    * Implement DAO method to return report as requested within route /midterm/report_per_country
    */
    public function report_per_country(){
        $sql = "SELECT Country, COUNT(City) as 'City' FROM nova
        GROUP BY country";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /** TODO
    * Implement DAO method to return location as requested within route /midterm/search
    */
    public function search($from, $to){
        $sql = "SELECT * FROM nova
        WHERE from = :from OR to = :to
        GROUP BY country";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "from" => $from,
            "to" => $to
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
