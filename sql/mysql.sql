# phpMyAdmin MySQL-Dump
# version 2.2.2
# http://phpwizard.net/phpMyAdmin/
# http://phpmyadmin.sourceforge.net/ (download page)
#
# --------------------------------------------------------


#
# Table structure for table `lan`
#

CREATE TABLE lan (
    id                  INT(9)      DEFAULT '0' NOT NULL AUTO_INCREMENT,
    version             VARCHAR(50)             NOT NULL,
    peoplegoinglisttext VARCHAR(60)             NOT NULL,
    goingselect         VARCHAR(60)             NOT NULL,
    notgoingselect      VARCHAR(60)             NOT NULL,
    goingwelcome        VARCHAR(80) DEFAULT '0' NOT NULL,
    notgoingwelcome     VARCHAR(80)             NOT NULL,
    eventdate           VARCHAR(60)             NOT NULL,
    location            TEXT                    NOT NULL,
    details             TEXT                    NOT NULL,
    games               TEXT                    NOT NULL,
    requirments         TEXT                    NOT NULL,
    rules               TEXT                    NOT NULL,
    suggestions         TEXT                    NOT NULL,
    adminemail          VARCHAR(90)             NOT NULL,
    PRIMARY KEY (id)
)
    ENGINE = ISAM;

INSERT INTO lan
VALUES (1, 'version', 'peoplegoinglisttext', 'goingselect', 'notgoingselect', 'goingwelcome', 'notgoingwelcome', 'eventdate', 'location', 'details', 'games', 'requirments', 'rules', 'suggestions', 'adminemail');

#
# Table structure for table `lan_spons`
#

CREATE TABLE lan_spons (
    id         INT(9) DEFAULT '0' NOT NULL AUTO_INCREMENT,
    name       VARCHAR(50)        NOT NULL,
    bannerurl  VARCHAR(100)       NOT NULL,
    linkurl    VARCHAR(100)       NOT NULL,
    bannertext TEXT               NOT NULL,
    PRIMARY KEY (id)
)
    ENGINE = ISAM;

#
# Table structure for table `lan_going`
#

CREATE TABLE lan_going (
    id     INT(9) DEFAULT '0' NOT NULL AUTO_INCREMENT,
    userid VARCHAR(50) UNIQUE NOT NULL,
    PRIMARY KEY (id)
)
    ENGINE = ISAM;

#
# Table structure for table `lan_blockinfo`
#

CREATE TABLE lan_blockinfo (
    id        INT(9) DEFAULT '0' NOT NULL AUTO_INCREMENT,
    date      VARCHAR(50)        NOT NULL,
    regstatus VARCHAR(10)        NOT NULL,
    PRIMARY KEY (id)
)
    ENGINE = ISAM;

INSERT INTO lan_blockinfo
VALUES (1, 'Aug 30th', 'Open');
