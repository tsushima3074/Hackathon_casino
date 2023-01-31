-- イベントスケジューラをオンにする
set GLOBAL event_scheduler=ON

delimiter $$
create event daily_point_test
on schedule every 1 MINUTE
starts '2023-01-31 14:10:00'
do
update account set point = point + 300;
$$
delimiter ;

delimiter $$
create event daily_point
on schedule every 1 DAY
starts '2023-02-01 00:00:00'
do
update account set point = point + 300;
$$
delimiter ;
