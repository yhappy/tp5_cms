CREATE TABLE 'cms_admin' (
  'admin_id'      MEDIUMINT(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  'username'      VARCHAR(20)           NOT NULL DEFAULT '',
  'password'      VARCHAR(32)           NOT NULL DEFAULT '',
  'lastlogintime' VARCHAR(15)                    DEFAULT '0',
  'email'         VARCHAR(40)                    DEFAULT '',
  'realname'      VARCHAR(50)           NOT NULL DEFAULT '',
  'status'        TINYINT(1)            NOT null DEFAULT '1',
  PRIMARY KEY ('admin_id'),
  KEY 'username' ('username')
)
  ENGINE = MyISAM
  AUTO_INCREMENT = 1
  DEFAULT CHARSET = utf8;

CREATE TABLE 'cms_menu' (
  'menu_id'   smallint(6) unsigned not null auto_increment,
  'name'      varchar(40)          not null default '',
  'parentid'  smallint(6)          not null default '0',
  'm'         varchar(20)          not null default '',
  'c'         varchar(20)          not null default '',
  'f'         varchar(20)          not null default '',
  'listorder' smallint(6) unsigned not null default '0',
  'status'    tinyint(1)           not null default '0',
  'type'      tinyint(1) unsigned  not null default '0',
  primary key ('menu_id'),
  key 'listorder' ('listorder'),
  key 'parentid' ('parentid'),
  key 'module' ('m', 'c', 'f')
)
  engine = MyISAM
  auto_increment = 1
  default charset = utf8;

create table 'cms_news' (
  'news_id'          mediumint(8) unsigned not null auto_increment,
  'catid'            smallint(5) unsigned  not null default '0',
  'title'            varchar(80)           not null default '0',
  'small_title'      varchar(30)           not null default '',
  'title_font_color' varchar(250)                   default null comment 'title_color',
  'thumb'            varchar(100)          not null default '',
  'keywords'         char(40)              not null default '',
  'description'      varchar(250)          not null comment 'news_description',
  'listorder'        tinyint(3) unsigned   not null default '0',
  'status'           tinyint(1)            not null default '1',
  'copyfrom' varchar(250) default null comment 'new_copyright',
  'username' char(20) not null ,
  'createtime' int(10) unsigned not null default '0',
  'updatetime' int(10) unsigned not null default '0',
  'count' int(10) unsigned not null default '0',
  primary key ('news_id'),
  key 'listorder' ('listorder'),
  key 'catid' ('catid'),
)
  engine = MyISAM
  auto_increment=1
  default charset=utf8;

/*
新闻文章内容附表
 */
create table 'cms_news_content'(
  'id' mediumint(8) unsigned not null auto_increment,
  'news_id' mediumint(8) unsigned not null ,
  'content' mediumtext not null,
  'create_time' int(10) unsigned not null default '0',
  'update_time' int(10) unsigned not null default '0',
  primary key ('id'),
  key 'news_id' ('news_id'),
)
  engine=MyISAM
  auto_increment = 1
  default charset=utf8;

/*
推荐位主表
 */
create table 'cms_position' (
  'id' smallint(5) unsigned not null auto_increment,
  'name' char(30) not null default '',
  'status' tinyint(1) not null default '1',
  'description' char(100) default null ,
  'create_time' int(10) unsigned not null default '0',
  'update_time' int(10) unsigned not null default '0',
  primary key ('id')
)
  engine=MyISAM
  auto_increment = 1
  default charset=utf8;

/*
推荐位内容附表
 */
create table 'cms_position_content' (
  'id' smallint(5) unsigned not null auto_increment,
  'position_id' int(5) unsigned not null ,
  'title' varchar(30) not null default '',
  'thumb' varchar(100) not null default '',
  'url' varchar(100) default null ,
  'news_id' mediumint(8) unsigned not null ,
  'listorder' tinyint(3) unsigned not null default '0',
  'status' tinyint(1) not null default '1',
  'create_time' int(10) unsigned not null default '0',
  'update_time' int(10) unsigned not null default '0',
  primary key ('id'),
  key 'position_id' ('position_id')
)
  engine=MyISAM
  auto_increment = 1
  default charset=utf8;






