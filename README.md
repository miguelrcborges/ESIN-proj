# Web-JOnAS - Jolly Online Assistance for Students

**MADE:**
- Francisco Rodrigues Camões de Magalhães - [up202005141@fe.up.pt](mailto:up202005141@fe.up.pt)
- Miguel Rodrigues Carrilho Borges - [up202004481@fe.up.pt](mailto:up202004481@fe.up.pt)
- Tomás Pereira Curralo Cruz - [up202008274@fe.up.pt](mailto:up202008274@fe.up.pt)

**HOW TO RUN:**

1. Unzip `jonas.zip`.
2. Place the main folder at your desired location.
3. Open a PowerShell with administrator privileges at your desired location (to switch location, use the command `cd *your location*/jonas`).

**Database Setup:**
   - The project comes with a preset database named `db`, so you can skip this step.
   - However, if ou wish to initialize a database, two init files are provided:
      - `init.sql`: Initializes an empty database without data in any of the tables. No admins, courses, or UCs are present, limiting some website features.
      - `test_data.sql`: Initializes the same tables with a collection of users, UCs, questions, and other relevant data. Simulates the website's functionality with preloaded data.

   To run any of these scripts, use the following sequence of commands in PowerShell:
   ```powershell
   sqlite3 db
   .read sql/init.sql  # or .read sql/test_data.sql for test data
   ``` 

**Run with Docker:** 
4. Make sure your docker is running.
5. Run the command (with admin privileges!)
 ```powershell
 docker run -d -p 8080:8080 -it --name=php -v *your location*/jonas quay.io/vesica/php73:de
 ```
 
6. Open  your  browser  and  go  to  [http://localhost:8080](http://localhost:8080).
 

**All set! Now you can navigate the website using its internal navigation.**


**Login Information:**
   - Although creating a new account is an option, the test database comes preloaded with users, all with the password 'password'.
   - Log in with the username 'admin' or 'jonas' to access administrative features of the website.
