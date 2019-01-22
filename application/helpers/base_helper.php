<?php 

		function police_xzqh(){
			return XZQH.'%';
		}


	 //oracle连接  道路代码用的都是这个连接
        function oracle_connection(){
            // $username = passport_decrypt('UW4FclclVyhUagE0',1);
            // $pwd = passport_decrypt('UW4FclclVyhUagE0',1);
            // $address = passport_decrypt('VG9SPwBlVjxUaVBjC2UAeQUlVnkNcFxh',1);
            $username = 'veh_info';
            $pwd = 'vehinfo20140708';
            $address = '//10.172.134.87/sxjgogg';
            $conn = oci_connect($username, $pwd, $address, 'UTF8');
            return $conn;
        }


        //oracle连接，  违法行为中极其个别用的是这个连接。
        function oracle_connection1(){
        	// $username = passport_decrypt('UW4FclclVyhUagE0',1);
         //    $pwd = passport_decrypt('UW4FclclVyhUagE0',1);
         //    $address = passport_decrypt('VG9SPwBlVjxUaVBjC2UAeQUlVnkNcFxh',1);
            $username = 'trff_app';
            $pwd = 'password123';
            $address = '//10.176.133.3/slffdb';
            $conn = oci_connect($username, $pwd, $address, 'UTF8');
            return $conn;
        }


		/*
		*功能：对字符串进行  加密处理
		*参数一：需要加密的内容
		*参数二：密钥
		*/
		function passport_encrypt($str,$key){ //加密函数
			srand((double)microtime() * 1000000);
			$encrypt_key = md5(rand(0, 32000));
			$ctr = 0;
			$tmp = '';
			for($i = 0;$i < strlen($str); $i++){
				$ctr = $ctr == strlen($encrypt_key)?0:$ctr;
				$tmp .= $encrypt_key[$ctr].($str[$i] ^ $encrypt_key[$ctr++]);
			}
			return base64_encode(passport_key($tmp,$key));
		}

		/*
		*功能：对字符串进行  解密处理
		*参数一：需要解密的密文
		*参数二：密钥
		*/
		 function passport_decrypt($str,$key){ //解密函数
			$str = passport_key(base64_decode($str),$key);
			$tmp = '';
			for($i = 0; $i<strlen($str); $i++){
				$md5 = $str[$i];
				$tmp .= $str[++$i] ^ $md5;
			}
			return $tmp;
		}


		/*
		 * 加密的辅助函数。
		 *辅助函数
		 */
		function passport_key($str,$encrypt_key){
			$encrypt_key = md5($encrypt_key);
			$ctr = 0;
			$tmp = '';
			for($i = 0;$i < strlen($str); $i++){
				$ctr =$ctr == strlen($encrypt_key)?0:$ctr;
				$tmp .= $str[$i] ^ $encrypt_key[$ctr++];
			}
			return $tmp;
		}
	
?>