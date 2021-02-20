--Create a sign-up page that asks for a username and password, and then inserts this into the database.


CREATE TABLE users (
	id SERIAL primary key,
	username varchar(255),
	password varchar(255),
)