<?php
class Service{
    
    static private $_storage = array();
    static private $_storage_cache = array(); //for future
    
    private function __construct(){}
    
    /**
     * set ini file to storage
     * @param String $ini_file valid path to .ini file
     */
    public static function setIni($ini_file){
            
        self::$_storage = parse_ini_file($ini_file, TRUE);

    }
    
    /**
     * get value from configuration file
     * @param String $key ei. 'application.layout'
     * @return mixed value if found, False if none
    */
    public static function get($key, $create = false){
        
        $_storage_cache = self::$_storage_cache;
        
		if (!isset($_storage_cache[$key])) {
			$null = NULL;
			if (strpos($key, '.') !== false) {
				$parts = explode('.', $key);
				$part = array_shift($parts);
				if (empty(self::$_storage[$part])) {
					if ($create == true) {
						self::$_storage[$part] = array();
					} else {
						$_storage_cache[$key] = $null;
						return $null;
					}
				}

				$piece = & self::$_storage[$part];
				foreach ($parts as $part) {
					if (!is_array($piece)) {
						if ($create == true) {
							$piece = array();
						} else {
							$_storage_cache[$key] = $null;
							return $null;
						}
					}

					$piece = & $piece[$part];
				}
				
				$_storage_cache[$key] = $piece;
				return $piece;
			}
		} else {
			return $_storage_cache[$key];
		}

		if (!isset(self::$_storage[$key]) && $create == true) {
			self::$_storage[$key] = array();
		} 

		return self::$_storage[$key];
    }
    
    /**
     * return the classname of a file
     * @param String $file_path path to file
     */
    public static function getClassName($file_path){
        
        $fp = fopen($file_path, 'r');
        $class = $buffer = '';
        
        if ($fp) {
            
            $i = 0;
            while (!$class) {
                if (feof($fp)) break;
            
                $buffer .= fread($fp, 512);
                $tokens = token_get_all($buffer);
            
                if (strpos($buffer, '{') === false) continue;
            
                for (;$i<count($tokens);$i++) {
                    if ($tokens[$i][0] === T_CLASS) {
                        for ($j=$i+1;$j<count($tokens);$j++) {
                            if ($tokens[$j] === '{') {
                                $class = $tokens[$i+2][1];
                            }
                        }
                    }
                }
            }
            
            fclose($fp);
            
        }        
        
        return $class;
    }
    
    function dump(){
        
        static $count = 0;
        $args = func_get_args();
    
        if (!empty($args)) {
            echo '<ol style="font-family: Courier; font-size: 12px; border: 1px solid #dedede; background-color: #efefef; float: left; padding-right: 20px;">';
            foreach ($args as $k => $v) {
                $v = htmlspecialchars(print_r($v, true));
                if ($v == '') {
                    $v = '    ';
                    
                if (is_bool($v))
                    $v = ($v) ? 'TRUE' : 'FALSE';
            }
    
                echo '<li><pre>' . $v . "\n" . '</pre></li>';
            }
            echo '</ol><div style="clear:left;"></div>';
        }
        $count++;
        
        exit;
        
    }
}