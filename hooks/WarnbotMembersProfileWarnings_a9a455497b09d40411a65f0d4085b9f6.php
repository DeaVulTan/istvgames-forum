<?php
/**
 * Warnbot
 * Version: 11000
 * Author: Dmitry Nikitenko <dima.nikitenko@gmail.com>
 */

class WarnbotMembersProfileWarnings extends public_members_profile_warnings
{

    public function save()
    {
        $classToLoad = IPSLib::loadLibrary(IPSLib::getAppDir('forums') . '/sources/classes/post/classPost.php', 'classPost', 'forums');
        $post = new $classToLoad($this->registry);

        $memberID = $this->settings['warnbot_author'] ? $this->settings['warnbot_author'] : $this->memberData['member_id'];
        $post->setForumID($this->settings['warnbot_forum']);
        $post->setTopicID($this->settings['warnbot_topic']);
        $post->setAuthor($memberID);

        $name = $this->_member['members_display_name'];
        $punishment = '';
        $ban_group = '';

        // reason
        if (intval($this->request['reason']) === 0) {
            $reason = $this->lang->words['warnings_reasons_other'];
        } else {
            $reason = $this->reasons[intval($this->request['reason'])]['wr_name'];
        }

        // punishments
        $punishments = array(
            'mq' => intval($this->request['mq']),
            'mq_perm' => $this->request['mq_perm'],
            'rpa' => intval($this->request['rpa']),
            'rpa_perm' => $this->request['rpa_perm'],
            'suspend' => intval($this->request['suspend']),
            'suspend_perm' => $this->request['suspend_perm'],
        );

        foreach ($punishments as $k => $v) {
            if (is_int($v) && $v > 0) {
                $unit = $this->lang->words['warnings_time_' . $this->request[$k . '_unit']];
                $punishment .= '[*]' . sprintf($this->lang->words['warnings_' . $k], sprintf($this->lang->words['warnings_for'], $v, $unit));
            } else {
                if ($v !== NULL && $v === 'on') {
                    $unit = $this->lang->words['warnings_permanently'];
                    $punishment .= '[*]' . sprintf($this->lang->words['warnings_' . substr($k, 0, -5)], $unit);
                }
            }
        }

        // or verbal only punishment
        if ($punishment === '') {
            $punishment = '[*]' . $this->lang->words['warnings_verbal_only'];
        }

        // also move to ban group
        if (intval($this->request['ban_group']) === 1) {
            $ban_group = $this->lang->words['warnings_ban_group'] . ' '
                . $this->caches['group_cache'][intval($this->request['ban_group_id'])]['g_title'];
        }

        $postContent = $this->settings['warnbot_post'];
        if($postContent) {
            $postContent = str_replace('{name}', $name, $postContent);
            $postContent = str_replace('{reason}', $reason, $postContent);
            $postContent = str_replace('{punishment}', '[list]' . $punishment . '[/list]', $postContent);
            $postContent = str_replace('{move_to_ban_group}', $ban_group, $postContent);

            $post->setPostContent($postContent);

            $post->addReply();
        }

        parent::save();
    }

}