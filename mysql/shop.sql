create table cats(
	id int not null auto_increment,
	pid int not null default '0',
	name varchar(60) not null default '',
	desn text not null default '',
	primary key(id),
	index name(name,pid)
);

create table products(
	id int not null auto_increment,
	cid int not null default '0',
	name varchar(60) not null default '',
	price double(7,2) not null default '0.00',
	num int not null default '0',
	desn text,
	ptime int not null default '0',
	primary key(id),
	key pname(name, price)
);

insert into 
products(cid, name, price, num, desn, ptime)
values(1, 'javajava', '34.5', '10', 'good', '2132131321'),
(1, 'javatwo', '414.56', '30', 'very good', '123213213321'),
(2, 'javaone', '441.56', '50', 'very good', '123213213321'),
(2, 'j2seaaa', '144.56', '30', 'very good', '123213213321'),
(3, 'j2messs', '44.56', '30', 'very good', '123213213321'),
(3, 'fdsa', '44.56', '30', 'very good', '123213213321'),
(3, 'ewewq', '84.56', '30', 'very good', '123213213321'),
(4, 'kjlk', '244.56', '8', 'very good', '123213213321'),
(4, 'lojkfds', '44.56', '30', 'veryod', '123213213321'),
(4, 'jklfds', '944.56', '30', 'very good', '123213213321'),
(4, 'fdsfds', '4444.56', '30', 'very good', '123213213321'),
(5, 'fdsfds', '544.56', '30', 'very good', '123213213321'),
(5, 'jwer', '44.56', '30', 'very good', '123213213321'),
(5, 'jfdsa', '44.56', '90', 'very good', '123213213321'),
(5, 'javatwado', '44.56', '30', 'very good', '123213213321'),
(5, 'jkjavatwo', '4324.56', '30', 'very good', '123213213321'),
(5, 'jadvatwo', '454.56', '30', 'very good', '123213213321'),
(6, 'javsdatwo', '44.56', '30', 'very good', '123213213321'),
(6, 'jawqvatwo', '454.56', '30', 'very good', '123213213321'),
(6, 'jacxzvatwo', '4.56', '30', 'very good', '123213213321'),
(6, 'javadsatwo', '44.56', '30', 'very good', '123213213321'),
(6, 'javdsaatwo', '494.56', '30', 'very good', '123213213321'),
(7, 'jadsavatwo', '48.56', '30', 'very good', '123213213321'),
(7, 'jawrewvatwo', '324.56', '30', 'very good', '123213213321'),
(8, 'javdasatwo', '4432.56', '30', 'very good', '123213213321'),
(8, 'jawqeqvatwo', '434.56', '30', 'very good', '123213213321'),
(8, 'jadewqewqvatwo', '442.56', '30', 'very good', '123213213321')
 

 select distinct name as bookmane,price as bookprice from products;
 select price*0.8 as new price from products
 select name,price*0.8 as newprice from products where id>5 &&id<20;
 select version() as mysql_version ,12,23*10 as expression
 select price ,name from products where price between 30 and 100;
 select price,name from products where id in (0,10,8,5);
 update products  set name='xiewei' where id in (0,10,8,5);
 delete from products where id in (0,10,8,5);	
 select *from products where name regexp'^j'; 	
 insert into cats values	(null,'0','soft','this is soft'),
 			(null,'1','java','this is java'),
 			(null,'1','c++','null'),
 			(null,'2','j2ee','null'),
 			(null,'2','j2se','null'),
 			(null,'2','j2me','null'),
 			(null,'3','php','null');
 select cats.name,cats.id ,profucts.id from cats,products;
 select c.name as cname,c.id as cid,p.id as pid from cats as c,products as p;
 select c.name as cname,c.id as cid,p.id as pid from cats as c,products as p where c.id=p.cid;
 select c.name as cname,c.id as cid,p.id as pid from cats as c,products as p where p.id=c.pid;
 select a.id as aid ,b.id as bid,a.name as aname ,b.name as name from cats as a ,cats as b where a.id=b.pid;
select *from cats where pid in (select id from cats where name like 'j%' );
select *from cats where pid in (select cid from products where name like 'j%' );
select *from products order by name;
select *from products order by name desc;
select *from products limit 5;
select *from products where id >5 order by id asc limit	 1,2;
select *from products where id <5  order by id desc limit 1;
select count(price),sum(price),avg(price),max(price),min(price) from products where name like 'j%';
select name,count(price),sum(price),avg(price),max(price),min(price) from products where name like 'j%' group by cid;
select name,price,count(price),sum(price),avg(price),max(price),min(price) from products group by cid having avg(price)>500;
select concat(name,'价格是',price) from products;
select name,insert(name ,2,1,'xiewei')as newone from products order by name desc;
select name,upper(insert(name ,2,1,'xiewei'))as newone from products order by name desc;
select name from products where upper(name)  regexp "(\d)+";
select lpad('hello world' ,5,'olleh');
select substring('1234567890',3,1);
select round(rand()*100) as round ,ceil(rand()*100) as ceil ,floor(rand()*100) as floor;
select truncate('123456,321','4');
select curtime() as time,now() as now ,unix_timestamp(now()) as nuix_timestamp,unix_timestamp(curtime()) as test; 
select from_unixtime(1437971607),week(from_unixtime(1437971607)),year(from_unixtime(1437971607)),month(from_unixtime(1437971607));
select year(now()),month(now()),day(now()),week(now()),now();
select year('2015-8-21'),month('2015-8-21'),day('2015-8-21'),week('2015-8-21'),now();
select date_format(now(),'%y-%m-%d %H:%i:%s');




create table salary(id int ,salary decimal(9,2));
insert into salary values(1,1000),(2,2000),(3,3000),(4,4000),(5,5000),(6,null);


select id,salary,if(salary>3000,'高工资','低工资') from gongzi where salary is not null;
select id ,salary ,ifnull(salary,'0.00') from gongzi;
select id ,salary ,ifnull(null,'0.00') from gongzi;
select case when salary<3000 then '低薪' else '高薪' end as first ,id , salary from gongzi;
select inet_aton('192.168.0.1'),inet_ntoa(3232235522);
select *from mysql.user \G;

CREATE TABLE groups( 
  id INT PRIMARY KEY AUTO_INCREMENT COMMENT 'id',
  user VARCHAR(200) COMMENT '用户',
)COMMENT='一个组'；
alter table shoppings add  num int(5) not null unsigned after price;
insert into shoppings (name ,price,num,desn) select name,price,num,desn from shoppings;


create table shoppings(
	id int not null auto_increment,
	name varchar(20) not null default ' ',
	price double(10,2) unsigned not null default '0.00',
	num int unsigned not null，
	desn text,
	primary key (id),
	key name(name,price)
);