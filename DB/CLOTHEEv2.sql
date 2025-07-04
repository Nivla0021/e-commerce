CREATE DATABASE IF NOT EXISTS CLOTHEEv2;
use CLOTHEEv2;

CREATE TABLE IF NOT EXISTS UserInfo (
	id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    address VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    image_path varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS cartItems(
  cart_id INT PRIMARY KEY AUTO_INCREMENT,
  userinfo_id INT NOT NULL,
  Product_id INT NOT NULL,
  name VARCHAR(255) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  stock INT NOT NULL DEFAULT 0,
  quantity INT NOT NULL DEFAULT 0,
  size VARCHAR(255) NOT NULL,
  p_imagPath VARCHAR(255) NOT NULL,
  FOREIGN KEY (userinfo_id) REFERENCES UserInfo(id),
  FOREIGN KEY (Product_id) REFERENCES ProductItem(id)
);

CREATE TABLE IF NOT EXISTS ProductItem(
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  stock INT NOT NULL DEFAULT 0,
  size VARCHAR(255) NOT NULL,
  keyword VARCHAR(255) NOT NULL,
  image_path VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS Purchase_history(
  pHistoryid INT PRIMARY KEY AUTO_INCREMENT,
  userinfo_id INT NOT NULL,
  product_id INT NOT NULL,
  name VARCHAR(255) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  size VARCHAR(255) NOT NULL,
  quantity INT NOT NULL,
  history_image_path VARCHAR(255) NOT NULL,
  Total_amount DECIMAL(10,2) NOT NULL,
  purchase_date DATETIME,
  FOREIGN KEY (userinfo_id) REFERENCES UserInfo(id),
  FOREIGN KEY (product_id) REFERENCES ProductItem(id)
);

CREATE TABLE IF NOT EXISTS ReviewItem(
  RevId INT PRIMARY KEY AUTO_INCREMENT,
  userinfo_id INT NOT NULL,
  product_id INT NOT NULL,
  purchaseH_id INT NOT NULL,
  rating int not null,
  RevMessage VARCHAR(255) NOT NULL,
  FOREIGN KEY (userinfo_id) REFERENCES UserInfo(id),
  FOREIGN KEY (product_id) REFERENCES ProductItem(id),
  FOREIGN KEY (purchaseH_id) REFERENCES Purchase_history(pHistoryid)
);

CREATE TABLE IF NOT EXISTS TotalSales(
  totID INT PRIMARY KEY AUTO_INCREMENT,
  TotalSale DECIMAL(10,2) NOT NULL,
  saledate DATETIME
  
);

CREATE TABLE IF NOT EXISTS productSales(
  prodSalesID INT PRIMARY KEY AUTO_INCREMENT,
  product_id INT NOT NULL,
  Total_amount DECIMAL(10,2) NOT NULL,
  purchase_date DATETIME,
   FOREIGN KEY (product_id) REFERENCES ProductItem(id)
  
);

CREATE TABLE IF NOT EXISTS Messages(
  messageID INT PRIMARY KEY AUTO_INCREMENT,
  message VARCHAR(1000) NOT NULL,
  senderId INT NOT NULL,
  receiverId INT NOT NULL,
  timesend DATETIME,
  is_read BOOLEAN DEFAULT FALSE,
  FOREIGN KEY (senderId) REFERENCES UserInfo(id),
  FOREIGN KEY (receiverId) REFERENCES UserInfo(id)
  
);
CREATE TABLE IF NOT EXISTS Sale_history(
  Saleid INT PRIMARY KEY AUTO_INCREMENT,
  product_id INT NOT NULL,
  qty INT NOT NULL,
  FOREIGN KEY (product_id) REFERENCES ProductItem(id)
);




select * from userinfo;
select * from ReviewItem;
SELECT * from ReviewItem inner join purchase_history on ReviewItem.purchaseH_id = Purchase_history.pHistoryid;
delete from totalsales where totID = 2;
select * from Sale_history;
use CLOTHEEv2;

ALTER TABLE Sale_history
ADD qty INT NOT NULL;
delete from messages where messageID = 10;

SELECT 
            m.messageID,
            m.message,
            m.senderId,
            sender.email AS senderUsername,
            m.receiverId,
            receiver.email AS receiverUsername,
            m.timesend
          FROM 
            Messages m
          JOIN 
            UserInfo sender ON m.senderId = sender.id
          JOIN 
            UserInfo receiver ON m.receiverId = receiver.id
            WHERE 
                (m.senderId = 1 and m.receiverId = 24) or (m.senderId = 24 and m.receiverId = 1)
          ORDER BY 
            m.timesend ASC;
            
ALTER TABLE Messages ADD COLUMN is_read BOOLEAN DEFAULT FALSE;















