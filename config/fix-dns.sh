#!/bin/bash
# Добавляем внешние DNS, но СОХРАНЯЕМ внутренний Docker DNS (127.0.0.11)
# для резолва имён контейнеров (db, wordpress и т.д.)
echo "nameserver 127.0.0.11" > /etc/resolv.conf
echo "nameserver 8.8.8.8" >> /etc/resolv.conf
echo "nameserver 8.8.4.4" >> /etc/resolv.conf
echo "options ndots:0" >> /etc/resolv.conf
exec docker-entrypoint.sh "$@"
