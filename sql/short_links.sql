create table short_links(
                         id int auto_increment,
                         link varchar(255) not null unique,
                         short_link varchar(255) not null,
                         created_at timestamp default current_timestamp,
                         primary key(id)
);