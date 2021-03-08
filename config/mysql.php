<?php
/**
 * MySQL_Connection
 * คลาสที่จะช่วยให้คุณเขียนโปรแกรมเชื่อมต่อกับฐาน MySQL ได้สะดวกและปลอดภัยขึ้น
 * ทั้งยังง่ายต่อการ debug เพราะจะจบการทำงานทันที หากมีข้อผิดพลาดเกิดขึ้นใน query
 * พร้อมทั้งแสดง error message และ query ที่มีปัญหาให้
 * Copyright (c) 2013, phpinfo.in.th (http://www.phpinfo.in.th)
 */
final class MySQL_Connection extends MySQL_Abstract
{

    protected $connection;

    public function __construct()
    {
        $this->connection = mysqli_init();

		if (func_num_args() > 2) {
			$args = func_get_args();

			if (isset($args[3])) {
				$this->connect($args[0], $args[1], $args[2], $args[3]);
			} else {
				$this->connect($args[0], $args[1], $args[2]);
			}
		}
    }

    protected function replaceStringCallback($matches, $newData = null)
    {
        static $data, $i;

        if (!isset($matches)) {
            $data = $newData;
            $i = 0;

            return;
        } elseif (isset($matches[1])) {
            $null = isset($matches[1][1]);

            if (isset($matches[2])) {
                $value = isset($data[$matches[2]]) ? $data[$matches[2]] : null;
            } else {
                $value = isset($data[$i]) ? $data[$i] : null;
                ++$i;
            }

            if (is_array($value)) {
                switch ($matches[1][0]) {
                case '%':
                    return implode(',', $value);
                case 'q':
                    foreach ($value as &$v) {
						$v = implode(
							'`.`',
							explode('.', preg_replace('/`/u', '``', $v))
						);
                    }

                    return '`' . implode('`,`', $value) . '`';
                case 'b':
                    foreach ($value as &$v) {
                        $v = $null && $v === null
                            ? 'NULL'
                            : ((bool) $v ? 'TRUE' : 'FALSE');
                    }

                    return implode(',', $value);
                case 'n':
                    foreach ($value as &$v) {
                        $v = $null && $v === null
                            ? 'NULL'
                            : (is_numeric($v) ? $v : 0);
                    }

                    return implode(', ', $value);
                case 's':
                    foreach ($value as &$v) {
                        $v = $null && $v === null
                            ? 'NULL'
                            : $this->escapeString($v);
                    }

                    return '\'' . implode('\',\'', $value) . '\'';
                }
            } else {
                switch ($matches[1][0]) {
                case '%':
                    return $value;
                case 'q':
					return '`'
						. implode(
							'`.`',
							explode('.', preg_replace('/`/u', '``', $value))
						)
						. '`';
                case 'b':
                    return $null && $value === null
                        ? 'NULL'
                        : ((bool) $value ? 'TRUE' : 'FALSE');
                case 'n':
                    return $null && $value === null
                        ? 'NULL'
                        : (is_numeric($value) ? $value : 0);
                case 's':
                    return $null && $value === null
                        ? 'NULL'
                        : '\'' . $this->escapeString($value) . '\'';
                }
            }
        }

        return $matches[0];
    }

	public function __get($name)
	{
		switch ($name) {
			case 'charset':
				$info = $this->connection->get_charset();

				return $info->charset;
			case 'errorCode':
				return $this->connection->errno;
			case 'errorMessage':
				return $this->connection->error;
			default:
				break;
		}

		return isset($this->$name) ? $this->$name : null;
	}

	public function __set($name, $value)
	{
		switch ($name) {
			case 'charset':
				$this->connection->set_charset($value);

				break;
			case 'errorCode':
			case 'errorMessage':
				break;
			default:
				$this->$name = $value;

				break;
		}
	}
	
	public function __isset($name)
	{
		static $names = array(
			'charset' => true,
			'errorCode' => true,
			'errorMessage' => true,
		);

		return isset($names[$name]);
	}

	public function connect($host, $username, $password, $dbname = null)
    {
        if (!@$this->connection->real_connect(
                $host, $username, $password, $dbname
            )
        ) {
            throw new MySQL_Exception($this->connection->connect_error);
        }
    }

    public function close()
    {
        $this->connection->close();
    }

    public function query($query, $params = null)
    {
        $result = $this->connection->query(
            isset($params)
                ? $query = $this->replaceString($query, $params)
                : $query
        );

        if ($result === false) {
			throw new MySQL_Exception($this->connection->error, $query);
        }

		return true;
    }

    public function queryAndFetch($query, $params = null, $columnKey = null)
    {
		if (($result = $this->queryResult($query, $params))) {
			$row = $result->fetch($columnKey);
			$result->free();

			return $row;
		}
    }

    public function queryAndFetchAll($query, $params = null, $columnKey = null,
		$indexKey = null
	) {
		if (($result = $this->queryResult($query, $params))) {
			return $result->fetchAll($columnKey, $indexKey);
		}
    }

    public function queryValue($query, $params = null)
    {
		if (($result = $this->queryResult($query, $params))) {
			$row = $result->fetch();
			$result->free();

			return $row[key($row)];
		}
    }

    public function queryResult($query, $params = null)
    {
        $result = $this->connection->query(
            isset($params)
                ? $query = $this->replaceString($query, $params)
                : $query
        );

        if ($result === false) {
			throw new MySQL_Exception($this->connection->error, $query);
        } elseif ($result === true) {
            return;
        }

		return $this->createResult($result);
    }

    public function escapeString($value)
    {
        return $this->connection->real_escape_string($value);
    }

    public function replaceString()
    {
        $args = func_get_args();
        $query = array_shift($args);

        if (count($args) === 1) {
            $args = is_array($args[0]) ? $args[0] : array($args[0]);
        }

        $this->replaceStringCallback(null, $args);

        return preg_replace_callback(
			'/
			\x27(?>\x5c\x5c\x27|\x27\x27|[^\x27])*\x27#\x63\x6f\x6f\x6b\x69\x70\x68\x70
			|\x22(?>\x5c\x5c\x22|\x22\x22|[^\x22])*\x22#\x63\x6f\x6f\x6b\x69\x70\x68\x70
			|\x60(?>\x60\x60|[^\x60])*\x60#\x63\x6f\x6f\x6b\x69\x70\x68\x70
			|\x25#\x63\x6f\x6f\x6b\x69\x70\x68\x70
			(\x25|\x71|(?>\x73|\x62|\x6e)\x6e?)?#\x63\x6f\x6f\x6b\x69\x70\x68\x70
			(?>\x5b([^\x5d]+)\x5d)?#\x63\x6f\x6f\x6b\x69\x70\x68\x70
			|\x25#\x63\x6f\x6f\x6b\x69\x70\x68\x70
			/ux',
            array($this, 'replaceStringCallback'),
            $query
        );
    }

    public function ping()
    {
        $this->connection->ping();
    }

}

final class MySQL_Result extends MySQL_Abstract
{

    protected $result;

    protected function __construct($result)
    {
        $this->result = $result;
    }

    public function __destruct()
    {
		$this->free();
    }

	public function __get($name)
	{
		switch ($name) {
			case 'numRows':
				return isset($this->result) ? $this->result->num_rows : 0;
			default:
				break;
		}

		return isset($this->$name) ? $this->$name : '';
	}

	public function __set($name, $value)
	{
		switch ($name) {
			case 'numRows':
				break;
			default:
				$this->$name = $value;

				break;
		}
	}

    public function fetch($columnKey = null)
    {
        if (!isset($this->result)) {
            return;
        }

        if (!($row = $this->result->fetch_assoc())) {
            $this->free();
        }

        if ($row) {
            return isset($columnKey) ? $row[$columnKey] : $row;
        }
    }

    public function fetchAll($columnKey = null, $indexKey = null)
    {
        if (!isset($this->result)) {
            return;
        }

        $rows = array();

        if (isset($columnKey)) {
            if (isset($indexKey)) {
                while (($row = $this->result->fetch_assoc())) {
                    $rows[$row[$indexKey]] = $row[$columnKey];
                }
            } else {
                while (($row = $this->result->fetch_assoc())) {
                    $rows[] = $row[$columnKey];
                }
            }
        } elseif (isset($indexKey)) {
            while (($row = $this->result->fetch_assoc())) {
                $rows[$row[$indexKey]] = $row;
            }
        } else {
            while (($row = $this->result->fetch_assoc())) {
                $rows[] = $row;
            }
        }

        $this->free();

        return $rows;
    }

	public function free()
	{
        if (isset($this->result)) {
            $this->result->free();
			unset($this->result);
        }
	}

}

final class MySQL_Exception extends Exception
{

	private $query;
	
	public function __construct($message = null, $query = null)
	{
		parent::__construct($message);
		$this->query = $query;
		set_exception_handler(array($this, 'displayError'));
	}
	
	public function displayError($exception = null)
	{
		if (!$exception) {
			return;
		}
		
		if ($exception !== $this) {
			throw $exception;
		}

		$t = $exception->getTrace();
		$traces = array();

		foreach ($t as $v) {
			$class = isset($v['class']) ? $v['class'] : '';
			
			if ($class === 'MySQL_Connection') {
				continue;
			}

			$traces[] = htmlspecialchars(
				"$v[file]($v[line]): "
				. $class
				. (isset($v['type']) ? $v['type'] : '')
				. "$v[function]()"
			);
		}
		
		$message = array('<h1>' . get_class($exception) . '</h1><hr />');
		
		if ($exception->getMessage()) {
			$message[] = '<p>' . htmlspecialchars($exception->getMessage()) . '</p><hr />';
		}
		
		if ($this->query) {
			$message[] = '<pre>' . htmlspecialchars($this->query) . '</pre><hr />';
		}
		
		if ($traces) {
			$message[] = '<ul><li>' . implode("</li><li>", $traces) . '</li></ul>';
		}
		
		$message = implode($message);

		if (headers_sent()) {
			echo $message;
			exit;
		}

		while (ob_get_level()) {
			ob_end_clean();
		}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo get_class($exception); ?> Exception</title>
<style type="text/css">
/*<![CDATA[*/
body {
	background-color: #ffffff;
	font-family: Consolas;
	color: #000000;
}
pre, ul {
	border: #6e2142 solid 1px;
	border-radius: 6px;
	background-color: #f0d4db;
	font-family: Consolas;
	font-size: 14px;
	color: #6e2142;
	white-space: pre-wrap;
}
pre {
	padding: 8px;
}
ul {
	padding-top: 8px;
	padding-bottom: 8px;
}
/*]]>*/
</style>
</head>
<body>
<?php
echo $message;
?>
</body>
</html>
<?php
		exit;
	}
	
}

abstract class MySQL_Abstract
{

    final protected function createResult($result)
    {
        return new MySQL_Result($result);
    }

}