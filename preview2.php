<?php
     // DB接続設定
 $dsn = 'mysql:dbname=tb220242db;host=localhost';
 $user = 'tb-220242';
 $password = 'N95N7ba6UV';
 $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>edit</title>
        <link rel="stylesheet" href="editer.css">
    </head>
    <body>
        <header>
            <div class="container">
                <div class="header-left">
                    <h1>ブログプレビュー画面</h1>
                </div>
                <div class="header-right">
                    <a href="edit2.php">ホームに戻る</a>
                </div>
            </div>    
        </header>
        <div class="top-wrapper">
            <div class="container">
            <?php  
                $sql = "CREATE TABLE IF NOT EXISTS edit5"
                ." ("
                . "id INT AUTO_INCREMENT PRIMARY KEY,"
                . "title TEXT,"
                . "comment TEXT,"
                . "created DATETIME"
                .");";
                $stmt = $pdo->query($sql);
                $date=date("Y-m-d H:i:s");
                //新規投稿
                if(isset($_POST["submit"])
                    &&!empty($_POST["title"])
                    &&!empty($_POST["main"])){
                        $title=$_POST["title"];
                        $main=$_POST["main"];
                            $stmt = $pdo->query($sql);
                        $sql = $pdo -> prepare("INSERT INTO edit5 (title, comment,created) 
                        VALUES (:title, :comment, :created)");
                        $sql -> bindParam(':title', $title, PDO::PARAM_STR);
                        $sql -> bindParam(':comment', $main, PDO::PARAM_STR);
                        $sql -> bindParam(':created', $date, PDO::PARAM_STR);
                        $sql -> execute();
                    }
                $sql = 'SELECT * FROM edit5';
                $stmt = $pdo->query($sql);
                $results = $stmt->fetchAll();
                    foreach ($results as $row){
                    //$rowの中にはテーブルのカラム名が入る
                        echo $row['title'].' ';
                        echo $row['created'].'<br>';
                        echo nl2br($row['comment']).' ';
                        echo "<hr>";
                        }    
            ?>
            </div>
        </div>
        
            
    </body>
    </html>