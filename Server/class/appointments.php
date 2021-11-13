<?php
    class Appointment{

        // Connection
        private $conn;

        // Table
        private $db_table = "Appointment";

        // Columns
        public $id;
        public $name;
        public $services;
        public $day;
        public $month;
        public $time;
        public $status;
        public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getAppointments(){
            $sqlQuery = "SELECT id, name, services, day, month, time , status , created FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createAppointment(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        services = :services,
                        day = :day,
                        month = :month,
                        time= :time,
                        status = :status,
                        created = :created";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->services=htmlspecialchars(strip_tags($this->services));
            $this->day=htmlspecialchars(strip_tags($this->day));
            $this->month=htmlspecialchars(strip_tags($this->month));
            $this->time=htmlspecialchars(strip_tags($this->time));
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":services", $this->services);
            $stmt->bindParam(":day", $this->day);
            $stmt->bindParam(":month", $this->month);
            $stmt->bindParam(":time", $this->time);
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleAppointment(){
            $sqlQuery = "SELECT
                        id, 
                        name, 
                        services,
                        day,
                        month,
                        time,
                        status, 
                        created
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->services = $dataRow['services'];
            $this->day = $dataRow['day'];
            $this->month = $dataRow['month'];
            $this->time = $dataRow['time'];
            $this->status = $dataRow['status'];
            $this->created = $dataRow['created'];
        }        

        // UPDATE
        public function updateAppointment(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        services = :services,
                        day = :day,
                        month = :month,
                        time = :time,
                        status = :status, 
                        created = :created
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->services=htmlspecialchars(strip_tags($this->services));
            $this->day=htmlspecialchars(strip_tags($this->day));
            $this->month=htmlspecialchars(strip_tags($this->month));
            $this->time=htmlspecialchars(strip_tags($this->time));
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":services", $this->services);
            $stmt->bindParam(":day", $this->day);
            $stmt->bindParam(":month", $this->month);
            $stmt->bindParam(":time", $this->time);
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteAppointment(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>