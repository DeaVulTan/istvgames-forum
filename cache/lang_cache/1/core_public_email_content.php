<?php

/*******************************************************
NOTE: This is a cache file generated by IP.Board on Sat, 03 Oct 2015 16:55:08 +0000 by Polica
Do not translate this file as you will lose your translations next time you edit via the ACP
Please translate via the ACP
*******************************************************/



$lang = array( 
'account_created' => "Здравствуйте, <#NAME#>!

Ваша учетная запись успешно создана на форуме <#BOARD_NAME#>

Данные для доступа к форумам следующие:

Имя пользователя: <#NAME#> 
Пароль: <#PASSWORD#>
E-mail: <#EMAIL#>

Пожалуйста, запомните, что мы не храним ваш пароль, но вы можете его изменить в любое время в ваших личных данных.

Приятного общения!

<#BOARD_ADDRESS#>
",
'admin_newuser' => "Здравствуйте.

Вы получили это письмо потому, что на форуме зарегистрировался новый пользователь!

------------------------------------------------
Имя пользователя: <#LOG_IN_NAME#>
Отображаемое имя: <#DISPLAY_NAME#>
Email: <#EMAIL#>
IP-адрес: <#IP#>
Дата регистрации: <#DATE#>
------------------------------------------------

(вы можете отключить подобные уведомления в АдминЦентре)",
'complete_reg' => "
Поздравляем, <#NAME#>! 

Администратор подтвердил ваш запрос на регистрацию (или смену e-mail адреса) на <#BOARD_NAME#>.
Теперь вы можете войти на форум и пользоваться всеми возможностями полноценного пользователя.

Адрес форума: <#BOARD_ADDRESS#>
",
'digest_forum_daily' => "<#NAME#>, 

Это письмо содержит обзор новых тем за сегодня на форуме <#FORUM_NAME#>:

---------------------------------------------------------------------- 

<#CONTENT#> 

---------------------------------------------------------------------- 

Раздел форума, на который вы подписались, по ссылке:
<#URL#>

Отмена подписки:
-------------- 
Вы можете прекратить подписку, перейдя по ссылке: <#UNSUBCRIBE_URL#>",
'digest_forum_weekly' => "<#NAME#>, 

Это письмо содержит обзор новых тем за последнюю неделю на форуме <#FORUM_NAME#>:

---------------------------------------------------------------------- 

<#CONTENT#> 

---------------------------------------------------------------------- 

Раздел форума, на который вы подписались, по ссылке:
<#URL#>

Отмена подписки:
-------------- 
Вы можете прекратить подписку, перейдя по ссылке: <#UNSUBCRIBE_URL#>",
'digest_topic_daily' => "<#NAME#>, 

Это письмо содержит обзор сообщений темы «<#TITLE#>» за сегодня:

---------------------------------------------------------------------- 
<#CONTENT#> 
---------------------------------------------------------------------- 

Адрес темы: <#URL#>

Отписаться:
-------------- 
Вы можете отменить подписку по ссылке: <#UNSUBCRIBE_URL#>.
",
'digest_topic_weekly' => "<#NAME#>, 

Это письмо содержит обзор сообщений темы «<#TITLE#>» за прошедшую неделю:

---------------------------------------------------------------------- 

<#CONTENT#> 

---------------------------------------------------------------------- 

Адрес темы: <#URL#>

Отписаться:
--------------
Вы можете прекратить подписку, перейдя по этой ссылке: <#UNSUBCRIBE_URL#>",
'email_convo' => "<#NAME#>,

К письму прикреплен архив личной переписки:
Название: <#TITLE#>
Начало: <#DATE#>
<#LINK#>",
'email_member' => "Отправить письмо",
'error_log_notification' => "На вашем форуме возникла ошибка!

Вы получили это уведомление, так как у вас включена соответствующая функция в админцентре.

Данные по ошибке.

Код ошибки: <#CODE#> 
Сообщение: <#MESSAGE#> 
Пользователь, кто обнаружил ошибку: <#VIEWER#> 
Его IP-адрес: <#IP_ADDRESS#> 

Более подробную информация вы можете получить, просмотрев журнал error_log.

<#BOARD_ADDRESS#>
",
'forward_page' => "<#BOARD_NAME#>

<#TO_NAME#> 

<#THE_MESSAGE#>

--------------------------------------------------- 
Имейте в виду, что <#BOARD_NAME#> не контролирует 
содержание данного письма..
---------------------------------------------------


",
'lost_pass' => "Здравствуйте, <#NAME#>!

Вы получили это письмо от <#BOARD_ADDRESS#>, поскольку был сделан запрос на восстановление пароля для пользователя \"<#USERNAME#>\" на форуме «<#BOARD_NAME#>».
Если вы не делали такой запрос, проигнорируйте и удалите это сообщение.


Если же вы в самом деле забыли свой пароль, заново активируйте вашу учетную запись.

Чтобы активировать вашу учетную запись, необходимо перейти по ссылке
<#THE_LINK#>
Активация произойдет автоматически.

Если таким способом сбросить пароль не удалось, попробуйте активировать вручную. Пройдите по ссылке
<#MAN_LINK#>
и введите указанные ниже ID пользователя и код активации (не пароль!) в соответствующие поля.

===================================
ID пользователя: <#ID#>
Код активации: <#CODE#>
===================================

После активации учетной записи следуйте инструкциям по восстановлению пароля, которые будет сообщать вам форум.

Если ничего не получается, свяжитесь с администратором форума!
(IP адрес отправителя: <#IP_ADDRESS#>)",
'lost_pass_email_pass' => "<#BOARD_ADDRESS#>

<#NAME#>, мы создали для вас новый пароль по вашему запросу.

------------------------------------------------ 
НОВЫЙ ПАРОЛЬ
------------------------------------------------ 

Имя пользователя: <#USERNAME#>
E-mail: <#EMAIL#>
Новый пароль: <#PASSWORD#>

Войдите на форум с новыми данными: <#LOGIN#>

------------------------------------------------ 
ИЗМЕНЕНИЕ ПАРОЛЯ 
------------------------------------------------
После входа вы можете изменить свой пароль в своих личных данных: <#THE_LINK#>
",
'newemail' => "Здравствуйте, <#NAME#>!

Вы получили это письмо от <#BOARD_ADDRESS#>, потому что запросили изменение E-mail.

------------------------------------------------
Инструкция по активации
------------------------------------------------

Вам необходимо будет активировать изменение e-mail адреса, это необходимо для проверки того, что это действие сделали именно вы. Также это требуется для защиты от нежелательных злоупотреблений и спама.

Для активации учетной записи зайдите по ссылке:

<#THE_LINK#>

------------------------------------------------
Не сработало?
------------------------------------------------

Если перейти по ссылке выше не удалось, зайдите по ссылке

<#MAN_LINK#>

и введите указанные ниже ID пользователя и код активации (не пароль!) в соответствующие поля.

===================================
ID пользователя: <#ID#>
Код активации: <#CODE#>
===================================

По окончании процесса активации вам, возможно, придется войти на форум повторно, для применения изменений.

Если ничего не получается, свяжитесь с администратором форума!",
'new_comment_added' => "<#MEMBERS_DISPLAY_NAME#>, 

<#COMMENT_NAME#> оставил комментарий в вашем профиле.

Управление такими комментариями по ссылке: <#LINK#>  ",
'new_comment_request' => "<#MEMBERS_DISPLAY_NAME#>, 
	
<#COMMENT_NAME#> оставил комментарий. 
Так как у вас включена премодерация комментариев, комментарий необходимо активировать или удалить. 
Сделать это можно по ссылке: <#LINK#>",
'new_friend_added' => "<#MEMBERS_DISPLAY_NAME#>, 
<#FRIEND_NAME#> добавил вас в список друзей.
Управление списком ваших друзей: <#LINK#>
",
'new_friend_approved' => "<#MEMBERS_DISPLAY_NAME#>, 
<#FRIEND_NAME#> принял предложение стать вашим другом! 
Управление вашим списком друзей по ссылке: <#LINK#>
",
'new_friend_request' => "<#MEMBERS_DISPLAY_NAME#>, 
	
<#FRIEND_NAME#> хочет стать вашим другом! 
Так как у вас включена проверка желающих стать вашими друзьями, то для того, 
чтобы он появился в вашем списке друзей, его запрос необходимо подтвердить (или отклонить). 
Сделать это можно по ссылке: <#LINK#>
",
'new_likes' => "Здравствуйте!

Пользователю <#MEMBER_NAME#> понравилось вашe сообщение на форуме!
======================================================================
<#SHORT_POST#>
======================================================================
<#URL#>",
'new_post_queue_notify' => "<#BOARD_NAME#>

На форуме появилось новое сообщение для проверки и публикации/удаления модератором.

Тема: <#TOPIC#>
Форум: <#FORUM#>
Автор:  <#POSTER#>
Время: <#DATE#>

Для совершения действий с сообщением перейдите по ссылке: <#LINK#> 
----------------------------------
<#POST#>
----------------------------------

Если вы больше не хотите получать такие уведомления, удалите ваш e-mail адрес в настройках форума.

Адрес форума: <#BOARD_ADDRESS#>",
'new_status' => "<#NAME#>,

<#OWNER#> только что обновил статус.

======================================================================
<#STATUS#>
======================================================================


Вы можете отключить уведомления по адресу <#URL#>",
'new_topic_queue_notify' => "
Это письмо отослано с форума <#BOARD_NAME#>

Появилось новая тема для премодерации:

----------------------------------
Тема: <#TOPIC#>
Форум: <#FORUM#>
Автор:  <#POSTER#>
Время: <#DATE#>
Ссылка: <#LINK#>
----------------------------------
<#POST#>
----------------------------------

Если вы больше не хотите получать такие уведомления, удалите ваш e-mail адрес в настройках форума.

Адрес форума: <#BOARD_ADDRESS#>
",
'personal_convo_invite' => "<#NAME#>, 
<#POSTER#> добавил вас к личной беседе \"<#TITLE#>\". 

Вы можете прочитать диалог по указанной ниже ссылке:

<#BOARD_ADDRESS#><#LINK#>
",
'personal_convo_new_convo' => "<#NAME#>, 
	
<#POSTER#> отправил вам сообщение с заголовком \"<#TITLE#>\". 

<#POSTER#> сказал: 
======================================================================
<#TEXT#>
======================================================================

НЕ ОТВЕЧАЙТЕ НА ЭТО ПИСЬМО!

Вы можете просмотреть беседу и ответить на сообщение, пройдя по указанной ниже ссылке:
<#BOARD_ADDRESS#><#LINK#>
",
'personal_convo_new_reply' => "<#NAME#>, 
<#POSTER#> ответил в личную беседу \"<#TITLE#>\".

<#POSTER#> сказал:
=====================================================================
<#TEXT#>
=====================================================================

НЕ ОТВЕЧАЙТЕ НА ЭТО ПИСЬМО!

Вы можете просмотреть полный диалог беседы и ответить по указанной ниже ссылке:
<#BOARD_ADDRESS#><#LINK#>
",
'possibleSpammer' => "Здравствуйте.

Обнаружен возможный «спамер» (человек или робот, рассылающий спам).

Имя: <#MEMBER_NAME#>
E-mail: <#EMAIL#>
IP-адрес: <#IP#>
Дата регистрации: <#DATE#> 

Просмотреть другую информацию и возможные действия по пользователю можно по ссылке:
<#LINK#>",
'post_was_quoted' => "Здравствуйте!

Уведомляем вас о том, что одно из ваших сообщений было процитировано <#MEMBER_NAME#>.

Процитированное сообщение: 

<#ORIGINAL_POST#>

Прочитать сообщение от <#MEMBER_NAME#> вы можете по ссылке: 

<#NEW_POST#>

----------------------------------
<#POST#>
----------------------------------

Если вы больше не хотите получать уведомления о цитировании ваших сообщений, вы можете изменить необходимые параметры в настройках вашего профиля в разделе «Настройки уведомлений».

<#BOARD_ADDRESS#>",
'reg_validate' => "<#NAME#>,

В форуме по адресу <#BOARD_ADDRESS#> появилась регистрационная запись,
в которой был указал ваш электронный адрес (e-mail).

Если вы не понимаете, о чем идет речь — просто проигнорируйте это сообщение!

Если же именно вы решили зарегистрироваться в форуме по адресу <#BOARD_ADDRESS#>,
то вам следует подтвердить свою регистрацию и тем самым активировать вашу учетную запись.
Подтверждение регистрации производится один раз и необходимо для повышения безопасности форума и защиты его от злоумышленников.
Чтобы активировать вашу учетную запись, необходимо перейти по ссылке:
<#THE_LINK#>
Активация произойдет автоматически.

Если таким способом активировать учетную запись не удалось, попробуйте сделать это вручную. Пройдите по ссылке
<#MAN_LINK#>
и введите указанные ниже ID пользователя и код активации (не пароль!) в соответствующие поля.

===================================
ID пользователя: <#ID#>
Код активации: <#CODE#>
===================================

После активации учетной записи вы сможете войти в форум, используя выбранные вами имя пользователя (login) и пароль. С этого момента вы сможете оставлять сообщения.

Пожалуйста, не забудьте заполнить свои личные данные.

Благодарим за регистрацию!",
'send_text' => "Сообщение от пользователя: <#USER NAME#>

Сообщаю, что вам будет интересно прочитать указанную по ссылке страницу:
<#THE LINK#> ",
'status_reply' => "<#NAME#>,

<#POSTER#> <#BLURB#>

Статус: (<#OWNER#>) <#STATUS#>
======================================================================
<#TEXT#>
======================================================================


Вы можете отключить уведомления по адресу <#URL#>",
'subject__account_created' => "Ваша учетная запись успешно создана",
'subject__complete_reg' => "Учетная запись: %s, подтверждена %s",
'subject__digest_forum_daily' => "Обзор новых тем за день",
'subject__digest_forum_weekly' => "Обзор новых тем за неделю",
'subject__digest_topic_daily' => "Обзор новых сообщений за день",
'subject__digest_topic_weekly' => "Обзор новых сообщений за неделю",
'subject__email_convo' => "Архив личной переписки",
'subject__error_log_notification' => "На вашем форуме возникла ошибка",
'subject__new_comment_added' => "<a href='%s'>Новый комментарий</a> от <a href='%s'>%s</a>",
'subject__new_comment_request' => "<a href='%s'>Новый комментарий</a> от <a href='%s'>%s</a> ожидает подтверждения",
'subject__new_friend_added' => "<a href='%s'>%s</a> добавил вас в друзья",
'subject__new_friend_approved' => "<a href='%s'>%s</a> подтвердил дружбу с вами",
'subject__new_friend_request' => "<a href='%s'>%s</a> отослал вам запрос на добавление в <a href='%s'>список друзей</a>",
'subject__new_likes' => "<a href='%s'>%s</a> понравилось <a href='%s'>ваше сообщение</a> в <a href='%s'>%s</a>",
'subject__new_post_queue_notify' => "Новое сообщение, требующее активации",
'subject__new_status' => "<a href='%s'>%s</a> обновил свой <a href='%s'>статус</a>",
'subject__new_topic_queue_notify' => "Новая тема, требующая активации",
'subject__other_status_reply' => "<a href='%s'>%s</a> прокомментировал <a href='%s'>%s</a> <a href='%s'>статус</a>",
'subject__personal_convo_invite' => "<a href='%s'>%s</a> приглашает вас принять участие в <a href='%s'>беседе</a>",
'subject__personal_convo_new_convo' => "<a href='%s'>%s</a> начал новую <a href='%s'>беседу</a> с вами",
'subject__personal_convo_new_reply' => "<a href='%s'>%s</a> написал новое сообщение в <a href='%s'>личной беседе</a>",
'subject__post_was_quoted' => "<a href='%s'>%s</a> <a href='%s'>процитировал</a> ваше <a href='%s'>сообщение</a>",
'subject__status_reply' => "<a href='%s'>%s</a> прокомментировал ваш <a href='%s'>статус</a>",
'subject__subs_new_topic' => "<a href='<#POSTERURL#>'><#POSTER#></a> создал тему <a href='<#URL#>'><#TITLE#></a>",
'subject__subs_with_post' => "<a href='<#POSTERURL#>'><#POSTER#></a> ответил в тему <a href='<#URL#>'><#TITLE#></a>",
'subject__subs_with_post.emailOnly' => "Новый ответ в %s",
'subject__their_status_reply' => "<a href='%s'>%s</a> ответил(а) на статус пользователя <a href='%s'>status</a>",
'subs_new_topic' => "<#NAME#>, 

<#POSTER#> открыл новую тему \"<#TITLE#>\" в разделе \"<#FORUM#>\".
<div class='callout'>
----------------------------------------------------------------------
<#POST#>
----------------------------------------------------------------------
</div>

Адрес темы: <a href='<#URL#>'><#URL#></a>
<div class='unsub'>
Вы можете прекратить подписку и больше не получать уведомлений, перейда по этой ссылке: <a href='<#UNSUBCRIBE_URL#>'><#UNSUBCRIBE_URL#></a>

Если вы не хотите больше получать никаких уведомлений с форума просто отключите соответствующую опцию « Сообщать мне обо всех изменениях, проводимых администратором форума.» в вашем профиле в меню «Общие настройки».</div>
",
'subs_with_post' => "<#NAME#>, 
	
<#POSTER#> опубликовал ответ в тему \"<#TITLE#>\", на которую вы подписаны.
<div class='callout'>
----------------------------------------------------------------------
<#POST#>
----------------------------------------------------------------------
</div>
Адрес темы: <a href='<#URL#>'><#URL#></a>

Если у вас включена немедленная доставка уведомлений о новых сообщениях в этой теме, вы будете получать письмо с 
уведомлением на каждый новый ответ в тему. В противном случае только одно такое письмо со всеми новыми ответами 
будет приходить между каждым вашим визитом на форум.

<div class='unsub'>Вы можете прекратить подписку, перейдя по этой ссылке: <a href='<#UNSUBCRIBE_URL#>'><#UNSUBCRIBE_URL#></a></div>
",
 ); 
