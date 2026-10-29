Food01 - เวอร์ชันแก้ไข

ปัญหาที่แก้:
1. แก้ Fatal Error: Unknown database 'food_db'
2. db.php จะสร้างฐานข้อมูล food_db อัตโนมัติ หากยังไม่มี
3. สร้างตาราง foods และ recipes อัตโนมัติ
4. recipes เชื่อมกับ foods ด้วย Foreign Key และลบสูตรตามเมนูเมื่อเมนูถูกลบ
5. มีไฟล์ food_db.sql สำหรับนำเข้าใน phpMyAdmin ได้ด้วย

วิธีใช้งาน:
1. แตกไฟล์ไว้ที่ C:\xampp\htdocs\Food01
2. เปิด XAMPP และ Start Apache กับ MySQL
3. เข้า http://localhost/Food01/
4. ถ้า MySQL ใช้ root แบบไม่มีรหัสผ่าน ให้ใช้ db.php ตามไฟล์นี้ได้เลย
5. หาก root มีรหัสผ่าน ให้เปิด db.php แล้วแก้ $pass ให้ตรงกับ MySQL

หมายเหตุ:
- db.php สามารถสร้างฐานข้อมูล/ตารางให้อัตโนมัติได้ แต่บัญชี MySQL ต้องมีสิทธิ์ CREATE DATABASE
- โฟลเดอร์ uploads จะถูกสร้างอัตโนมัติเมื่ออัปโหลดรูป
