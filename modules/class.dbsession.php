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

class dbSession
{

    /**
     *  Constructor of class
     *
     *  Initializes the class and starts a new session
     *
     *  There is no need to call start_session() after instantiating this class
     *
     *  @param  integer     $gc_maxlifetime     (optional) the number of seconds after which data will be seen as 'garbage' and
     *                                          cleaned up on the next run of the gc (garbage collection) routine
     *
     *                                          Default is specified in php.ini file
     *
     *  @param  integer     $gc_probability     (optional) used in conjunction with gc_divisor, is used to manage probability that
     *                                          the gc routine is started. the probability is expressed by the formula
     *
     *                                          probability = $gc_probability / $gc_divisor
     *
     *                                          So if $gc_probability is 1 and $gc_divisor is 100 means that there is
     *                                          a 1% chance the the gc routine will be called on each request
     *
     *                                          Default is specified in php.ini file
     *
     *  @param  integer     $gc_divisor         (optional) used in conjunction with gc_probability, is used to manage probability
     *                                          that the gc routine is started. the probability is expressed by the formula
     *
     *                                          probability = $gc_probability / $gc_divisor
     *
     *                                          So if $gc_probability is 1 and $gc_divisor is 100 means that there is
     *                                          a 1% chance the the gc routine will be called on each request
     *
     *                                          Default is specified in php.ini file
     *
     *  @param  string      $securityCode       (optional) the value of this argument is appended to the HTTP_USER_AGENT before
     *                                          creating the md5 hash out of it. this way we'll try to prevent HTTP_USER_AGENT
     *                                          spoofing
     *
     *                                          Default is 'sEcUr1tY_c0dE'
     *
     *  @param  string      $tableName          (optional) You can change the name of that table by setting this property
     *
     *                                          Default is 'session_data'
     *
     *  @return void
     */
    function dbSession($gc_maxlifetime = "21600", $gc_probability = "", $gc_divisor = "", $securityCode = "eF@0#u^*sZD9!S$%", $tableName = "sessions")
    {

        // if $gc_maxlifetime is specified and is an integer number
        if ($gc_maxlifetime != "" && is_integer($gc_maxlifetime)) {
            // set the new value
            @ini_set('session.gc_maxlifetime', $gc_maxlifetime);
        }

        // if $gc_probability is specified and is an integer number
        if ($gc_probability != "" && is_integer($gc_probability)) {
            // set the new value
            @ini_set('session.gc_probability', $gc_probability);
        }

        // if $gc_divisor is specified and is an integer number
        if ($gc_divisor != "" && is_integer($gc_divisor)) {
            // set the new value
            @ini_set('session.gc_divisor', $gc_divisor);
        }

        // get session lifetime
        $this->sessionLifetime = ini_get("session.gc_maxlifetime");

        // we'll use this later on in order to try to prevent HTTP_USER_AGENT spoofing
        $this->securityCode = $securityCode;

        $this->tableName = $tableName;

        // register the new handler
        session_set_save_handler(
            array(&$this, 'open'),
            array(&$this, 'close'),
            array(&$this, 'read'),
            array(&$this, 'write'),
            array(&$this, 'destroy'),
            array(&$this, 'gc')
        );
        register_shutdown_function('session_write_close');

        // start the session
        session_start();

    }

    /**
     *  Deletes all data related to the session
     *
     *  @since 1.0.1
		*
     *  @return void
     */
    function stop()
    {

        $this->regenerate_id();

        session_unset();

        session_destroy();

    }

    /**
     *  Regenerates the session id.
     *
     *  <b>Call this method whenever you do a privilege change!</b>
     *
     *  @return void
     */
    function regenerate_id()
    {

        // saves the old session's id
        $oldSessionID = session_id();

        // regenerates the id
        // this function will create a new session, with a new id and containing the data from the old session
        // but will not delete the old session
        session_regenerate_id();

        // because the session_regenerate_id() function does not delete the old session,
        // we have to delete it manually
        $this->destroy($oldSessionID);

    }
		
		//..function to unpack the blog data	 
		function sessDataUnpack($sessData)
		{ 
		    if(!is_string($sessData))
		        return false;                

		    $data = preg_split('#([\w\d]+?)\|#',$sessData,-1,PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
		    $flip = true;
		    $sessData = array(); 

		    foreach($data as $bit){
		        if($flip) 
		             $key = $bit;
		        else 
		             $sessData[$key] = unserialize($bit);
		        $flip = !$flip;
		    }        
				return $sessData; 
		} 

    /**
     *  Get the number of online users
     *
     *  @return integer number of users currently online
     */
    function get_users_online()
    {

        // call the garbage collector
        $this->gc($this->sessionLifetime);
				/*
        // counts the rows from the database
        $result = @mysql_fetch_assoc(@mysql_query("
            SELECT
                COUNT(session_id) as count
            FROM " . $this->tableName . "
        "));

        // return the number of found rows
        return $result["count"];
				*/
				$live_ids=array();
				$qry  = "SELECT CAST(`session_data` AS CHAR(10000) CHARACTER SET utf8) as `sess_data` FROM `sessions`";
				$res = mysql_query($qry);
				if($res){
					while ($row = mysql_fetch_assoc($res)) {
						 if(is_not_empty($row["sess_data"])){
						 		$tmp=$this->sessDataUnpack($row["sess_data"]);
								if(is_not_empty($tmp) && is_not_empty($tmp['guid'])){
									$live_ids[]=$tmp['guid'];
								}
						 }						 		
					}
					mysql_free_result($res);	
				}
				return $live_ids;
    }

    /**
     *  Custom open() function
     *
     *  @access private
     */
    function open($save_path, $session_name)
    {

        return true;

    }

    /**
     *  Custom close() function
     *
     *  @access private
     */
    function close()
    {

        return true;

    }

    /**
     *  Custom read() function
     *
     *  @access private
     */
    function read($session_id)
    {

        // reads session data associated with the session id
        // but only
        // - if the HTTP_USER_AGENT is the same as the one who had previously written to this session AND
        // - if session has not expired
        $result = @mysql_query("
            SELECT
                session_data
            FROM
                " . $this->tableName . "
            WHERE
                session_id = '".mysql_real_escape_string($session_id)."' AND
                http_user_agent = '".mysql_real_escape_string(md5($_SERVER["HTTP_USER_AGENT"] . $this->securityCode))."' AND
                session_expire > '".time()."'
            LIMIT 1
        ");
				
			/*	
				echo "
            SELECT
                session_data
            FROM
                " . $this->tableName . "
            WHERE
                session_id = '".mysql_real_escape_string($session_id)."' AND
                http_user_agent = '".mysql_real_escape_string(md5($_SERVER["HTTP_USER_AGENT"] . $this->securityCode))."' AND
                session_expire > '".time()."'
            LIMIT 1;
        ";
				*/

        // if anything was found
        if (is_resource($result) && @mysql_num_rows($result) > 0) {

            // return found data
            $fields = @mysql_fetch_assoc($result);
            // don't bother with the unserialization - PHP handles this automatically
            return $fields["session_data"];

        }

        // if there was an error return an empty string - this HAS to be an empty string
        return "";

    }

    /**
     *  Custom write() function
     *
     *  @access private
     */
    function write($session_id, $session_data)
    {

        // insert OR update session's data - this is how it works:
        // first it tries to insert a new row in the database BUT if session_id is already in the database then just
        // update session_data and session_expire for that specific session_id
        // read more here http://dev.mysql.com/doc/refman/4.1/en/insert-on-duplicate.html
        $result = @mysql_query("

            INSERT INTO
                " . $this->tableName . " (
                    session_id,
                    http_user_agent,
                    session_data,
                    session_expire
                )
            VALUES (
                '".mysql_real_escape_string($session_id)."',
                '".mysql_real_escape_string(md5($_SERVER["HTTP_USER_AGENT"] . $this->securityCode))."',
                '".mysql_real_escape_string($session_data)."',
                '".mysql_real_escape_string(time() + $this->sessionLifetime)."'
            )
            ON DUPLICATE KEY UPDATE
                session_data = '".mysql_real_escape_string($session_data)."',
                session_expire = '".mysql_real_escape_string(time() + $this->sessionLifetime)."'
        ");

        // if anything happened
        if ($result) {

            // note that after this type of queries, mysql_affected_rows() returns
            // - 1 if the row was inserted
            // - 2 if the row was updated

            // if the row was updated
            if (@mysql_affected_rows() > 1) {

                // return TRUE
                return true;

            // if the row was inserted
            } else {

                // return an empty string
                return "";

            }

        }

        // if something went wrong, return false
        return false;

    }

    /**
     *  Custom destroy() function
     *
     *  @access private
     */
    function destroy($session_id)
    {

        // deletes the current session id from the database
        $result = @mysql_query("

            DELETE FROM
                " . $this->tableName . "
            WHERE
                session_id = '".mysql_real_escape_string($session_id)."'

        ");

        // if anything happened
        if (@mysql_affected_rows()) {

            // return true
            return true;

        }

        // if something went wrong, return false
        return false;

    }

    /**
     *  Custom gc() function (garbage collector)
     *
     *  @access private
     */
    function gc($maxlifetime)
    {
        // it deletes expired sessions from database
        $result = @mysql_query("
            DELETE FROM
                " . $this->tableName . "
            WHERE
                session_expire < '".mysql_real_escape_string(time() - $maxlifetime)."'
        ");
    }

}
?>