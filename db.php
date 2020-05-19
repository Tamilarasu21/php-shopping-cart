<?php
class db
{
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $con;

    public function __construct($dbname="",$tablename="",$servername="localhost",$username="root",$password="")
    {
        $this->dbname=$dbname;
        $this->tablename=$tablename;
        $this->servername=$servername;
        $this->servername=$servername;
        $this->password=$password;

        #connection
        $this->con=mysqli_connect($servername,$username,$password);
        if(!$this->con)
        {
            die("error".mysqli_connect_error());
        }

        #query to create a database
        $sql="create database if not exists $dbname";

        #execute query
        if(mysqli_query($this->con, $sql))
        {
            $this->con=mysqli_connect($servername,$username,$password,$dbname);

            #query to create a table
            $sql="create table if not exists $tablename
                    (id int(10) not null auto_increment primary key,
                    product_name varchar(25) not null,
                    product_price float,
                    product_image varchar(199));";
            if(!mysqli_query($this->con,$sql))
            {
                echo "error".mysqli_error($this->con);
            }
            else
            {
                $que="insert into products (product_name,product_price,product_image) values('one plus',37000,'./upload/iphone.png');";
                $exe=mysqli_query($this->con,$que);
            }
        }
    }

    #get product from database
    public function getData()
    {
        $sql="select * from ".$this->tablename;
        $result=mysqli_query($this->con, $sql);

        if(mysqli_num_rows($result) > 0)
        {
            return $result;
        } 

    }
}
?>