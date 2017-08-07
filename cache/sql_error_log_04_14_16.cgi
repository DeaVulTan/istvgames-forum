
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:06 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:07 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:08 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:09 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:12 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:12 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:16 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:16 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:25 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:28 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:28 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:29 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:30 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:30 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:31 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:31 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:31 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:31 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:32 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:32 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:39 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=866&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=866 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 08:59:54 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 09:00:04 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=866&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=866 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 09:00:04 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=866&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=866 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 09:00:04 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=866&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=866 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 09:00:11 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 09:00:11 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 09:00:13 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 09:00:14 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 09:00:14 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 09:12:53 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 09:12:53 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 09:12:54 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=1103cfed2613f104578c29c84dd87a82&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 10:18:13 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=46f8dc447a06dfd89e96f3dd469b6944&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 10:18:15 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.102.195 - /index.php?s=46f8dc447a06dfd89e96f3dd469b6944&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 15:57:22 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.101.244 - /index.php?s=90dbc06b1608cfcac0f68d95aa844983&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 15:57:22 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.101.244 - /index.php?s=90dbc06b1608cfcac0f68d95aa844983&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 15:57:31 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 213.230.101.244 - /index.php?s=90dbc06b1608cfcac0f68d95aa844983&app=members&section=load&module=ajax&member_id=361&tab=members:reputation&md5check=fd60c200c6517707580e8349d4bae4a9
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*, rc.*, r.member_id as repUserGiving, p.*, t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app=r.app AND rc.type=r.type AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND p.author_id=361 AND  t.tid<>0 AND t.approved=1 AND p.queued=0 AND t.forum_id IN(159,2,3,55,65,49,4,46,59,6,8,7,30,50,32,31,33,156,157,34,35,114,119,120,121,36,14,15,60,16,18,23,22,19,21,95,48,17,61,102,28,106,103,69,108,92,93,38,39,40,64,44,45,52,83,154,155,62,63,41,74,42,43,87,53,54,158,58,71,70,72,73,66,67,77,81,78,80,79,91,84,85,89,90,94,96,75,98,153,112,118,113,117,115,122,123,124,125,126,127,128,130,129,131,132,133,134,146,145,150,148,149,152,160,161,162) GROUP BY r.app, r.type, r.type_id ORDER BY r.type_id DESC LIMIT 0,15
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/applications/members/modules_public/ajax/load.php| [profile_reputation].return_html_block                                        | 107               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_ajax_load].doExecute                                          | 421               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [ipsAjaxCommand].execute                                                      | 120               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 Date: Thu, 14 Apr 2016 17:18:58 +0000
 Error: 1055 - Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'forum.r.id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by
 IP Address: 144.76.63.35 - /index.php?/best-content/
 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 mySQL query error: SELECT r.*,rc.*,p.*,t.*, t.title as topic_title FROM reputation_index r  LEFT JOIN reputation_cache rc ON ( rc.app='forums' AND rc.type='pid' AND rc.type_id=r.type_id ) 
 LEFT JOIN posts p ON ( r.type_id=p.pid ) 
 LEFT JOIN topics t ON ( p.topic_id=t.tid )   WHERE r.app='forums' AND r.type='pid' AND r.type_id IN (104,7568,7297,8101,6915,6311,8106,157,547,8970,7504,4306,7615,4898,336,141,8888,5536,7998,5422) GROUP BY r.app, r.type, r.type_id
 .--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------.
 | File                                                                       | Function                                                                      | Line No.          |
 |----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------|
 | RcDYNG4d37xcD4eJadminYTVZMnz9fLf4pb72/sources/base/ipsController.php       | [public_members_reputation_most].doExecute                                    | 306               |
 '----------------------------------------------------------------------------+-------------------------------------------------------------------------------+-------------------'