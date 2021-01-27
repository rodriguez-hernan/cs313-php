-- PHP application database script

-- users table
create table Users (
	userID INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	userName varchar(30) NOT NULL,
	email varchar(30) UNIQUE NOT NULL,
);

-- MealTag
create table MealTag(
	mealTagID int GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	tagName varchar(50) UNIQUE NOT NULL,
);

-- IngredientTag
create table IngredientTag(
	ingredientTagID int GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	tagName varchar(50) UNIQUE NOT NULL,
);

-- Recipe
create table Recipe(
	recipeID int GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	title varchar(50) NOT NULL,
	processDescription text,
);

-- many to many tables
-- UserRecipe
create table UserRecipe(
	userRecipeID int GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	userID int references Users(userID) NOT NULL,
	recipeID int references Recipe(recipeID) NOT NULL,
);

-- RecipeMealTag
create table RecipeMealTag(
	recipeMealID int GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	recipeID int references Recipe(recipeID) NOT NULL,
	mealTagID int references MealTag(mealTagID) NOT NULL,
);

-- recipeIngredientTag
create table recipeIngredientTag(
	recipeIngredientID int GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
	ingredientTagID int references IngredientTag(ingredientTagID) NOT NULL,
	recipeID int references Recipe(recipeID) NOT NULL,
);