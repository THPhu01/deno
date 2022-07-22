<?php
    include('../model/category.php');

    class CategoryDAO {
        private $database;

        public function __construct() {
            $this->database = new Database();
            $this->database = $this->database->getDatabase();
            $this->database->query("SET NAMES 'utf8'");
        }


        public function getAllCategory($categoryID) {
            if ($this->database->connect_error) {
                return false;
            } else {
                $query = $this->database->prepare("SELECT * FROM category where categoryID");

                if ($query->execute()) {
                    $result = $query->get_result();
                    if ($result->num_rows > 0) {
                        $categorys = [];
                        while ($row = $result->fetch_assoc()) {
                            $category  = new category($row['categoryID '], $row['category ']);
                            $categorys [] = $category;
                        }
                        return $categorys;
                    } else {
                        return false;
                    }
                }
                else {
                    return false;
                }
            }
        }
        // lấy product qua id
        public function getCategoryById($id) {
            if ($this->database->connect_error) {
                return false;
            } else {
                $query = $this->database->prepare('SELECT * FROM category WHERE categoryID  = ?');
                $query->bind_param('s', $id);

                if ($query->execute()) {
                    $result = $query->get_result();
                    if ($result->num_rows > 0) {
                        $category = $result->fetch_assoc();
                        return new category($category['categoryID'], $category['category']);
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        }

    }       
?>
