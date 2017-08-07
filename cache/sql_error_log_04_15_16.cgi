
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Fri, 15 Apr 2016 01:43:54 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 66.249.66.169 - /index.php?/best-content/
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*,rc.*,p.*,t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app='forums' AND rc.type='pid' AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND r.type_id IN (104,7568,7297,8101,6915,6311,8106,157,547,8970,7504,4306,7615,4898,336,141,8888,5536,7998,5422) GROUP BY r.app, r.type, r.type_id
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_reputation_most].doExecute                                    | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Fri, 15 Apr 2016 09:58:18 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 66.249.66.172 - /index.php?/best-content/
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*,rc.*,p.*,t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app='forums' AND rc.type='pid' AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND r.type_id IN (104,7568,7297,8101,6915,6311,8106,157,547,8970,7504,4306,7615,4898,336,141,8888,5536,7998,5422) GROUP BY r.app, r.type, r.type_id
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_reputation_most].doExecute                                    | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'