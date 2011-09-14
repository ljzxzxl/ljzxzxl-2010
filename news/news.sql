create table news
(id int(10) not null primary key auto_increment,
title varchar(50) not null,
author varchar(50) not null,
time varchar(30)
)type=MyISAM default character set utf8 collate utf8_general_ci;

create table content
(cid int(10) unsigned not null,
brief varchar(200),
content varchar(3000)
)type=MyISAM default character set utf8 collate utf8_general_ci;