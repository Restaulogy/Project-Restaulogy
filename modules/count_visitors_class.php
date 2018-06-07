<?php 

	/*
	+--------------------------------------------------------------------------
	|   Auth Manager - Content Protection & User Management (Open Source)
	+--------------------------------------------------------------------------
	|   by ScriptsApart
	|   (c) 2011 ScriptsApart
	|   http://www.scriptsapart.com/
	+--------------------------------------------------------------------------
	|   Web: http://www.scriptsapart.com/
	|   Email: support@scriptsapart.com
	|	Facebook: http://www.facebook.com/pages/Scripts-Apart/149933518360387
	|	Twitter: http://www.twitter.com/scriptsapart
	|	Blackberry PIN: 20F03848
	|	Phone Support: +91 9871084893
	+--------------------------------------------------------------------------
	|   > Open Source(100%)
	|   > First Version: 13th September 2010
	|	> Version 2.0: 8th February 2011
	+--------------------------------------------------------------------------
	*/

class Count_visitors {

	var $table_name = DB_TABLE;
	var $referer;
	var $host;
	var $delay = 1;
	var $report_by_host = true;
	
	// niet vergeten visits ouder dan een jaar te verwijderen
	function Count_visitors() {
		$this->referer = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "";
		$this->host = "www.".ltrim($_SERVER['HTTP_HOST'], "www.");
		$this->db_connect();
	}
	function db_connect() {
		mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());
		mysql_select_db(DB_NAME);
	}
	function check_last_visit() {
		$check_sql = sprintf("SELECT time + 0 FROM %s WHERE visit_date = CURDATE() AND ip_adr = '%s' ORDER BY time DESC LIMIT 0, 1", $this->table_name, $_SERVER['REMOTE_ADDR']);
		$check_visit = mysql_query($check_sql);
		$check_row = mysql_fetch_array($check_visit);
		if (mysql_num_rows($check_visit) != 0) {
			$last_hour = date("H") - $this->delay; 
			$check_time = date($last_hour."is");
			if ($check_row[0] < $check_time) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
	// new
	function indentify_crawlers($crawler_name) {
		if (preg_match("/".$crawler_name."/", $_SERVER['HTTP_USER_AGENT'])) {
			return true;
		} else {
			return false;
		}	
	}
	
	function get_country() {
		$country_sql = sprintf("SELECT country FROM %s WHERE ip < INET_ATON('%s') ORDER BY ip DESC LIMIT 0,1", IP_TABLE, $_SERVER['REMOTE_ADDR']);
		$country_res = mysql_query($country_sql);
		$country = mysql_result($country_res, 0, "country");
		return $country;
	}
	
	function insert_new_visit() {
		if ($this->check_last_visit()) {
			$insert_sql = sprintf("INSERT INTO %s (id, ip_adr, referer, country, client, visit_date, time, on_page, hostname) VALUES (NULL, '%s', '%s', '%s', '%s', CURDATE(), CURTIME(), '%s', '%s')", $this->table_name, $_SERVER['REMOTE_ADDR'], $this->referer, $this->get_country(), $_SERVER['HTTP_USER_AGENT'], $_SERVER['PHP_SELF'], $this->host);
			mysql_query($insert_sql);
		}
	}
	function show_all_visits() {
		$sql = "SELECT COUNT(*) AS count FROM ".$this->table_name;
		if ($this->report_by_host) $sql .= " WHERE hostname = '".$this->host."'"; 
		$result = mysql_query($sql);
		$visits = mysql_result($result, 0, "count");
		return $visits;
	}
	function show_visits_today() { //
		$sql_today = sprintf("SELECT COUNT(*) AS count FROM %s WHERE visit_date = NOW()", $this->table_name);
		if ($this->report_by_host) $sql_today .= " AND hostname = '".$this->host."'"; 
		$res_today = mysql_query($sql_today);
		$today = mysql_result($res_today, 0, "count");
		return $today;
	}
	function show_max_visited_day() {
		$sql_max = "SELECT COUNT(*) AS count FROM ".$this->table_name;
		if ($this->report_by_host) $sql_max .= " WHERE hostname = '".$this->host."'"; 
		$sql_max .= " GROUP BY visit_date ORDER BY count DESC";
		$res_max = mysql_query($sql_max);
		return mysql_result($res_max, 0, "count");
	}
	function average_visits_day($month, $year) {
		$data = $this->results_by_day($month, $year);
		$totals = array_sum($data);
		$days = count($data);
		if($days) {
			$avg = ceil($totals / $days);
		}
		else
		{
			$avg = 0;
		}
		return $avg;
	}
	function first_last_visit($type = "last") { 
		$order_dir = ($type == "last") ? "DESC" : "ASC";
		$sql = "SELECT visit_date, time FROM ".$this->table_name;
		if ($this->report_by_host) $sql .= " WHERE hostname = '".$this->host."'"; 
		$sql .= " ORDER BY visit_date ".$order_dir." LIMIT 0,1";
		$result = mysql_query($sql);
		$first_last = mysql_result($result, 0, "visit_date");
		$first_last .= " ".mysql_result($result, 0, "time");
		return $first_last;
	}
	function results_by_day($res_month, $res_year) { 
		$sql = sprintf("SELECT DAYOFMONTH(visit_date) AS visit_day, COUNT(*) AS visits_count FROM %s WHERE MONTH(visit_date) = %s AND YEAR(visit_date) = %s", $this->table_name, $res_month, $res_year);
		if ($this->report_by_host) $sql .= " AND hostname = '".$this->host."'"; 
		$sql .= " GROUP BY visit_date";
		$result = mysql_query($sql);
		$visits_daily = array();
		while ($obj = mysql_fetch_object($result)) {
			$visits_daily[$obj->visit_day] = $obj->visits_count;
		}
		return $visits_daily;
	}
	function get_data_array($what, $limit = 0) {
		$is_year = false;
		switch ($what) {
			case "monthly":
			$is_year = true;
			$sql = sprintf("SELECT MONTH(visit_date) AS variable, YEAR(visit_date) AS month_year, COUNT(*) AS value FROM %s 
			WHERE UNIX_TIMESTAMP(visit_date) >= %d ", $this->table_name, mktime(0, 0, 0, date("m"), 1, date("Y")-1));
			if ($this->report_by_host) $sql .= " AND hostname = '".$this->host."'"; 
			$sql .= " GROUP BY MONTH(visit_date), YEAR(visit_date) ORDER BY MONTH(visit_date)";
			break;
			case "country":
			$sql = sprintf("SELECT ip_country.country AS variable, COUNT(*) AS value FROM %s AS tbl LEFT JOIN %s AS ip_country ON ip_country.code = tbl.country WHERE tbl.country <> ''", $this->table_name, IP_COUNTRY_TABLE);
			if ($this->report_by_host) $sql .= " AND hostname = '".$this->host."'"; 
			$sql .= " GROUP BY tbl.country ORDER BY value DESC LIMIT 0, ".$limit;
			break;
			case "referer":
			$sql = sprintf("SELECT COUNT(*) AS value, TRIM(LEADING 'www.' FROM SUBSTRING_INDEX(TRIM(LEADING 'http://' FROM referer), '/', 1)) AS variable FROM %s WHERE referer <> '' AND referer NOT LIKE '%s%%'", $this->table_name, ltrim($this->host, "www."));
			if ($this->report_by_host) $sql .= " AND hostname = '".$this->host."'"; 
			$sql .= " GROUP BY variable ORDER BY value DESC LIMIT 0, ".$limit;
			break;
		}
		$result = mysql_query($sql);
		$data = array();
		while ($obj = mysql_fetch_object($result)) {
			$data[$obj->variable] = $obj->value;
		}
		mysql_free_result($result);
		return $data;
	}
	function get_days($from_month, $from_year) {
		$last_day = date("t", mktime(0,0,0,$from_month,1,$from_year));
		$day_count = 1;
		while ($day_count <= $last_day) {
			$days_array[] = $day_count;
			$day_count++;
		}
		return $days_array;
	}
	function create_date($month2, $year2) {
		$date_str = date ("M y", mktime (0,0,0,$month2,0,$year2)); 
		return $date_str;
	}
	function month_last_year() {
		$i = 0;
		$curr_year = date("Y");
		$curr_month = date("n");
		while ($i < 12) {
		    $time_val = mktime(0,0,0,$curr_month,15,$curr_year);
			$twelve_month[] = date("n", $time_val)."|".date("Y", $time_val);
			$curr_month = $curr_month-1;
			$curr_year = ($curr_month == 12) ? $curr_year-1 : $curr_year;
			$i++;
		}
		return $twelve_month;
	}	
	function build_rows_totals($array_labels, $array_values, $is_date = false) {
		$all_values = array_sum($array_values);
		$row = "";
		foreach($array_labels as $key) {
			if ($is_date) {
				$parts = explode("|", $key);
				$key = $parts[0];
				$year = $parts[1];
			}		
			if (isset($array_values[$key])) {
				$row .= "  <tr>\n";
				$row .= "	   <td>".$key."</td>\n";			
				$width = ($array_values[$key]*100)/$all_values;
				$row .= "	   <td><img src=\"".IMG."\" width=\"".round($width*3, 0)."\" height=\"10\"></td>\n";
				$row .= "	   <td>".$array_values[$key]."</td>\n";
				if ($is_date) $row .= "	   <td>".$this->average_visits_day($key, $year)."</td>\n";	
				$row .= "  </tr>\n";
			}
		}
		return $row;
	}
	function stats_totals() {
		$month_array = $this->month_last_year();
		krsort($month_array);
		reset($month_array);
		$all_visits_month = $this->get_data_array("monthly");
		$total_tbl = "<h2>Visits last ".count($all_visits_month)." month</h2>\n";
		$total_tbl .= "<table>\n";
		$total_tbl .= "  <tr>\n";
		$total_tbl .= "    <th>Month</th>\n";
		$total_tbl .= "    <th>&nbsp;</th>\n";
		$total_tbl .= "    <th>Visits</th>\n";
		$total_tbl .= "    <th>Daily average</th>\n"; 
		$total_tbl .= "	 </tr>\n";
		$total_tbl .= $this->build_rows_totals($month_array, $all_visits_month, true);
		$total_tbl .= "</table>\n";
		return $total_tbl;
	}
	function stats_country($limit = 10) {
		$country_visits = $this->get_data_array("country", $limit);
		$country_array = array_keys($country_visits);
		$country_tbl = "<h2>Visits by country (Top ".count($country_array).")</h2>\n";
		$country_tbl .= "<table>\n";
		$country_tbl .= "  <tr>\n";
		$country_tbl .= "    <th>Month</th>\n";
		$country_tbl .= "    <th>&nbsp;</th>\n";
		$country_tbl .= "    <th>Visits</th>\n";
		$country_tbl .= "	 </tr>\n";
		$country_tbl .= $this->build_rows_totals($country_array, $country_visits);
		$country_tbl .= "</table>\n";
		return $country_tbl;
	}
	function stats_top_referer($limit = 15) {
		$referer_domains = $this->get_data_array("referer", $limit);
		$domain_array = array_keys($referer_domains);
		$refer_tbl = "<h2>Visits by Referer (Top ".count($domain_array).")</h2>\n";
		$refer_tbl .= "<table>\n";
		$refer_tbl .= "  <tr>\n";
		$refer_tbl .= "    <th>Referer domain</th>\n";
		$refer_tbl .= "    <th>&nbsp;</th>\n";
		$refer_tbl .= "    <th>Visits</th>\n";
		$refer_tbl .= "	 </tr>\n";
		$refer_tbl .= $this->build_rows_totals($domain_array, $referer_domains);
		$refer_tbl .= "</table>\n";
		return $refer_tbl;
	}
	function stats_monthly($month, $year, $max_height = 200) {
		$my_visits = $this->results_by_day($month, $year);
		$month_tbl = "<graph caption=\"Daily Traffic Statistics\" xAxisName=\"Days\" yAxisName=\"Visitors\" showNames=\"1\" decimalPrecision=\"0\" formatNumberScale=\"0\">";
		$cc = 0;
		foreach($this->get_days($month, $year) as $day) {
			if(isset($my_visits[$day])) {
				$month_tbl .= "<set name=\"{$day}\" value=\"{$my_visits[$day]}\" color=\"1a1a1a\" />";
				$cc++;
			} else {
				$month_tbl .= "<set name=\"{$day}\" value=\"0\" color=\"1a1a1a\" />";
			}
		}
		$month_tbl .= "</graph>";
		
		if($cc == 0)
		{
			$month_tbl = "<graph caption=\"Daily Traffic Statistics\" xAxisName=\"Days\" yAxisName=\"Visitors\" showNames=\"1\" decimalPrecision=\"0\" formatNumberScale=\"0\"></graph>";
		}
		return $month_tbl;
	}
}
?>