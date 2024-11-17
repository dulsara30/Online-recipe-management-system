---

# Online Recipe Management System  

## Project Overview  
The **Online Recipe Management System** is a simple yet effective web-based platform designed to streamline how users manage and explore recipes. Developed as part of a university project, this system offers an intuitive interface for users to upload, update, and manage recipes while providing an administrative layer for predefined administrators.  

---

## Features  

### User Features:  
- **Browse Recipes**: Explore a diverse collection of recipes with full details, including ingredients, preparation time, and cooking time.  
- **Search Recipes**: Find recipes by name or category using the search functionality.  
- **Save Recipes**: Mark favorite recipes for future reference.  
- **Manage Recipes**:  
  - **Add Recipes**: Users can upload their recipes with full details (e.g., ingredients, prep time, cook time).  
  - **Update Recipes**: Modify the details of recipes they have uploaded.  
  - **Delete Recipes**: Remove their recipes from the system.  

### Admin Features:  
- **Admin Panel**: Predefined administrators have access to an admin interface.  
- **Recipe Management**: View and manage all recipes in the system.  
- **User Monitoring**: Oversee user activity to ensure platform integrity.  

---

## Technologies Used  
- **Frontend**: HTML, CSS, JavaScript  
- **Backend**: PHP  
- **Database**: MySQL (via XAMPP)  

The system operates on a local XAMPP server, making it easy to deploy and test.  

---

## Installation Instructions  
To set up the Online Recipe Management System locally, follow these steps:  

1. **Clone the Repository**:  
   ```bash  
   git clone [repository-link]  
   cd [repository-folder]  
   ```  

2. **Set Up the Environment**:  
   - Install XAMPP from [XAMPP official website](https://www.apachefriends.org/).  
   - Start the Apache and MySQL modules in the XAMPP Control Panel.  

3. **Database Configuration**:  
   - Open phpMyAdmin (`http://localhost/phpmyadmin`).  
   - Create a database named `recipe_management`.  
   - Import the SQL file located in the `/database` folder of the project.  

4. **Update Configurations**:  
   - Open the `config.php` file and set the following:  
     ```php  
     $servername = "localhost";  
     $username = "root";  
     $password = "";  
     $dbname = "recipe_management";  
     ```  

5. **Launch the Application**:  
   - Place the project folder in the `htdocs` directory of XAMPP.  
   - Access the system in your browser at `http://localhost/[project-folder-name]`.  

---

## Usage Instructions  

### For Users:  
- **Browse Recipes**: View all available recipes on the homepage.  
- **Search Recipes**: Use the search bar to find recipes by name or category.  
- **Manage Recipes**:  
  - Add recipes by clicking the "Add Recipe" button.  
  - Edit existing recipes from your uploads.  
  - Delete unwanted recipes.  

### For Admins:  
- Access the admin interface to view and manage all recipes.  
- Admins are predefined, and only those with admin credentials can log in.  

---

## Future Improvements  
- User registration with roles to allow dynamic admin assignments.  
- Integration with recipe APIs to expand the recipe library.  
- Enhanced filtering options based on dietary preferences and ingredients.  
- Responsive design for better user experience on mobile devices.  

---

## License  
This project is licensed under the [MIT License](LICENSE).  

---

## Contact  
For any inquiries or contributions, reach out to:  
**Email**: dulsaramanakal@gmail.com  

--- 
