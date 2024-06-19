<?php 
require_once "Database.php";

class Review extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getHistoryList($id)
    {
        $sql = "SELECT tp.*, COUNT(tpd.`quantity`) AS jumlah_barang FROM tb_purchase tp 
                INNER JOIN tb_purchase_detail tpd ON tpd.`purchase_id`=tp.`purchase_id`
                WHERE tp.`user_id`=$id GROUP BY tp.`purchase_id` ORDER BY tp.purchase_date DESC";
        return mysqli_fetch_all($this->runQuery($sql), MYSQLI_ASSOC);
    }

    public function getHistoryDetail($id)
    {
        $sql = "SELECT tpo.product_id, tpd.purchase_id, tp.purchase_date, category_name, product_name, product_description, 
                product_image, total_price, quantity, price, payment_amount, payment_method, payment_status
                FROM tb_purchase tp 
                LEFT JOIN tb_purchase_detail tpd ON tpd.`purchase_id`=tp.`purchase_id`
                LEFT JOIN tb_payment tpt ON tpt.`purchase_id`=tp.`purchase_id`
                LEFT JOIN tb_product tpo ON tpo.`product_id`=tpd.`product_id`
                LEFT JOIN tb_category tc ON tc.`category_id`=tpo.`category_id`
                WHERE tpd.`purchase_id` = $id";

        return mysqli_fetch_all($this->runQuery($sql), MYSQLI_ASSOC);
    }

    public function checkReview($id, $pid)
    {
        return mysqli_num_rows($this->runQuery("SELECT rating FROM tb_product_review WHERE user_id='$id' AND product_id='$pid'"));
    }

    public function addReview($user_id, array $data)
    {
        $product_id     = $data['product_id'];
        $rating         = $data['rating'];
        $comment        = $data['comment'];
        $date_created   = $this->date->format('Y-m-d H:i:s');
        $sql = "INSERT INTO tb_product_review(product_id, user_id, rating, `comment`, review_date) VALUES (
                '$product_id', '$user_id', '$rating', '$comment', '$date_created'
                )";
        return $this->runQuery($sql);
    }
}
$Review = new Review();