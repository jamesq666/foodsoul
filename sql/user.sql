create table user(
                         id int auto_increment,
                         email varchar(255) not null unique,
                         password varchar(255) not null,
                         hash varchar(255) not null,
                         email_confirmed tinyint(2) not null default '0',
                         created_at timestamp default current_timestamp,
                         primary key(id)
);