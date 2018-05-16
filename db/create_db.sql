drop database if exists auto;

create database auto
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

use auto;

create table users(
  id int primary key auto_increment,
  email varchar(255) not null,
  password varchar(255) not null,
  salt varchar(255) not null,
  given_names varchar(255) not null,
  surname varchar(255) not null,
  admin tinyint(1) not null default 0,
  date_of_birth date not null,
  mechanic tinyint(1) not null default 0
);

insert into users(email, password, salt, given_names, surname, admin, date_of_birth, mechanic)
       values ('benedekb97@gmail.com', '5486f8367ac8bdfb8bedaac87de58507eaf86291', 'tWavjtFRtSIc9ptM7k8kEiWUWhd5mXRy', 'Benedek Peter', 'Burgess', 1, '1997-01-22', 1);
insert into users(email, password, salt, given_names, surname, admin, date_of_birth, mechanic)
       values ('domi.burgess@gmail.com', '5486f8367ac8bdfb8bedaac87de58507eaf86291', 'tWavjtFRtSIc9ptM7k8kEiWUWhd5mXRy', 'Dominik Árpád', 'Burgess', 0, '1998-05-14', 1);

create table cars(
  id int primary key auto_increment,
  type varchar(255) not null,
  age int not null,
  technical_exam_year int not null,
  owner_id int not null,

  foreign key (owner_id) references users(id)
);

insert into cars(type, age, technical_exam_year, owner_id) values ('Trabant 1.1 Kombi', 28, 2018, 1);
insert into cars(type, age, technical_exam_year, owner_id) values ('Renault Espace 2010', 8, 2019, 1);

create table services(
  id int primary key auto_increment,
  cost int not null default 0,
  description varchar(1024) null default null,
  fixer_id int not null,
  car_id int not null,

  foreign key (fixer_id) references users(id),
  foreign key (car_id) references cars(id)
);

insert into services(cost, description, fixer_id, car_id) values (50000, 'Kuplung tárcsa csere', 2, 1);
insert into services(cost, description, fixer_id, car_id) values (30000, 'Légszűrőcsere', 2, 2);

