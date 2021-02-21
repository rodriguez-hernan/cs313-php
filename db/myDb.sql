-- PHP application database script

-- users table
create table Users (
	userID INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	userName varchar(30) NOT NULL,
	email varchar(30) UNIQUE NOT NULL,
)
ALTER TABLE Users ADD password varchar(255) NOT NULL;

-- MealTag
create table MealTag(
	mealTagID int GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	tagName varchar(50) UNIQUE NOT NULL
)

-- IngredientTag
create table IngredientTag(
	ingredientTagID int GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	tagName varchar(50) UNIQUE NOT NULL
);

-- Recipe
create table Recipe(
	recipeID int GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	title varchar(50) NOT NULL,
	processDescription text
);

-- many to many tables
-- UserRecipe
create table UserRecipe(
	userRecipeID int GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	userID int references Users(userID) NOT NULL,
	recipeID int references Recipe(recipeID) NOT NULL
);

ALTER TABLE UserRecipe ADD FOREIGN KEY (recipeID)
REFERENCES Recipe(recipeID) ON DELETE CASCADE;

-- RecipeMealTag
create table RecipeMealTag(
	recipeMealID int GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	recipeID int references Recipe(recipeID) NOT NULL,
	mealTagID int references MealTag(mealTagID) NOT NULL
);

ALTER TABLE RecipeMealTag ADD FOREIGN KEY (recipeID)
REFERENCES Recipe(recipeID) ON DELETE CASCADE;
ALTER TABLE RecipeMealTag ADD userID int references Users(userID);

-- recipeIngredientTag
create table recipeIngredientTag(
	recipeIngredientID int GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	ingredientTagID int references IngredientTag(ingredientTagID) NOT NULL,
	recipeID int references Recipe(recipeID) NOT NULL
);

ALTER TABLE recipeIngredientTag ADD FOREIGN KEY (recipeID)
REFERENCES Recipe(recipeID) ON DELETE CASCADE;
ALTER TABLE recipeIngredientTag ADD userID int references Users(userID);

-- add users
insert into users (username, email) values ('Russell Nelson', 'russell_n@byui.edu');
insert into users (username, email) values ('Dallin Oaks', 'dallin_o@byui.edu');

-- add MealTag
insert into MealTag (tagName) values ('Breakfast');
insert into MealTag (tagName) values ('Lunch');
insert into MealTag (tagName) values ('Dinner');
insert into MealTag (tagName) values ('Supper');


-- add MealTags
insert into IngredientTag (tagName) values ('Chicken');
insert into IngredientTag (tagName) values ('Pasta');
insert into IngredientTag (tagName) values ('Fish');
insert into IngredientTag (tagName) values ('Bread');
insert into IngredientTag (tagName) values ('Meat');
insert into IngredientTag (tagName) values ('Fruit');
insert into IngredientTag (tagName) values ('Vegetables');
insert into IngredientTag (tagName) values ('Eggs');

-- select all the recipes from a user (add a WHERE statement)
SELECT 
	rp.title, 
	rp.processDescription, 
	us.userName
FROM UserRecipe ur 
	JOIN Users us 
		using(userID) 
	JOIN Recipe rp 
		using(recipeID);
		
-- select all the tags from a recipe (add a WHERE statement)
SELECT 
	mt.tagName,
FROM RecipeMealTag rm 
	JOIN MealTag mt 
		using(recipeID)
	WHERE recipeID == '3';
	
SELECT 
	it.tagName,
FROM recipeIngredientTag ri 
	JOIN IngredientTag it 
		using(recipeID)
	WHERE recipeID == '3';
