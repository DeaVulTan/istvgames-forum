
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Wed, 16 Mar 2016 19:26:05 +0000
 Error: 2002 - Can't connect to local MySQL server through socket '/var/run/mysqld/mysqld.sock' (2)
 IP Address: 213.230.103.169 - /index.php?/topic/306-addony/page-2
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Wed, 16 Mar 2016 19:32:10 +0000
 Error: 1205 - Lock wait timeout exceeded; try restarting transaction
 IP Address: 213.230.103.169 - /index.php?app=core&module=task
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: INSERT INTO cache_store (`cs_array`,`cs_key`,`cs_value`,`cs_updated`,`cs_rebuild`) VALUES(1,'systemvars','a:6:{s:10:\"mail_queue\";i:0;s:13:\"task_next_run\";s:10:\"1458153120\";s:14:\"incomingEmails\";b:0;s:9:\"loadlimit\";s:15:\"0.68-1456382355\";s:19:\"last_deepscan_check\";i:1452623626;s:16:\"last_virus_check\";i:1452623658;}',1458156679,0) ON DUPLICATE KEY UPDATE cs_array=VALUES(cs_array),cs_key=VALUES(cs_key),cs_value=VALUES(cs_value),cs_updated=VALUES(cs_updated),cs_rebuild=VALUES(cs_rebuild)
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsRegistry.php         | [db_main_mysql].replace                                                       | 3247              |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsRegistry.php         | [ips_CacheRegistry].cacheSet                                                  | 3440              |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/classes/class_taskmanager.php| [ips_CacheRegistry].setCache                                                  | 287               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/classes/class_taskmanager.php| [class_taskmanager].saveNextRunStamp                                          | 202               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 |                                                                            | [class_taskmanager].runTask                                                   |                   |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Wed, 16 Mar 2016 19:32:19 +0000
 Error: 1205 - Lock wait timeout exceeded; try restarting transaction
 IP Address: 213.230.103.169 - /index.php?app=core&module=task
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: INSERT INTO cache_store (`cs_array`,`cs_key`,`cs_value`,`cs_updated`,`cs_rebuild`) VALUES(1,'systemvars','a:6:{s:10:\"mail_queue\";i:0;s:13:\"task_next_run\";s:10:\"1458153180\";s:14:\"incomingEmails\";b:0;s:9:\"loadlimit\";s:15:\"0.68-1456382355\";s:19:\"last_deepscan_check\";i:1452623626;s:16:\"last_virus_check\";i:1452623658;}',1458156688,0) ON DUPLICATE KEY UPDATE cs_array=VALUES(cs_array),cs_key=VALUES(cs_key),cs_value=VALUES(cs_value),cs_updated=VALUES(cs_updated),cs_rebuild=VALUES(cs_rebuild)
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsRegistry.php         | [db_main_mysql].replace                                                       | 3247              |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsRegistry.php         | [ips_CacheRegistry].cacheSet                                                  | 3440              |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/classes/class_taskmanager.php| [ips_CacheRegistry].setCache                                                  | 287               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/classes/class_taskmanager.php| [class_taskmanager].saveNextRunStamp                                          | 202               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 |                                                                            | [class_taskmanager].runTask                                                   |                   |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'