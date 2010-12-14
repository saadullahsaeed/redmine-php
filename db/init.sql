-- Redmine installation script

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Structure de la table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(11) NOT NULL auto_increment,
  `container_id` int(11) NOT NULL default '0',
  `container_type` varchar(30) NOT NULL default '',
  `filename` varchar(255) NOT NULL default '',
  `disk_filename` varchar(255) NOT NULL default '',
  `filesize` int(11) NOT NULL default '0',
  `content_type` varchar(255) default '',
  `digest` varchar(40) NOT NULL default '',
  `downloads` int(11) NOT NULL default '0',
  `author_id` int(11) NOT NULL default '0',
  `created_on` datetime default NULL,
  `description` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `index_attachments_on_container_id_and_container_type` (`container_id`,`container_type`),
  KEY `index_attachments_on_author_id` (`author_id`),
  KEY `index_attachments_on_created_on` (`created_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `attachments`
--


-- --------------------------------------------------------

--
-- Structure de la table `auth_sources`
--

DROP TABLE IF EXISTS `auth_sources`;
CREATE TABLE IF NOT EXISTS `auth_sources` (
  `id` int(11) NOT NULL auto_increment,
  `type` varchar(30) NOT NULL default '',
  `name` varchar(60) NOT NULL default '',
  `host` varchar(60) default NULL,
  `port` int(11) default NULL,
  `account` varchar(255) default NULL,
  `account_password` varchar(60) default NULL,
  `base_dn` varchar(255) default NULL,
  `attr_login` varchar(30) default NULL,
  `attr_firstname` varchar(30) default NULL,
  `attr_lastname` varchar(30) default NULL,
  `attr_mail` varchar(30) default NULL,
  `onthefly_register` tinyint(1) NOT NULL default '0',
  `tls` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `index_auth_sources_on_id_and_type` (`id`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `auth_sources`
--


-- --------------------------------------------------------

--
-- Structure de la table `boards`
--

DROP TABLE IF EXISTS `boards`;
CREATE TABLE IF NOT EXISTS `boards` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL default '',
  `description` varchar(255) default NULL,
  `position` int(11) default '1',
  `topics_count` int(11) NOT NULL default '0',
  `messages_count` int(11) NOT NULL default '0',
  `last_message_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `boards_project_id` (`project_id`),
  KEY `index_boards_on_last_message_id` (`last_message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `boards`
--


-- --------------------------------------------------------

--
-- Structure de la table `changes`
--

DROP TABLE IF EXISTS `changes`;
CREATE TABLE IF NOT EXISTS `changes` (
  `id` int(11) NOT NULL auto_increment,
  `changeset_id` int(11) NOT NULL,
  `action` varchar(1) NOT NULL default '',
  `path` text NOT NULL,
  `from_path` text,
  `from_revision` varchar(255) default NULL,
  `revision` varchar(255) default NULL,
  `branch` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `changesets_changeset_id` (`changeset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `changes`
--


-- --------------------------------------------------------

--
-- Structure de la table `changesets`
--

DROP TABLE IF EXISTS `changesets`;
CREATE TABLE IF NOT EXISTS `changesets` (
  `id` int(11) NOT NULL auto_increment,
  `repository_id` int(11) NOT NULL,
  `revision` varchar(255) NOT NULL,
  `committer` varchar(255) default NULL,
  `committed_on` datetime NOT NULL,
  `comments` text,
  `commit_date` date default NULL,
  `scmid` varchar(255) default NULL,
  `user_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `changesets_repos_rev` (`repository_id`,`revision`),
  KEY `index_changesets_on_user_id` (`user_id`),
  KEY `index_changesets_on_repository_id` (`repository_id`),
  KEY `index_changesets_on_committed_on` (`committed_on`),
  KEY `changesets_repos_scmid` (`repository_id`,`scmid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `changesets`
--


-- --------------------------------------------------------

--
-- Structure de la table `changesets_issues`
--

DROP TABLE IF EXISTS `changesets_issues`;
CREATE TABLE IF NOT EXISTS `changesets_issues` (
  `changeset_id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL,
  UNIQUE KEY `changesets_issues_ids` (`changeset_id`,`issue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `changesets_issues`
--


-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL auto_increment,
  `commented_type` varchar(30) NOT NULL default '',
  `commented_id` int(11) NOT NULL default '0',
  `author_id` int(11) NOT NULL default '0',
  `comments` text,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `index_comments_on_commented_id_and_commented_type` (`commented_id`,`commented_type`),
  KEY `index_comments_on_author_id` (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `comments`
--


-- --------------------------------------------------------

--
-- Structure de la table `custom_fields`
--

DROP TABLE IF EXISTS `custom_fields`;
CREATE TABLE IF NOT EXISTS `custom_fields` (
  `id` int(11) NOT NULL auto_increment,
  `type` varchar(30) NOT NULL default '',
  `name` varchar(30) NOT NULL default '',
  `field_format` varchar(30) NOT NULL default '',
  `possible_values` text,
  `regexp` varchar(255) default '',
  `min_length` int(11) NOT NULL default '0',
  `max_length` int(11) NOT NULL default '0',
  `is_required` tinyint(1) NOT NULL default '0',
  `is_for_all` tinyint(1) NOT NULL default '0',
  `is_filter` tinyint(1) NOT NULL default '0',
  `position` int(11) default '1',
  `searchable` tinyint(1) default '0',
  `default_value` text,
  `editable` tinyint(1) default '1',
  `visible` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `index_custom_fields_on_id_and_type` (`id`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `custom_fields`
--


-- --------------------------------------------------------

--
-- Structure de la table `custom_fields_projects`
--

DROP TABLE IF EXISTS `custom_fields_projects`;
CREATE TABLE IF NOT EXISTS `custom_fields_projects` (
  `custom_field_id` int(11) NOT NULL default '0',
  `project_id` int(11) NOT NULL default '0',
  KEY `index_custom_fields_projects_on_custom_field_id_and_project_id` (`custom_field_id`,`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `custom_fields_projects`
--


-- --------------------------------------------------------

--
-- Structure de la table `custom_fields_trackers`
--

DROP TABLE IF EXISTS `custom_fields_trackers`;
CREATE TABLE IF NOT EXISTS `custom_fields_trackers` (
  `custom_field_id` int(11) NOT NULL default '0',
  `tracker_id` int(11) NOT NULL default '0',
  KEY `index_custom_fields_trackers_on_custom_field_id_and_tracker_id` (`custom_field_id`,`tracker_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `custom_fields_trackers`
--


-- --------------------------------------------------------

--
-- Structure de la table `custom_values`
--

DROP TABLE IF EXISTS `custom_values`;
CREATE TABLE IF NOT EXISTS `custom_values` (
  `id` int(11) NOT NULL auto_increment,
  `customized_type` varchar(30) NOT NULL default '',
  `customized_id` int(11) NOT NULL default '0',
  `custom_field_id` int(11) NOT NULL default '0',
  `value` text,
  PRIMARY KEY  (`id`),
  KEY `custom_values_customized` (`customized_type`,`customized_id`),
  KEY `index_custom_values_on_custom_field_id` (`custom_field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `custom_values`
--


-- --------------------------------------------------------

--
-- Structure de la table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` int(11) NOT NULL default '0',
  `category_id` int(11) NOT NULL default '0',
  `title` varchar(60) NOT NULL default '',
  `description` text,
  `created_on` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `documents_project_id` (`project_id`),
  KEY `index_documents_on_category_id` (`category_id`),
  KEY `index_documents_on_created_on` (`created_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `documents`
--


-- --------------------------------------------------------

--
-- Structure de la table `enabled_modules`
--

DROP TABLE IF EXISTS `enabled_modules`;
CREATE TABLE IF NOT EXISTS `enabled_modules` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` int(11) default NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `enabled_modules_project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `enabled_modules`
--


-- --------------------------------------------------------

--
-- Structure de la table `enumerations`
--

DROP TABLE IF EXISTS `enumerations`;
CREATE TABLE IF NOT EXISTS `enumerations` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `position` int(11) default '1',
  `is_default` tinyint(1) NOT NULL default '0',
  `type` varchar(255) default NULL,
  `active` tinyint(1) NOT NULL default '1',
  `project_id` int(11) default NULL,
  `parent_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `index_enumerations_on_project_id` (`project_id`),
  KEY `index_enumerations_on_id_and_type` (`id`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `enumerations`
--


-- --------------------------------------------------------

--
-- Structure de la table `groups_users`
--

DROP TABLE IF EXISTS `groups_users`;
CREATE TABLE IF NOT EXISTS `groups_users` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  UNIQUE KEY `groups_users_ids` (`group_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `groups_users`
--


-- --------------------------------------------------------

--
-- Structure de la table `issues`
--

DROP TABLE IF EXISTS `issues`;
CREATE TABLE IF NOT EXISTS `issues` (
  `id` int(11) NOT NULL auto_increment,
  `tracker_id` int(11) NOT NULL default '0',
  `project_id` int(11) NOT NULL default '0',
  `subject` varchar(255) NOT NULL default '',
  `description` text,
  `due_date` date default NULL,
  `category_id` int(11) default NULL,
  `status_id` int(11) NOT NULL default '0',
  `assigned_to_id` int(11) default NULL,
  `priority_id` int(11) NOT NULL default '0',
  `fixed_version_id` int(11) default NULL,
  `author_id` int(11) NOT NULL default '0',
  `lock_version` int(11) NOT NULL default '0',
  `created_on` datetime default NULL,
  `updated_on` datetime default NULL,
  `start_date` date default NULL,
  `done_ratio` int(11) NOT NULL default '0',
  `estimated_hours` float default NULL,
  `parent_id` int(11) default NULL,
  `root_id` int(11) default NULL,
  `lft` int(11) default NULL,
  `rgt` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `issues_project_id` (`project_id`),
  KEY `index_issues_on_status_id` (`status_id`),
  KEY `index_issues_on_category_id` (`category_id`),
  KEY `index_issues_on_assigned_to_id` (`assigned_to_id`),
  KEY `index_issues_on_fixed_version_id` (`fixed_version_id`),
  KEY `index_issues_on_tracker_id` (`tracker_id`),
  KEY `index_issues_on_priority_id` (`priority_id`),
  KEY `index_issues_on_author_id` (`author_id`),
  KEY `index_issues_on_created_on` (`created_on`),
  KEY `index_issues_on_root_id_and_lft_and_rgt` (`root_id`,`lft`,`rgt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `issues`
--


-- --------------------------------------------------------

--
-- Structure de la table `issue_categories`
--

DROP TABLE IF EXISTS `issue_categories`;
CREATE TABLE IF NOT EXISTS `issue_categories` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` int(11) NOT NULL default '0',
  `name` varchar(30) NOT NULL default '',
  `assigned_to_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `issue_categories_project_id` (`project_id`),
  KEY `index_issue_categories_on_assigned_to_id` (`assigned_to_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `issue_categories`
--


-- --------------------------------------------------------

--
-- Structure de la table `issue_relations`
--

DROP TABLE IF EXISTS `issue_relations`;
CREATE TABLE IF NOT EXISTS `issue_relations` (
  `id` int(11) NOT NULL auto_increment,
  `issue_from_id` int(11) NOT NULL,
  `issue_to_id` int(11) NOT NULL,
  `relation_type` varchar(255) NOT NULL default '',
  `delay` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `index_issue_relations_on_issue_from_id` (`issue_from_id`),
  KEY `index_issue_relations_on_issue_to_id` (`issue_to_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `issue_relations`
--


-- --------------------------------------------------------

--
-- Structure de la table `issue_statuses`
--

DROP TABLE IF EXISTS `issue_statuses`;
CREATE TABLE IF NOT EXISTS `issue_statuses` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `is_closed` tinyint(1) NOT NULL default '0',
  `is_default` tinyint(1) NOT NULL default '0',
  `position` int(11) default '1',
  `default_done_ratio` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `index_issue_statuses_on_position` (`position`),
  KEY `index_issue_statuses_on_is_closed` (`is_closed`),
  KEY `index_issue_statuses_on_is_default` (`is_default`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `issue_statuses`
--


-- --------------------------------------------------------

--
-- Structure de la table `journals`
--

DROP TABLE IF EXISTS `journals`;
CREATE TABLE IF NOT EXISTS `journals` (
  `id` int(11) NOT NULL auto_increment,
  `journalized_id` int(11) NOT NULL default '0',
  `journalized_type` varchar(30) NOT NULL default '',
  `user_id` int(11) NOT NULL default '0',
  `notes` text,
  `created_on` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `journals_journalized_id` (`journalized_id`,`journalized_type`),
  KEY `index_journals_on_user_id` (`user_id`),
  KEY `index_journals_on_journalized_id` (`journalized_id`),
  KEY `index_journals_on_created_on` (`created_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `journals`
--


-- --------------------------------------------------------

--
-- Structure de la table `journal_details`
--

DROP TABLE IF EXISTS `journal_details`;
CREATE TABLE IF NOT EXISTS `journal_details` (
  `id` int(11) NOT NULL auto_increment,
  `journal_id` int(11) NOT NULL default '0',
  `property` varchar(30) NOT NULL default '',
  `prop_key` varchar(30) NOT NULL default '',
  `old_value` varchar(255) default NULL,
  `value` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `journal_details_journal_id` (`journal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `journal_details`
--


-- --------------------------------------------------------

--
-- Structure de la table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `project_id` int(11) NOT NULL default '0',
  `created_on` datetime default NULL,
  `mail_notification` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `index_members_on_user_id_and_project_id` (`user_id`,`project_id`),
  KEY `index_members_on_user_id` (`user_id`),
  KEY `index_members_on_project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `members`
--


-- --------------------------------------------------------

--
-- Structure de la table `member_roles`
--

DROP TABLE IF EXISTS `member_roles`;
CREATE TABLE IF NOT EXISTS `member_roles` (
  `id` int(11) NOT NULL auto_increment,
  `member_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `inherited_from` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `index_member_roles_on_member_id` (`member_id`),
  KEY `index_member_roles_on_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `member_roles`
--


-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL auto_increment,
  `board_id` int(11) NOT NULL,
  `parent_id` int(11) default NULL,
  `subject` varchar(255) NOT NULL default '',
  `content` text,
  `author_id` int(11) default NULL,
  `replies_count` int(11) NOT NULL default '0',
  `last_reply_id` int(11) default NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `locked` tinyint(1) default '0',
  `sticky` int(11) default '0',
  PRIMARY KEY  (`id`),
  KEY `messages_board_id` (`board_id`),
  KEY `messages_parent_id` (`parent_id`),
  KEY `index_messages_on_last_reply_id` (`last_reply_id`),
  KEY `index_messages_on_author_id` (`author_id`),
  KEY `index_messages_on_created_on` (`created_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `messages`
--


-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` int(11) default NULL,
  `title` varchar(60) NOT NULL default '',
  `summary` varchar(255) default '',
  `description` text,
  `author_id` int(11) NOT NULL default '0',
  `created_on` datetime default NULL,
  `comments_count` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `news_project_id` (`project_id`),
  KEY `index_news_on_author_id` (`author_id`),
  KEY `index_news_on_created_on` (`created_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `news`
--


-- --------------------------------------------------------

--
-- Structure de la table `open_id_authentication_associations`
--

DROP TABLE IF EXISTS `open_id_authentication_associations`;
CREATE TABLE IF NOT EXISTS `open_id_authentication_associations` (
  `id` int(11) NOT NULL auto_increment,
  `issued` int(11) default NULL,
  `lifetime` int(11) default NULL,
  `handle` varchar(255) default NULL,
  `assoc_type` varchar(255) default NULL,
  `server_url` blob,
  `secret` blob,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `open_id_authentication_associations`
--


-- --------------------------------------------------------

--
-- Structure de la table `open_id_authentication_nonces`
--

DROP TABLE IF EXISTS `open_id_authentication_nonces`;
CREATE TABLE IF NOT EXISTS `open_id_authentication_nonces` (
  `id` int(11) NOT NULL auto_increment,
  `timestamp` int(11) NOT NULL,
  `server_url` varchar(255) default NULL,
  `salt` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `open_id_authentication_nonces`
--


-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `description` text,
  `homepage` varchar(255) default '',
  `is_public` tinyint(1) NOT NULL default '1',
  `parent_id` int(11) default NULL,
  `created_on` datetime default NULL,
  `updated_on` datetime default NULL,
  `identifier` varchar(255) default NULL,
  `status` int(11) NOT NULL default '1',
  `lft` int(11) default NULL,
  `rgt` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `index_projects_on_lft` (`lft`),
  KEY `index_projects_on_rgt` (`rgt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `projects`
--


-- --------------------------------------------------------

--
-- Structure de la table `projects_trackers`
--

DROP TABLE IF EXISTS `projects_trackers`;
CREATE TABLE IF NOT EXISTS `projects_trackers` (
  `project_id` int(11) NOT NULL default '0',
  `tracker_id` int(11) NOT NULL default '0',
  UNIQUE KEY `projects_trackers_unique` (`project_id`,`tracker_id`),
  KEY `projects_trackers_project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `projects_trackers`
--


-- --------------------------------------------------------

--
-- Structure de la table `queries`
--

DROP TABLE IF EXISTS `queries`;
CREATE TABLE IF NOT EXISTS `queries` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` int(11) default NULL,
  `name` varchar(255) NOT NULL default '',
  `filters` text,
  `user_id` int(11) NOT NULL default '0',
  `is_public` tinyint(1) NOT NULL default '0',
  `column_names` text,
  `sort_criteria` text,
  `group_by` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `index_queries_on_project_id` (`project_id`),
  KEY `index_queries_on_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `queries`
--


-- --------------------------------------------------------

--
-- Structure de la table `repositories`
--

DROP TABLE IF EXISTS `repositories`;
CREATE TABLE IF NOT EXISTS `repositories` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` int(11) NOT NULL default '0',
  `url` varchar(255) NOT NULL default '',
  `login` varchar(60) default '',
  `password` varchar(60) default '',
  `root_url` varchar(255) default '',
  `type` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `index_repositories_on_project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `repositories`
--


-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `position` int(11) default '1',
  `assignable` tinyint(1) default '1',
  `builtin` int(11) NOT NULL default '0',
  `permissions` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `position`, `assignable`, `builtin`, `permissions`) VALUES
(1, 'Non member', 1, 1, 1, NULL),
(2, 'Anonymous', 2, 1, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `schema_migrations`
--

DROP TABLE IF EXISTS `schema_migrations`;
CREATE TABLE IF NOT EXISTS `schema_migrations` (
  `version` varchar(255) NOT NULL,
  UNIQUE KEY `unique_schema_migrations` (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `schema_migrations`
--

INSERT INTO `schema_migrations` (`version`) VALUES
('1'),
('10'),
('100'),
('101'),
('102'),
('103'),
('104'),
('105'),
('106'),
('107'),
('108'),
('11'),
('12'),
('13'),
('14'),
('15'),
('16'),
('17'),
('18'),
('19'),
('2'),
('20'),
('20090214190337'),
('20090312172426'),
('20090312194159'),
('20090318181151'),
('20090323224724'),
('20090401221305'),
('20090401231134'),
('20090403001910'),
('20090406161854'),
('20090425161243'),
('20090503121501'),
('20090503121505'),
('20090503121510'),
('20090614091200'),
('20090704172350'),
('20090704172355'),
('20090704172358'),
('20091010093521'),
('20091017212227'),
('20091017212457'),
('20091017212644'),
('20091017212938'),
('20091017213027'),
('20091017213113'),
('20091017213151'),
('20091017213228'),
('20091017213257'),
('20091017213332'),
('20091017213444'),
('20091017213536'),
('20091017213642'),
('20091017213716'),
('20091017213757'),
('20091017213835'),
('20091017213910'),
('20091017214015'),
('20091017214107'),
('20091017214136'),
('20091017214236'),
('20091017214308'),
('20091017214336'),
('20091017214406'),
('20091017214440'),
('20091017214519'),
('20091017214611'),
('20091017214644'),
('20091017214720'),
('20091017214750'),
('20091025163651'),
('20091108092559'),
('20091114105931'),
('20091123212029'),
('20091205124427'),
('20091220183509'),
('20091220183727'),
('20091220184736'),
('20091225164732'),
('20091227112908'),
('20100129193402'),
('20100129193813'),
('20100221100219'),
('20100313132032'),
('20100313171051'),
('20100705164950'),
('20100819172912'),
('20101104182107'),
('20101107130441'),
('20101114115114'),
('20101114115359'),
('21'),
('22'),
('23'),
('24'),
('25'),
('26'),
('27'),
('28'),
('29'),
('3'),
('30'),
('31'),
('32'),
('33'),
('34'),
('35'),
('36'),
('37'),
('38'),
('39'),
('4'),
('40'),
('41'),
('42'),
('43'),
('44'),
('45'),
('46'),
('47'),
('48'),
('49'),
('5'),
('50'),
('51'),
('52'),
('53'),
('54'),
('55'),
('56'),
('57'),
('58'),
('59'),
('6'),
('60'),
('61'),
('62'),
('63'),
('64'),
('65'),
('66'),
('67'),
('68'),
('69'),
('7'),
('70'),
('71'),
('72'),
('73'),
('74'),
('75'),
('76'),
('77'),
('78'),
('79'),
('8'),
('80'),
('81'),
('82'),
('83'),
('84'),
('85'),
('86'),
('87'),
('88'),
('89'),
('9'),
('90'),
('91'),
('92'),
('93'),
('94'),
('95'),
('96'),
('97'),
('98'),
('99');

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `value` text,
  `updated_on` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `index_settings_on_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `settings`
--


-- --------------------------------------------------------

--
-- Structure de la table `time_entries`
--

DROP TABLE IF EXISTS `time_entries`;
CREATE TABLE IF NOT EXISTS `time_entries` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `issue_id` int(11) default NULL,
  `hours` float NOT NULL,
  `comments` varchar(255) default NULL,
  `activity_id` int(11) NOT NULL,
  `spent_on` date NOT NULL,
  `tyear` int(11) NOT NULL,
  `tmonth` int(11) NOT NULL,
  `tweek` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `time_entries_project_id` (`project_id`),
  KEY `time_entries_issue_id` (`issue_id`),
  KEY `index_time_entries_on_activity_id` (`activity_id`),
  KEY `index_time_entries_on_user_id` (`user_id`),
  KEY `index_time_entries_on_created_on` (`created_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `time_entries`
--


-- --------------------------------------------------------

--
-- Structure de la table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `action` varchar(30) NOT NULL default '',
  `value` varchar(40) NOT NULL default '',
  `created_on` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `index_tokens_on_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `tokens`
--


-- --------------------------------------------------------

--
-- Structure de la table `trackers`
--

DROP TABLE IF EXISTS `trackers`;
CREATE TABLE IF NOT EXISTS `trackers` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `is_in_chlog` tinyint(1) NOT NULL default '0',
  `position` int(11) default '1',
  `is_in_roadmap` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `trackers`
--


-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(30) NOT NULL default '',
  `hashed_password` varchar(40) NOT NULL default '',
  `firstname` varchar(30) NOT NULL default '',
  `lastname` varchar(30) NOT NULL default '',
  `mail` varchar(60) NOT NULL default '',
  `admin` tinyint(1) NOT NULL default '0',
  `status` int(11) NOT NULL default '1',
  `last_login_on` datetime default NULL,
  `language` varchar(5) default '',
  `auth_source_id` int(11) default NULL,
  `created_on` datetime default NULL,
  `updated_on` datetime default NULL,
  `type` varchar(255) default NULL,
  `identity_url` varchar(255) default NULL,
  `mail_notification` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `index_users_on_id_and_type` (`id`,`type`),
  KEY `index_users_on_auth_source_id` (`auth_source_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `hashed_password`, `firstname`, `lastname`, `mail`, `admin`, `status`, `last_login_on`, `language`, `auth_source_id`, `created_on`, `updated_on`, `type`, `identity_url`, `mail_notification`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Redmine', 'Admin', 'admin@example.net', 1, 1, NULL, 'en', NULL, '2010-12-14 19:02:04', '2010-12-14 19:02:04', 'User', NULL, 'all');

-- --------------------------------------------------------

--
-- Structure de la table `user_preferences`
--

DROP TABLE IF EXISTS `user_preferences`;
CREATE TABLE IF NOT EXISTS `user_preferences` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `others` text,
  `hide_mail` tinyint(1) default '0',
  `time_zone` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `index_user_preferences_on_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `user_preferences`
--


-- --------------------------------------------------------

--
-- Structure de la table `versions`
--

DROP TABLE IF EXISTS `versions`;
CREATE TABLE IF NOT EXISTS `versions` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` int(11) NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `description` varchar(255) default '',
  `effective_date` date default NULL,
  `created_on` datetime default NULL,
  `updated_on` datetime default NULL,
  `wiki_page_title` varchar(255) default NULL,
  `status` varchar(255) default 'open',
  `sharing` varchar(255) NOT NULL default 'none',
  PRIMARY KEY  (`id`),
  KEY `versions_project_id` (`project_id`),
  KEY `index_versions_on_sharing` (`sharing`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `versions`
--


-- --------------------------------------------------------

--
-- Structure de la table `watchers`
--

DROP TABLE IF EXISTS `watchers`;
CREATE TABLE IF NOT EXISTS `watchers` (
  `id` int(11) NOT NULL auto_increment,
  `watchable_type` varchar(255) NOT NULL default '',
  `watchable_id` int(11) NOT NULL default '0',
  `user_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `watchers_user_id_type` (`user_id`,`watchable_type`),
  KEY `index_watchers_on_user_id` (`user_id`),
  KEY `index_watchers_on_watchable_id_and_watchable_type` (`watchable_id`,`watchable_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `watchers`
--


-- --------------------------------------------------------

--
-- Structure de la table `wikis`
--

DROP TABLE IF EXISTS `wikis`;
CREATE TABLE IF NOT EXISTS `wikis` (
  `id` int(11) NOT NULL auto_increment,
  `project_id` int(11) NOT NULL,
  `start_page` varchar(255) NOT NULL,
  `status` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `wikis_project_id` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `wikis`
--


-- --------------------------------------------------------

--
-- Structure de la table `wiki_contents`
--

DROP TABLE IF EXISTS `wiki_contents`;
CREATE TABLE IF NOT EXISTS `wiki_contents` (
  `id` int(11) NOT NULL auto_increment,
  `page_id` int(11) NOT NULL,
  `author_id` int(11) default NULL,
  `text` longtext,
  `comments` varchar(255) default '',
  `updated_on` datetime NOT NULL,
  `version` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `wiki_contents_page_id` (`page_id`),
  KEY `index_wiki_contents_on_author_id` (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `wiki_contents`
--


-- --------------------------------------------------------

--
-- Structure de la table `wiki_content_versions`
--

DROP TABLE IF EXISTS `wiki_content_versions`;
CREATE TABLE IF NOT EXISTS `wiki_content_versions` (
  `id` int(11) NOT NULL auto_increment,
  `wiki_content_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `author_id` int(11) default NULL,
  `data` longblob,
  `compression` varchar(6) default '',
  `comments` varchar(255) default '',
  `updated_on` datetime NOT NULL,
  `version` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `wiki_content_versions_wcid` (`wiki_content_id`),
  KEY `index_wiki_content_versions_on_updated_on` (`updated_on`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `wiki_content_versions`
--


-- --------------------------------------------------------

--
-- Structure de la table `wiki_pages`
--

DROP TABLE IF EXISTS `wiki_pages`;
CREATE TABLE IF NOT EXISTS `wiki_pages` (
  `id` int(11) NOT NULL auto_increment,
  `wiki_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `protected` tinyint(1) NOT NULL default '0',
  `parent_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `wiki_pages_wiki_id_title` (`wiki_id`,`title`),
  KEY `index_wiki_pages_on_wiki_id` (`wiki_id`),
  KEY `index_wiki_pages_on_parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `wiki_pages`
--


-- --------------------------------------------------------

--
-- Structure de la table `wiki_redirects`
--

DROP TABLE IF EXISTS `wiki_redirects`;
CREATE TABLE IF NOT EXISTS `wiki_redirects` (
  `id` int(11) NOT NULL auto_increment,
  `wiki_id` int(11) NOT NULL,
  `title` varchar(255) default NULL,
  `redirects_to` varchar(255) default NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `wiki_redirects_wiki_id_title` (`wiki_id`,`title`),
  KEY `index_wiki_redirects_on_wiki_id` (`wiki_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `wiki_redirects`
--


-- --------------------------------------------------------

--
-- Structure de la table `workflows`
--

DROP TABLE IF EXISTS `workflows`;
CREATE TABLE IF NOT EXISTS `workflows` (
  `id` int(11) NOT NULL auto_increment,
  `tracker_id` int(11) NOT NULL default '0',
  `old_status_id` int(11) NOT NULL default '0',
  `new_status_id` int(11) NOT NULL default '0',
  `role_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `wkfs_role_tracker_old_status` (`role_id`,`tracker_id`,`old_status_id`),
  KEY `index_workflows_on_old_status_id` (`old_status_id`),
  KEY `index_workflows_on_role_id` (`role_id`),
  KEY `index_workflows_on_new_status_id` (`new_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `workflows`
--


