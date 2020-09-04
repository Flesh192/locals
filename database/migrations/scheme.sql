create table post
(
	id int auto_increment,
	user_id int not null,
	title varchar(255) not null,
	body text null,
	created_at int default 0 null,
	updated_at int default 0 null,
	constraint post_pk
		primary key (id)
);


create table user_mute
(
	user_id int not null,
	mute_id int not null,
	expired_at int default 0 null,
	constraint user_mute_pk
		primary key (user_id, mute_id)
);

create table user
(
	id int auto_increment,
	username int not null,
	created_at int default 0 null,
	updated_at int default 0 null,
	constraint user_pk
		primary key (id)
);

alter table post
	add constraint post_user_id_fk
		foreign key (user_id) references user (id);

alter table user_mute
	add constraint user_mute_user_id_fk
		foreign key (user_id) references user (id);

alter table user_mute
	add constraint user_mute_user_id_fk_2
		foreign key (mute_id) references user (id);
