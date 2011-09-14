create table user
(username varchar(20) not null primary key,
password varchar(20) not null,
sex enum('男','女','保密') default '保密',
info varchar(100)
)engine=MyISAM default charset=utf8;

create table message
(time varchar(30) default '0000-00-00',
content varchar(100),
permission enum('公开','私密') default '公开',
username varchar(20),
id int(10) not null auto_increment unique
)engine=MyISAM default charset=utf8;

create table reply
(rmid int(10) unsigned not null auto_increment primary key,
rid int(10) unsigned not null,
rcontent varchar(100) not null,
rusername varchar(20) not null,
rtime varchar(30) not null
)engine=MyISAM default charset=utf8;