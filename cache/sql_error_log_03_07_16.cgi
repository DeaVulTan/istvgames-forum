
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Mon, 07 Mar 2016 12:43:07 +0000
 Error: 1205 - Lock wait timeout exceeded; try restarting transaction
 IP Address: 178.218.205.148 - /
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: INSERT INTO cache_store (`cs_array`,`cs_key`,`cs_value`,`cs_updated`,`cs_rebuild`) VALUES(1,'custom_sidebar_blocks','a:0:{}',1457354536,0) ON DUPLICATE KEY UPDATE cs_array=VALUES(cs_array),cs_key=VALUES(cs_key),cs_value=VALUES(cs_value),cs_updated=VALUES(cs_updated),cs_rebuild=VALUES(cs_rebuild)
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsRegistry.php         | [db_main_mysql].replace                                                       | 3247              |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsRegistry.php         | [ips_CacheRegistry].cacheSet                                                  | 3440              |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications_addon/other/customSidebarBlocks/modules_admin/customSidebarBlocks/core.php| [ips_CacheRegistry].setCache                                                  | 682               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsRegistry.php         | [admin_customSidebarBlocks_customSidebarBlocks_core].rebuildBlockCache        | 3532              |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | hooks/customSidebarBlocksHook_367de3d03d54c661fd5abf5b9b256ac6.php         | [ips_CacheRegistry].rebuildCache                                              | 34                |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/classes/output/publicOutput.php| [customSidebarBlocksHook].getOutput                                           | 3786              |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/classes/output/publicOutput.php(3850) : eval()'d code| [output].templateHooks                                                        | 6                 |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/classes/output/formats/html/htmlOutput.php| [shoutboxGlobalJs].globalTemplate                                             | 312               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/classes/output/publicOutput.php| [htmlOutput].fetchOutput                                                      | 2971              |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/forums/modules_public/forums/boards.php| [output].sendOutput                                                           | 124               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_forums_forums_boards].doExecute                                       | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'