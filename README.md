## Explanation

Task 1 
- The bug here is in the migration file while creating the notes table which defines the content column as ```not nullable``` but the requirements 
specifies the column could be. To resolve this, a new migration file was included to redefine the content column to longText and nullable. 

Note: run the command below to include the doctrine/dbal package to enable the change attribute in the migration file run successfully
```
composer require doctrine/dbal
```

Task 2
- New migration file defining the category.name and category.user_id stating which user created the category is created
- Corresponding controller is created for creating, editing and view one/ all categories by authenticated user is created

Task 3
- A pivot table is created for category and notes with a many to many relationship established between the notes and categories table
- A multi select tag is added to the notes create/ edit form page displaying all the categories created by currently logged in user
- On creation / update, the selected categories will be added to the pivot table defined earlier 


Using repositories and interfaces, these classes were injected to the controller class and inherited by the categorycontroller and notecontroller class
making use of the solid principle

Also, to maintain consistency across files, a redo of the noteController class was done to match the use of repository style in the CategoryController.

A duplicate of the original NoteController class was included with modifications as required for the task named ```NoteController2.php```


# Notes Application

A simple application, allowing for registration and logging in of users. Allowing them to store simple text notes no the system, and categorise them.

Currently the system allows users to store Notes, but not to add any personalised categories to the system, or to add them to the Note.

All Notes and Categories must only be visible to the user who created them.

A Note can comprise of the following:

- Title (required)
- Content (not required)
- Categories (none/multiple)

A Category can comprise of the following:

- Name

By running this command, you will migrate and populate the database with one test user (email: test@test.com, password: 123456), along with three Notes for the user.

```
php artisan migrate:fresh --seed
```


# Tasks

- There is currently a bug with saving a Note if it has no content. This needs to be fixed.
- Create the ability for a user to add/edit/view Categories to the system.
- Modify Notes to allow the user to assign any number of their own Categories to the Note.

### You do not need to worry about how it looks, focus on functionality.
