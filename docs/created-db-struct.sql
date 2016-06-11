create database gift_certificates;
use gift_certificates;
create table gift_certificates
(
	id int not null auto_increment primary key, 
	amount decimal (6,2) not null, 
	cost decimal (6,2) null, 
	theme varchar(50) not null,
	message varchar(250), 
	recipeint_email varchar(50)
);