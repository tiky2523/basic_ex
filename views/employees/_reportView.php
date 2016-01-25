<?php

use app\models\Employees;
use app\models\Departments;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container" style="padding-left: 50px; font-size:15pt;">
            <div>
               <img src="images/logos.jpg" width="75" height="71" class="pull-left" style="margin-top: 1px;">
                <div style="margin-left: 200px;">
                    <strong style="font-size:21pt;  ">รายชื่อสมาชิก</strong>
                </div>
            </div>
            <div>
                <br>
                <table class="table" style="font-size:15pt; ">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td><strong>คำนำหน้า</strong></td>
                            <td><strong>ชื่อ</strong></td>
                             <td><strong>สกุล</strong></td>
                            <td><strong>ฝ่าย/แผนก</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach (Employees::find()->where(['id' => $model->id])->all() as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                                           
                                <td style="text-align:left"><?= $row->pname; ?></td>    
                                <td style="text-align:left"><?= $row->fname;?></td>
                                <td style="text-align:left"><?= $row->lname; ?></td> 
                                <td style="text-align:left"><?= $row->depart->name;?> </td>
                               
                            </tr>                            
                        <?php endforeach; ?>                            
                    </tbody>                    
                </table>               
                <hr>
               <br><br>
            </div>
        </div>
    </body>
</html>




