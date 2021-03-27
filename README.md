# OrderAndDeliverySystem
An order and delivery system (with management system) with HTML, PHP and MYSQL.
WHAT TO DO:
1. Create a database "OrderAndDeliverySystem" in PHPMyAdmin (if another name is desired, kindly edit line 22 on the file "CopyPasteThisToPHPMyAdmin.sql")
2. Copy and paste the contents of the file "CopyPasteThisToPHPMyAdmin.sql" in SQL section of PHPMyAdmin within the database created on step 1.
3. Run the program.

ROLES:
1. Admin - monitor and delete orders in progress, also responsible for assigning couriers to couriers registered within the system.
2. Customer - can order provided products (from database) and reserve for delivery
3. Courier - view pending assigned orders (may vary depending on account)

Admin Credentials: 

Username: Admin, Password: 123

List of Courier Accounts (Username, Password):
1. John - Courier1, courierOne123
2. Miller - Courier2, courierTwo123
3. Xeno - Courier3, courierThree123
4. Dave - Courier4, courierFour123
5. Xavier - Courier5, courierFive123

Steps:
1. Select customer on the main menu.
2. Select desired products and confirm the selection.
3. When in main menu, select admin and enter the credentials mentioned above (line 13)
4. Select an operation through the drop down menu. In this case, select unassigned orders (admin 
   is not allowed to delete an order once a courier is assigned).
5. View the details of the order and select any of the AVAILABLE couriers. Click save and go back 
   to main menu by pressing the button at the top left and logout (once a courier is assigned to an order, 
   they will be tagged as UNAVAILABLE and shall complete the delivery first before being available again).
6. Select courier on the main menu and enter the credentials of the courier selected on the 
   previous step (refer to the table on Line 19 for courier accounts).
7. Once logged in, selected ORDER DELIVERED button to finish the delivery process.
