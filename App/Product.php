<?php 
require_once 'Database.php';

class Product extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    // CRUD table product
    public function getAllProducts()
    {
        $sql  = "SELECT * FROM tb_product tp 
                INNER JOIN tb_category tc ON tc.category_id = tp.category_id";
        return mysqli_fetch_all($this->runQuery($sql), MYSQLI_ASSOC);
    }
    
    public function getProduct($id) 
    {
        $sql  = "SELECT * FROM tb_product tp 
                INNER JOIN tb_category tc ON tc.category_id = tp.category_id
                WHERE product_id = '$id' LIMIT 1";
        return mysqli_fetch_assoc($this->runQuery($sql));
    }

    public function addProduct(array $data) 
    {
        $cat_id         = $data['category_id'];
        $product_name   = $data['product_name'];
        $product_price  = $data['product_price'];
        $product_desc   = $data['product_description'];
        $product_status = $data['product_status'];
        $date_created   = $this->date->format('Y-m-d H:i:s');

        $target_dir     = 'uploads/';
        $file           = pathinfo($_FILES['product_image']['name'], PATHINFO_ALL);
        $new_filename   = $this->date->format('YmdHi') . '_' . $file['basename'];
        $uploaded_file  = $target_dir . $new_filename;

        $sql            = "INSERT INTO tb_product(category_id, product_name, product_price, product_description, product_image, product_status, date_created)
                        VALUES('$cat_id', '$product_name', '$product_price', '$product_desc', '$new_filename', '$product_status', '$date_created')";

        if(move_uploaded_file($_FILES['product_image']['tmp_name'], $uploaded_file)) {
            return $this->runQuery($sql);
        } else echo "<script>alert('failed to upload file')</script>";
    }

    public function updateProduct(array $data)
    {
        $product_id     = $data['product_id'];
        $cat_id         = $data['category_id'];
        $product_name   = $data['product_name'];
        $product_price  = $data['product_price'];
        $product_desc   = $data['product_description'];
        $product_status = $data['product_status'];
        $date_created   = $this->date->format('Y-m-d H:i:s');

        $new_filename   = $data['old_img'];
        $target_dir     = 'uploads/';

        if($data['old_img'] != $_FILES['product_image']['name'] && $_FILES['product_image']['name'] != '') {
            $file           = pathinfo($_FILES['product_image']['name'], PATHINFO_ALL);
            if(file_exists($target_dir.$new_filename)) unlink($target_dir.$new_filename);
            $new_filename   = $this->date->format('YmdHi') . '_' . $file['basename'];
            if(!move_uploaded_file($_FILES['product_image']['tmp_name'], $target_dir.$new_filename)) echo "<script>alert('failed to upload file')</script>";
        }

        $sql = "UPDATE tb_product SET 
                category_id = '$cat_id',
                product_name = '$product_name',
                product_price = '$product_price',
                product_description = '$product_desc',
                product_image = '$new_filename',
                product_status = '$product_status',
                date_created = '$date_created' WHERE product_id = $product_id";

        return $this->runQuery($sql);
    }

    public function deleteProduct($id) 
    {
        $product = $this->getProduct($id);
        if($this->runQuery("DELETE FROM tb_product WHERE product_id = $id")) {
            if(file_exists('uploads/'.$product['product_image'])) 
                if(!unlink('uploads/'.$product['product_image'])) echo "<script>alert('gagal menghapus file gambar')</script>";
            return true;
        } else return false;
    }

    // CRUD table review
    public function getProductReviews($id) 
    {
        $sql  = "SELECT * FROM tb_product_review tr 
                INNER JOIN tb_user ts ON ts.user_id = tr.user_id
                WHERE tr.product_id = '$id'";
        return mysqli_fetch_all($this->runQuery($sql), MYSQLI_ASSOC);
    }

    // CRUD table category
    public function getAllCategories()
    {
        $sql = "SELECT distinct * FROM tb_category tc";
                
        return mysqli_fetch_all($this->runQuery($sql), MYSQLI_ASSOC);
    }

    public function countProducts($id)
    {
        $sql = "SELECT COUNT(product_name) as product_count from tb_product where category_id=$id ";
        return mysqli_fetch_object($this->runQuery($sql))->product_count;
    }

    public function getCategory($id) 
    {
        return mysqli_fetch_assoc($this->runQuery("SELECT * FROM tb_category WHERE category_id='$id'"));
    }

    public function addCategory(array $data)
    {
        $cat_name   = $data['category_name'];
        return $this->runQuery("INSERT INTO tb_category(category_name) VALUES ('$cat_name')");
    }

    public function updateCategory(array $data)
    {
        $id         = $data['category_id'];
        $cat_name   = $data['category_name'];

        return $this->runQuery("UPDATE tb_category SET category_name='$cat_name' WHERE category_id='$id'");
    }

    public function deleteCategory($id) 
    {
        return $this->runQuery("DELETE FROM tb_category WHERE category_id=$id");
    }
}

$Product = new Product();