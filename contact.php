<?php
    header("Content-type: text/html; charset=utf-8");
    //**********************************************
    if(empty($_POST['js'])){
    
        $log =="";
        $error="no"; //флаг наличия ошибки
        
        		$user_name = addslashes($_POST['user_name']);
        		$user_name = htmlspecialchars($user_name);
        		$user_name = stripslashes($user_name);
        		$user_name = trim($user_name);
        		
        		$user_email = addslashes($_POST['user_email']);
        		$user_email = htmlspecialchars($user_email);
        		$user_email = stripslashes($user_email);
        		$user_email = trim($user_email);
        
        		$user_phone = addslashes($_POST['user_phone']);
        		$user_phone = htmlspecialchars($user_phone);
        		$user_phone = stripslashes($user_phone);
        		$user_phone = trim($user_phone);
        
         		$ff_message = addslashes($_POST['ff_message']);
        		$ff_message = htmlspecialchars($ff_message);
        		$ff_message = stripslashes($ff_message);
        		$ff_message = trim($ff_message);
                
         	 
        //Проверка правильность имени    
        if(!$user_name || strlen($user_name)>30 || strlen($user_name)<3) {
        $log.="<li>Неправильно заполнено поле <strong>\"Ваше имя\"</strong> (3-30 символов)</li>"; $error="yes"; }
        
        
        //Проверка правильности телефона
        if(!$user_phone || strlen($user_phone)>16 || strlen($user_phone)<10 || !preg_match("/(?:8|\+7)? ?\(?(\d{3})\)? ?(\d{3})[ -]?(\d{2})[ -]?(\d{2})/",$user_phone)) {
        $log.="<li>Неправильно заполнено поле <strong>\"Телефон\"</strong> (10-16 символов)</li>"; $error="yes"; }
                    
        //Проверка email адреса
        function isEmail($user_email){
            return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i"
            ,$user_email));
        } 
        
        if($user_email == '') {
            $log .= "<li>Пожалуйста, введите <strong>Ваш E-mail</strong></li>";
        	$error = "yes";
        }			
        
        else if(!isEmail($user_email)){
            $log .= "<li>Вы ввели неправильный <strong>e-mail</strong>. Пожалуйста, исправьте его</li>";
        	$error = "yes";
        }
        
        if($ff_message == ''){
            $log .= "<li>Вы не можете отправить пустое сообщение. Введи текст своего послания. Или покиньте сайт. Навсегда.</li>";
            $error = "yes";
                        }
          
        //Если нет ошибок отправляем email  
        if($error=="no"){
            //Отправка письма админу о новом комментарии
            $to = "slavikaremenko@gmail.com";//Ваш e-mail адрес
            $message = " Сообщения: $ff_message <br><br> Имя: $user_name  <br><br> Телефон: $user_phone <br><br> E-mail: $user_email" ;
            $from = $user_email;
            $subject = '=?utf-8?B?'.base64_encode('Сообщение с di-grand.com').'?=';
            $headers = "Content-type: text/html; charset=UTF-8 \r\n";
            $headers .= 'From: digrand@test.ru';
            mail($to, $subject, $message, $headers);
            echo "1"; //Всё Ok!
        }
        else { 
        		echo "<div class='messenger_error'><span>Ошибка</span><ol>".$log."</ol></div><br />"; //Нельзя отправлять пустые сообщения
        
        }
    }
?>