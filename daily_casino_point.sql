-- イベントスケジューラをオンにする
set GLOBAL event_scheduler=ON

delimiter $$
create event daily_casino_point_test
on schedule every 1 MINUTE
starts '2023-01-31 14:10:00'
do
update stand set upper_limit = FLOOR(5000 + RAND() * (100000)), lower_limit = -1 * FLOOR(5000 + RAND() * (100000));
$$
delimiter ;

delimiter $$
create event daily_casino_point
on schedule every 1 DAY
starts '2023-02-01 00:00:00'
do
update stand set upper_limit = FLOOR(5000 + RAND() * (100000)), lower_limit = -1 * FLOOR(5000 + RAND() * (100000));
$$
delimiter ;
