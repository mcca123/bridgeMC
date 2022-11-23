#!/bin/bash

/bin/bash -c "/usr/sbin/sshd"

function exportBoolean {
    if [ "${!1}" = "**Boolean**" ]; then
            export ${1}=''
    else 
            export ${1}='Yes.'
    fi
}

exportBoolean LOG_STDOUT
exportBoolean LOG_STDERR

if [ $LOG_STDERR ]; then
    /bin/ln -sf /dev/stderr /var/log/apache2/error.log
else
	LOG_STDERR='No.'
fi

if [ $ALLOW_OVERRIDE == 'All' ]; then
    /bin/sed -i 's/AllowOverride\ None/AllowOverride\ All/g' /etc/apache2/apache2.conf
fi

if [ $LOG_LEVEL != 'warn' ]; then
    /bin/sed -i "s/LogLevel\ warn/LogLevel\ ${LOG_LEVEL}/g" /etc/apache2/apache2.conf
fi

# enable php short tags:
/bin/sed -i "s/short_open_tag\ \=\ Off/short_open_tag\ \=\ On/g" /etc/php/7.4/apache2/php.ini

# stdout server info:
if [ ! $LOG_STDOUT ]; then
cat << EOB
    
    SERVER SETTINGS
    ---------------
    · Redirect Apache access_log to STDOUT [LOG_STDOUT]: No.
    · Redirect Apache error_log to STDERR [LOG_STDERR]: $LOG_STDERR
    · Log Level [LOG_LEVEL]: $LOG_LEVEL
    · Allow override [ALLOW_OVERRIDE]: $ALLOW_OVERRIDE
    · PHP date timezone [DATE_TIMEZONE]: $DATE_TIMEZONE

EOB
else
    /bin/ln -sf /dev/stdout /var/log/apache2/access.log
fi

# Set PHP timezone
/bin/sed -i "s/\;date\.timezone\ \=/date\.timezone\ \=\ ${DATE_TIMEZONE}/" /etc/php/7.4/apache2/php.ini

# Run MariaDB
/usr/bin/mysqld_safe --timezone=${DATE_TIMEZONE}&

mysql -uroot -e "CREATE USER 'mccaDB'@localhost IDENTIFIED BY '1234'"
mysql -uroot -e "CREATE DATABASE loginadminuser"
mysql -uroot loginadminuser < /var/lib/mysql/loginadminuser.sql
mysql -uroot -e "GRANT ALL PRIVILEGES ON *.* TO 'mccaDB'@localhost WITH GRANT OPTION"
mysql -uroot -e "GRANT ALL PRIVILEGES ON loginadminuser.* TO 'mccaDB'@localhost"

# Run Apache:
if [ $LOG_LEVEL == 'debug' ]; then
    /usr/sbin/apachectl -k start -e debug
else
    &>/dev/null /usr/sbin/apachectl -k start
fi

/bin/bash -c "sleep infinity"