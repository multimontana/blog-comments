CREATE TABLE IF NOT EXISTS `comments` (
    id int(10) NOT NULL auto_increment,
    email varchar(100) collate utf8_unicode_ci  NOT NULL,
    name varchar(100) collate utf8_unicode_ci  NOT NULL,
    subject varchar(255) collate utf8_unicode_ci NOT NULL,
    comment text collate utf8_unicode_ci NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY  (id)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
