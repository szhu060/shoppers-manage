<?php
/**
 * Created by PhpStorm.
 * User: shizhu
 * Date: 2018-04-12
 * Time: 11:27 PM
 */

echo "exist!";

class shop {

    public function indexMethod(){
        return "item index action is working";
    }

    /* Method: POST
         * URL : manage/add
         *
         * Request body format
         * request - post:
         *
         *{
         *	"gname" : "<h1> name</h1>",
         *  "gprice" : "24.9",
         *  "gimage_url" : "var1;var2",
         *  "gdescription" : "those are good for kids."
         *}
         * will return format:json
         * {
         *	"code":200,
         *	"message":"success"
         * }
         */

    public function addMethod(){
        $goodsname = $_POST['gname'];
        $goodsprice = $_POST['gprice'];
        $goodsimage_url = $_POST['gimage_url'];
        $goodsdescription = $_POST['gdescription'];

        $conn = new DBConnection();
        $result = $conn->addToStore($goodsname, $goodsprice, $goodsimage_url, $goodsdescription);

        if($result){
            return json_encode(array(
                'code' => 200,
                'message' => "item add successfully, please check your mysql."
            ));
        }else{
            return json_encode(array(
                'code' => 500,
                'message' => "item add fail"
            ));
        }
    }


    /*
    * Request body format
    * Method :GET
    * url: shop/all
    * will: return:json
    * [
    *	{
    *		"gid" : 1,
    *		"gname" : "shirt",
    *		"gprice" : "29.9",
    *  		"gimage_url" : "var1;var2",
     *      "gdescription" : "this is good-looking"
    *	},
    *	{
    *		"gid" : 2,
    *		"gname" : "dress",
    *		"gprice" : "25.9",
    *  		"gimage_url" : "var2;var3",
    *       "gdescription" : "this is very good-looking"
    *	}
    * ]
    */

    public function allMethod(){
        $conn = new DBConnection();
        $results = $conn->getAllStoregoods();

        if($results){
            return json_encode($results);
        }else{
            return json_encode(array(
                'code' => 400,
                'message' => "no template exists"
            ));
        }
    }

    public function itemMethod($id){
        $conn = new DBConnection();
        $results = $conn->getGoodsById($id);

        if($results){
            return json_encode($results);
        }else{
            return json_encode(array(
                'code' => 400,
                'message' => "no template exists"
            ));
        }
    }



}

?>